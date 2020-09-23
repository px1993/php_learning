<?php

/**
 * 代代器实现
 *
 * @package
 * @author panxin <panxin@aipai.com>
 */
class MyIterator implements Iterator
{

    private $array;

    /**
     * 初始化一个数组
     *
     * @return mixed
     * @author panxin <panxin@aipai.com>
     */
    public function __construct($array)
    {
        $this->array = $array;
    }

    /**
     * 获取当前数组的元素
     *
     * @return void
     * @author panxin <panxin@aipai.com>
     */
    public function current()
    {
        echo __FUNCTION__;
        $position = current($this->array);
        echo ':' . $position . PHP_EOL;
        return $position;
    }

    /**
     * 移动下标到下一个元素
     *
     * @return void
     * @author panxin <panxin@aipai.com>
     */
    public function next()
    {
        echo __FUNCTION__;
        $position = next($this->array);
        echo ":" . $position . PHP_EOL;
        return $position;
    }

    /**
     * 返回当前迭代器的key
     *
     * @return void
     * @author panxin <panxin@aipai.com>
     */
    public function key()
    {
        echo __FUNCTION__;
        $position = key($this->array);
        echo ":" . $position . PHP_EOL;
        return $position;
    }

    /**
     * 
     *
     * @return void
     * @author panxin <panxin@aipai.com>
     */
    public function valid()
    {
        echo __FUNCTION__ ;
        $res = current($this->array) !== false;
        echo ":" . $res . PHP_EOL;
        return $res;
    }

    /**
     * 重置数组
     *
     * @return void
     * @author panxin <panxin@aipai.com>
     */
    public function rewind()
    {
        echo __FUNCTION__ .PHP_EOL;
        reset($this->array);
    }
}

$myIterator = new MyIterator(['小米', '华为', '中兴', '联想']);
foreach ($myIterator as $a => $b) {
    var_dump($b);
    echo PHP_EOL;
}