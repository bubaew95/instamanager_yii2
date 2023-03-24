<?php
/**
 * Created by PhpStorm.
 * User: borz
 * Date: 03/10/2019
 * Time: 18:26
 */

namespace console\controllers;

use common\components\server\PushReceiver;
use common\components\server\RealtimeClientServer;
use common\components\server\RealtimeHttpServer;
use common\modules\insta\modules\common\insta\InstaAuth;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use React\EventLoop\Factory;
use yii\console\Controller;


class RealtimeController extends Controller {

    public $login;
    public $pass;
    public $port;

    public function options($actionID)
    {
        return ['login', 'pass', 'port'];
    }

    /**
     * Получение сообщений в директ
     * @throws \Exception
     */
    public function actionIndex()
    {
        $username   = $this->login;
        $password   = $this->pass;
        $ig = InstaAuth::Init($username, $password);
        $loop = Factory::create();
        new RealtimeClientServer($loop, $ig, $this->_logger(false));
        $loop->run();
    }

    /**
     * Запуск сервера
     * @throws \Exception
     */
    public function actionHttpserver()
    {
        $username   = $this->login;
        $password   = $this->pass;
        $ig = InstaAuth::Init($username, $password);
        $loop = Factory::create();
        new RealtimeHttpServer($loop, $ig, $this->_logger(), $this->port);
        $loop->run();
    }

    /**
     * Прослушивание действий над аккаунтом
     * @throws \Exception
     */
    public function actionPush()
    {
        $username   = $this->login;
        $password   = $this->pass;
        $ig = InstaAuth::Init($username, $password);
        $loop = Factory::create();
        new PushReceiver($loop, $ig, $this->_logger());
        $loop->run();
    }


    private function _logger($debug = true) : ?LoggerInterface
    {
        if ($debug) {
            $logger = new Logger('rtc');
            try {
                $logger->pushHandler(new StreamHandler('php://stdout', Logger::INFO));
            } catch (\Exception $e) {
            }
        } else {
            $logger = null;
        }
        return $logger;
    }

}
