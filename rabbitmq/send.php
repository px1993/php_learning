<?php

/**
 * 发送消息
 */
$exchangeName = 'AIPAI_GOPLAY';
$routeKey     = 'hunter';
$message      = 'Hello World!';

// 建立TCP连接
$connection = new AMQPConnection([
    'host'     => '172.23.0.4',
    'port'     => '5672',
    'vhost'    => '/',
    'login'    => 'panda',
    'password' => 'Px123456789'
]);
try {
    $connection->connect();
    $channel  = new AMQPChannel($connection);
    $exchange = new AMQPExchange($channel);
    $exchange->setName($exchangeName);
    $exchange->setFlags(AMQP_DURABLE);
    $exchange->setType(AMQP_EX_TYPE_DIRECT);
    $exchange->declareExchange('','','',true);
    $i = 0;
    while(true){
        $i++;
        echo 'Send Message: ' . $exchange->publish($message . $i, $routeKey) . "\n";
        echo "Message Is Sent: " . $message . $i . "\n";
        // sleep(0.5);
    }
} catch (AMQPConnectionException $e) {
    var_dump($e);
}

// 断开连接
$connection->disconnect();
