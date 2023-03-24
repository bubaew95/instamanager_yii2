<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 03/10/2019
 * Time: 18:28
 */

namespace common\components\server;

use common\components\log\Log;
use common\models\instagram\InstagramDirect;
use common\models\instagram\InstagramMessages;
use InstagramAPI\Instagram;
use InstagramAPI\Push;
use InstagramAPI\Realtime;
use InstagramAPI\Response\Model\AudioContext;
use InstagramAPI\Response\Model\DirectThreadItem;
use InstagramAPI\Response\Model\DirectThreadItemMedia;
use InstagramAPI\Response\Model\ImageCandidate;
use InstagramAPI\Response\Model\User;
use InstagramAPI\Response\Model\VoiceMedia;
use Psr\Log\LoggerInterface;
use React\EventLoop\LoopInterface;
use yii\base\InvalidArgumentException;

class RealtimeClientServer
{
    private $isItemCreated = false;
    private function getUse($memory)
    {
        $i = 0;
        while (floor($memory / 1024) > 0) {
            $i++;
            $memory /= 1024;
        }
        $name = array('байт', 'КБ', 'МБ');
        return round($memory, 2) . ' ' . $name[$i];
    }

    public function addChat($thread_id, $threadItemId, DirectThreadItem $threadItem)
    {
        $direct = InstagramDirect::findOne(['thread_id' => $thread_id]);
        if(empty($direct)) {
            $direct                 = new InstagramDirect();
            $direct->id_project     = 2;
            $direct->id_user        = 1;
            $direct->id_instagram   = 1;
            $direct->thread_id      = $thread_id;

            $userID                 = $threadItem->getUserId();
            $direct->user_id        = $userID;

            $userInfo = $this->_instagram->people->getInfoById($userID);
            if($userInfo->getUser() instanceof User) {
                $direct->user_name      = $userInfo->getUser()->getUsername();
                $direct->img            = $userInfo->getUser()->getProfilePicUrl();
            }

            $direct->created_at     = time();
            $direct->save();
        }
        $message                    = new InstagramMessages();
        $message->id_direct         = $direct->id;
        $message->thread_item_id    = $threadItemId;
        $message->text              = $this->messageType($threadItem);
        $message->isInterlocutor    = 1;
        $message->created_at        = $threadItem->getTimestamp();
        $message->link('direct', $direct);
    }

    private function messageType(DirectThreadItem $threadItem) : ?string
    {
        $text = null;
        $type = $threadItem->getItemType();
        switch ($type) {
            case 'text':
                $text = $threadItem->getText();
                break;
            case 'media':
                $threadItemMedia    = $threadItem->getMedia() ?? null;
                $threadItemMediaImg = $threadItemMedia->getImageVersions2()->getCandidates() ?? null;
                if($threadItemMedia instanceof DirectThreadItemMedia) {
                    $text = "<a href='{$threadItemMediaImg[0]->getUrl()}'><img src='{$threadItemMediaImg[1]->getUrl()}' width='".(int)($threadItemMediaImg[1]->getWidth() / 2)."' class='item-media'></a>";
                }
                break;
            case 'voice_media':
                $threadItemVoice    = $threadItem->getVoiceMedia() ?? null;
                $threadItemVoiceSrc = $threadItemVoice->getMedia()->getAudio() ?? null;
                if($threadItemVoice instanceof VoiceMedia) {
                    if($threadItemVoiceSrc instanceof AudioContext) {
                        $text = "<audio controls><source src='{$threadItemVoiceSrc->getAudioSrc()}' type='audio/mpeg'> Аudio не поддерживается вашим браузером. </audio>";
                    }
                }
                break;
            case 'like':
                $text = $threadItem->getLike();
                break;
        }
        return $text;
    }

    public function __construct(LoopInterface $loop, Instagram $instagram, LoggerInterface $logger = null)
    {
        $this->_rtc         = new Realtime($instagram, $loop, $logger);
        $this->_push        = new Push($loop, $instagram, $logger);
        $this->_instagram   = $instagram;
        $this->mem_start    = $this->getUse(memory_get_usage());
        /**
         * Метод ловит новые сообщения
         */
        $this->_rtc->on('thread-item-created', function ($threadId, $threadItemId, DirectThreadItem $threadItem) {
            $endTime = $this->getUse(memory_get_usage() - $this->mem_start);
            $this->isItemCreated = true;
            $this->addChat($threadId, $threadItemId, $threadItem);
        });

        /**
         * Метод который ловит сообщения которые отправляются в запросы
         */
        $this->_push->on('direct_v2_message', function (Push\Notification $push) {
//            if(!$this->isItemCreated) :
//                $pushText = $push->getMessage();
//                $expText = explode(':', $pushText);
//                sleep(2);
//                $this->_instagram->direct->sendText(
//                    ['thread' => $push->getActionParam('id')],
//                    "Здравствуйте, {$expText[0]}!\r\nЯ автоматизированный бот.\r\nПожалуйста задавайте мне вопросы и ждите пока я вам отвечу."
//                );
//            endif;
//            $this->isItemCreated = false;
        });

        $this->_push->on('comment', function (\InstagramAPI\Push\Notification $push) {
            switch ($push->getActionPath()) {
                case 'comments_v2':
                    $mediaId = $push->getActionParam('media_id');
                    $commentId = $push->getActionParam('target_comment_id');
                    break;
                case 'media':
                default:
                    $mediaId = $push->getActionParam('id');
                    $commentId = $push->getActionParam('forced_preview_comment_id');
            }
            $endTime = $this->getUse(memory_get_usage() - $this->mem_start);

//            try {
            $explode = explode(':', $push->getMessage());
            $userName = explode(' ', $explode[0]);

            $txt = "@{$userName[0]}, ";
            //$txt .= $this->__AnswerLuis($explode[1]);
            $txt .= "\r\n\r\nНагрузка на сервер:\r\nДо: {$this->mem_start}\r\n\После: {$endTime}";
            sleep(4);
            $comm = $this->_instagram->media->comment($mediaId, $txt, $commentId);
            $arr = [$mediaId, $commentId];
            Log::writeToLog($arr, 'Array media id', 'commID');
            Log::writeToLog($comm, 'Array media id', 'comm');
//            }catch (InvalidArgumentException $ex) {
//                print($ex->getMessage());
//            }
        });

        //1
        $this->_rtc->on('thread-activity', function ($threadId, \InstagramAPI\Realtime\Payload\ThreadActivity $activity) {
            $txt = sprintf('[thread-activity] Thread %s has some activity made by %s%s', $threadId, $activity->getSenderId(), PHP_EOL);
            Log::writeToLog($txt, 'thread-activity');
        });

        $this->_rtc->on('direct-story-updated', function ($threadId, $threadItemId, \InstagramAPI\Response\Model\DirectThreadItem $threadItem) {
            $txt = sprintf('[direct-story-updated] Item %s has been created in story %s%s', $threadItemId, $threadId, PHP_EOL);
            $this->_rtc->sendTextToDirect($threadId, $txt);
        });
        $this->_rtc->on('direct-story-screenshot', function ($threadId, \InstagramAPI\Realtime\Payload\StoryScreenshot $screenshot) {
            $txt = sprintf('[direct-story-screenshot] %s has taken screenshot of story %s%s', $screenshot->getActionUserDict()->getUsername(), $threadId, PHP_EOL);
            $this->_rtc->sendTextToDirect($threadId, $txt);
        });
        $this->_rtc->on('direct-story-action', function ($threadId, \InstagramAPI\Response\Model\ActionBadge $storyAction) {
            $txt = sprintf('[direct-story-action] Story in thread %s has badge %s now%s', $threadId, $storyAction->getActionType(), PHP_EOL);
            $this->_rtc->sendTextToDirect($threadId, $txt);
        });
        $this->_rtc->on('thread-created', function ($threadId, \InstagramAPI\Response\Model\DirectThread $thread) {
            $txt = sprintf('[thread-created] Thread %s has been created%s', $threadId, PHP_EOL);
            $this->_rtc->sendTextToDirect($threadId, $txt);
        });
        $this->_rtc->on('thread-updated', function ($threadId, \InstagramAPI\Response\Model\DirectThread $thread) {
            $txt = sprintf('[thread-updated] Thread %s has been updated%s', $threadId, PHP_EOL);
            $this->_rtc->sendTextToDirect($threadId, $txt);
        });
        $this->_rtc->on('thread-notify', function ($threadId, $threadItemId, \InstagramAPI\Realtime\Payload\ThreadAction $notify) {
            $txt = sprintf('[thread-notify] Thread %s has notification from %s%s', $threadId, $notify->getUserId(), PHP_EOL);
            $this->_rtc->sendTextToDirect($threadId, $txt);
        });
        $this->_rtc->on('thread-seen', function ($threadId, $userId, \InstagramAPI\Response\Model\DirectThreadLastSeenAt $seenAt) {
            $txt = sprintf('[thread-seen] Thread %s has been checked by %s%s', $threadId, $userId, PHP_EOL);
            Log::writeToLog($txt, 'thread-seen');
        });

        $this->_rtc->on('thread-item-updated', function ($threadId, $threadItemId, \InstagramAPI\Response\Model\DirectThreadItem $threadItem) {
            $txt = sprintf('[thread-item-updated] Item %s has been updated in thread %s%s', $threadItemId, $threadId, PHP_EOL);
            $this->_rtc->sendTextToDirect($threadId, $txt);
        });
        $this->_rtc->on('thread-item-removed', function ($threadId, $threadItemId) {
            $txt = sprintf('[thread-item-removed] Item %s has been removed from thread %s%s', $threadItemId, $threadId, PHP_EOL);
            $this->_rtc->sendTextToDirect($threadId, $txt);
        });

        $this->_rtc->on('client-context-ack', function (\InstagramAPI\Realtime\Payload\Action\AckAction $ack) {
            $txt = sprintf('[RTC] Received ACK for %s with status %s%s', $ack->getPayload()->getClientContext(), $ack->getStatus(), PHP_EOL);
            Log::writeToLog($txt, 'client-context-ack');
        });

        $this->_rtc->on('unseen-count-update', function ($inbox, \InstagramAPI\Response\Model\DirectSeenItemPayload $payload) {
            $txt = sprintf('[RTC] Updating unseen count in %s to %d%s', $inbox, $payload->getCount(), PHP_EOL);
            Log::writeToLog($txt, 'unseen-count-update');
        });
        $this->_rtc->on('presence', function (\InstagramAPI\Response\Model\UserPresence $presence) {
            $action = $presence->getIsActive() ? 'is now using' : 'just closed';
            $txt = sprintf('[RTC] User %s %s one of Instagram apps%s', $presence->getUserId(), $action, PHP_EOL);
            Log::writeToLog($txt, 'presence');
        });

        $this->_rtc->on('error', function (\Exception $e) use ($loop) {
            $txt = sprintf('[!!!] Got fatal error from Realtime: %s%s', $e->getMessage(), PHP_EOL);
            $this->_rtc->stop();
            $loop->stop();
        });
        $this->_rtc->start();
        $this->_push->start();
        $loop->run();
    }

}
