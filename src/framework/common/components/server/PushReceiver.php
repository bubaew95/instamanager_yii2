<?php


namespace common\components\server;


class PushReceiver
{

    public function __construct(\React\EventLoop\LoopInterface $loop,
                                \InstagramAPI\Instagram $instagram,
                                \Psr\Log\LoggerInterface $logger = null)
    {
        $push = new \InstagramAPI\Push($loop, $instagram, $logger);

        $push->on('incoming', function (\InstagramAPI\Push\Notification $push) {
            printf('%s%s', $push->getMessage(), PHP_EOL);
        });

        $push->on('direct_v2_message', function (\InstagramAPI\Push\Notification $push) use ($instagram) {
            Log::writeToLog($push->getMessage(), 'Message push');
//            $curl = LuisApi::curl(trim($push->getMessage()));
//            $txt = '';
//            if(isset($curl['topScoringIntent']['intent'])) {
//                $txt = "Ваше намерение {$curl['topScoringIntent']['intent']}\r\n";
//                $txt .= "Вес данного намерения {$curl['topScoringIntent']['score']}\r\n";
//            }
//
//            if(!empty($curl['entities'])) {
//                foreach ($curl['entities'] as $entity) {
//                    if(isset($entity['resolution'])) {
//                        $txt .= "Название ролов: {$entity['entity']}\r\n";
//                        $txt .= "Латинское название: {$entity['resolution']['values'][0]}";
//                    }
//
//                }
//            }
//            sleep(2);
//            $instagram->direct->sendText(['thread' => $push->getActionParam('id')], $txt);
        });
        $push->on('error', function (\Exception $e) use ($push, $loop) {
            printf('[!!!] Got fatal error from FBNS: %s%s', $e->getMessage(), PHP_EOL);
            $push->stop();
            $loop->stop();
        });
        $push->start();
        $loop->run();

    }

}
