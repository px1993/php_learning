<?php

include './Amqp.php';

class RabbitMq implements Amqp
{
    private $conf     = null;
    private $instance = null;

    private function __construct()
    {
        $conf = [
            'host'     => '172.23.0.4',
            'port'     => '5672',
            'vhost'    => '/',
            'login'    => 'panda',
            'password' => 'Px123456789'
        ];
        return AMQPConnection($conf);
    }

    /**
     * connect
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function connect()
    {
        self::$instance->connect();
    }

    /**
     * 获取单例
     *
     * @return $this
     *
     * @author panxin <panxin@aipai.com>
     */
    public static function getInstance()
    {
        if(null === self::$instance){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 关闭
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function close()
    {
        self::$instance->disconnect();
    }
}

$mq = RabbitMq::getInstance();
var_dump($mq);