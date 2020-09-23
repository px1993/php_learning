<?php

namespace LearningProject\rabbitmq;

// require "./ProducerMQ.php";

/**
 * testMQ类
 *
 * @package
 * @author panxin <panxin@aipai.com>
 */
class Test
{
    /**
     * run
     *
     * @return void
     * @author panxin <panxin@aipai.com>
     */
    public function run()
    {
        $producer = new ProducerMQ();
        $producer->run();
        var_dump($producer);
    }
}

$test = new Test();
$test->run();
