<?php


namespace common\modules\insta\modules\common\insta;


use common\components\constants\Constants;
use common\components\encryption\Encryption;
use InstagramAPI\Response\UserFeedResponse;
use Yii;
use common\models\instagram\InstagramDataModel;
use common\models\products\Products;
use InstagramAPI\Exception\NetworkException;
use InstagramAPI\Response\Model\Caption;
use InstagramAPI\Response\Model\Image_Versions2;
use InstagramAPI\Response\Model\ImageCandidate;
use InstagramAPI\Response\Model\Item;
use yii\base\Exception;
use yii\helpers\HtmlPurifier;

class InstagramDataWidget
{

    public function loadMedia( $data ) : bool
    {
        echo "start ...\r\n";
        $ig = InstaAuth::Init($data->login, Encryption::decrypt(Constants::HASH_KEY, $data->pass));
        try {
            $userId = $data->account_id; //$ig->people->getUserIdForName('noxcho__95');
            $maxId = null;
            $mediaArray = [];
            $i = 0;
            do {
                $response = $ig->timeline->getUserFeed($userId, $maxId);

                if($response instanceof UserFeedResponse) {
                    foreach ($response->getItems() as $item) {
                        $text = '';
                        $caption = $item->getCaption();
                        if($caption instanceof Caption) {
                            $text = $caption->getText();
                        }

                        $img = '';
                        $candidates = $item->getImageVersions2();
                        if($candidates instanceof Image_Versions2) {
                            echo "\r\n\r\n";
                            $images = $candidates->getCandidates();
                            $endImg = end($images);
                            $img = $endImg->getUrl();
                        }


                        $mediaArray[] = [
                            'id_project'    => $data->id_project,
                            'name'          => "Товар №{$item->getId()}",
                            'latin_name'    => "goods_{$item->getId()}",
                            'img'           => $img,
                            'text'          => $text,
                            'price'         => 0,

                            'id_instagram'  => $data->id_module,
                            'media_id'      => $item->getId(),
                            'link'          => sprintf( "https://instagram.com/p/%s", $item->getCode()),
                            'likes'         => $item->getLikeCount(),
                            'comments'      => $item->getCommentCount()
                        ];
                    }
                    $maxId = $response->getNextMaxId();
                    $i++;
                    //if($i >= 200) break;
                    echo "next load ...\r\n\r\n";
                    sleep(5);
                }
            } while ($maxId !== null);

            $this->insertMedia($mediaArray);
            //PushWidget::processDelete('loadingusermedia', $data->id_user, $data->id_project);

        } catch (Exception $e) {
            echo 'Something went wrong: '.$e->getMessage()."\n";
            return false;
        }
        return true;
    }

    private function insertMedia(array $params = []) : bool
    {

          print_r($params);
        if(is_array($params)) {
            foreach ($params as $item) {
//                $transaction = Yii::$app->db->beginTransaction();
//                try {
                    $productModel               = new Products();
                    $productModel->id_project   = $item['id_project'];
                    $productModel->name         = $item['name'];
                    $productModel->latin_name   = $item['latin_name'];
                    $productModel->img          = $item['img'];
                    $productModel->text         = $item['text'];
                    $productModel->price        = $item['price'];
                    $productModel->instaData    = 1;
                    $productModel->save();

                    $instaData                  = new InstagramDataModel();
                    $instaData->id_instagram    = $item['id_instagram'];
                    $instaData->media_id        = $item['media_id'];
                    $instaData->link            = $item['link'];
                    $instaData->likes           = $item['likes'];
                    $instaData->comments        = $item['comments'];
                    $instaData->link('product', $productModel);

//                    $transaction->commit();
//                } catch (Exception $e) {
//                    $transaction->rollback();
//                }
            }
            return true;
        }
        return false;
    }

}
