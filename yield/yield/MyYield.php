<?php

/**
 * yield
 *
 * @package
 * @author panxin <panxin@aipai.com>
 */
class MyYield
{
    /**
     * 生成
     *
     * @param [type] $start
     * @param [type] $end
     * @param integer $step
     * @return object
     * @author panxin <panxin@aipai.com>
     */
    public function xrange($start, $end, $step = 1) {
        for ($i = $start; $i <= $end; $i += $step) {
            yield $i;
        }
    }

    /**
     * 测试
     *
     * @return void
     * @author panxin <panxin@aipai.com>
     */
    function test()
    {
        foreach ($this->xrange(1, 1000000) as $num) {
            echo $num, "\n";
        }
    }
}

$myYield = new MyYield();
$myYield->test();