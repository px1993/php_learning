<?php

/**
 * 定义接口
 *
 * @package
 * @author panxin <panxin@aipai.com>
 */
interface Amqp{
    
    public function connect();

    public function getInstance();

    public function close();
}