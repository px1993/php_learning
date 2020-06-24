<?php

/**
 * 链表
 */
class LinkedList
{
    private $list = [];

    /**
     * 获取单列表所有的值
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function getNode($index)
    {
        $value  = null;
        while(current($this->list)){
            if(key($this->list) == $index){
                $value = current($this->list);
            }
            next($this->list);
        }
        reset($this->list);
        return $value;
    }
}

$linkList = new LinkedList();