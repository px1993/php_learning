<?php

namespace LearningProject\rabbitmq;

// require "./BaseMQ.php";

/**
 * MQ基类
 *
 * @package
 * @author panxin <panxin@aipai.com>
 */
class ProducerMQ extends BaseMQ
{
    /**
     * 开始生产消息
     *
     * @return void
     * @author panxin <panxin@aipai.com>
     */
    public function run()
    {
        echo "开始生产消息";
    }
}