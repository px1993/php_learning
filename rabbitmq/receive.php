<?php

/**
 * 接收消息
 */
$exchangeName = 'AIPAI_GOPLAY';
$queueName    = 'GOPLAY_MQ_HUNTER';
$routeKey     = 'hunter';

// 建立TCP连接
$connection = new AMQPConnection([
    'host'     => '172.23.0.4',
    'port'     => '5672',
    'vhost'    => '/',
    'login'    => 'panda',
    'password' => 'Px123456789'
]);
$connection->connect() or die("Cannot connect to the broker!\n");

$channel = new AMQPChannel($connection);

$exchange = new AMQPExchange($channel);
$exchange->setName($exchangeName);
$exchange->setFlags(AMQP_DURABLE);
$exchange->setType(AMQP_EX_TYPE_DIRECT);

echo 'Exchange Status: ' . $exchange->declareExchange() . "\n";

$queue = new AMQPQueue($channel);
$queue->setName($queueName);
$queue->setFlags(AMQP_DURABLE);

echo 'Message Total: ' . $queue->declareQueue() . "\n";

echo 'Queue Bind: ' . $queue->bind($exchangeName, $routeKey) . "\n";

var_dump("Waiting for message...");

// 消费队列消息
while(TRUE) {
    $queue->consume('processMessage');
    sleep(2);
}

// 断开连接
$connection->disconnect();

function processMessage($envelope, $queue) {
    $msg = $envelope->getBody();
    var_dump("Received: " . $msg);
    $queue->ack($envelope->getDeliveryTag()); // 手动发送ACK应答
}