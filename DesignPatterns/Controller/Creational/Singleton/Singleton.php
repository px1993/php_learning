<?php

namespace DesignPatterns\Controller\Creational\Singleton;

/**
 * 单利模式实现
 */
class Singleton{

    //私有的静态属性
    private static $instance;

    //私有的初始化方法
    private function __construct()
    {

    }

    /**
     * 统一的对外获取实例的方法
     *
     * @return \DesignPatterns\Creational\Singleton\Singleton
     *
     * @author panxin <panxin@aipai.com>
     */
    public static function getInstance()
    {
        if(null == self::$instance){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 方法
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function run()
    {
        echo "aaaa";
    }
}
