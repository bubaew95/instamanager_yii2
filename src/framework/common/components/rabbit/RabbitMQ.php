<?php
/**
 * Created by PhpStorm.
 * User: Borz
 * Date: 17.05.2019
 * Time: 20:35
 */

namespace common\components\rabbit;


use common\components\constants\Constants;
use common\modules\insta\modules\common\insta\InstagramDataWidget;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Exception\AMQPConnectionClosedException;
use PhpAmqpLib\Message\AMQPMessage;
use yii\db\Exception;

class RabbitMQ
{

    private $connection;
    private $channel;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(Constants::RABBIT_HOST, Constants::RABBIT_PORT, Constants::RABBIT_LOGIN, Constants::RABBIT_LOGIN);
        $this->channel = $this->connection->channel();
    }

    public function sendMessageRabbit($json, $nameMQ = 'insta_data')
    {
        $this->channel->queue_declare($nameMQ, false, true, false, false);
        $msg = new AMQPMessage(json_encode($json));
        $this->channel->basic_publish($msg, '', $nameMQ);
        return $this->channel;
    }

    public function readRabbitMq()
    {
        try {
            $this->channel->queue_declare('insta_data', false, true, false, false);

            echo " [*] Waiting for messages. To exit press CTRL+C\n";

            $callback = function ($msg) {
                echo ' [x] Received ', $msg->body, "\n";
                if($msg) {
                    $rabbitData = json_decode($msg->body);
                    try{
                        $model = new InstagramDataWidget();
                        $model->{$rabbitData->method}($rabbitData->data);
                    }catch (\yii\console\Exception $ex) {
                        print $ex->getMessage();
                    }
                }
                sleep(substr_count($msg->body, '.'));
                echo " [x] Done\n";
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            };

            $this->channel->basic_qos(null, 1, null);
            $this->channel->basic_consume('insta_data', '', false, false, false, false, $callback);
            while (count($this->channel->callbacks)) {
                $this->channel->wait();
            }
        }catch (AMQPConnectionClosedException $ex) {
            print($ex->getMessage());
        }
    }


    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }

}
