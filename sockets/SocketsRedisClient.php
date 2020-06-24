<?php
//使用php实现redis客户端
// $redis = stream_socket_client('tcp://172.20.0.2:6379', $errno, $errstr, 5);
// if (!$redis) {
//     die('连接redis服务器失败: ' . $errstr);
// }
// echo "欢迎使用php-redis客户端，请按下面的说明进行操作。\n";
// echo "1.{}" .PHP_EOL;
// echo "2.{set key value}设置一个key-value的键值" . PHP_EOL;
// while(true){
//     echo "请输入redis命令：" . PHP_EOL;
//     $line = trim(fgets(STDIN));
//     $argv = explode(' ', $line);
//     if('close' == $argv[0]){
//         break;
//     }
//     $cmd .= "*" . count($argv) ."\r\n";
//     foreach($argv as $key=>$value){
//         $cmd .= "$" . strlen($value) . "\r\n";
//         $cmd .= $value . "\r\n";
//     }
//     fwrite($redis, $cmd, strlen($cmd));
//     $ret = fread($redis, 4096);
//     echo $ret;
// }

/**
 * 客户端
 *
 * @package
 * @author panxin <panxin@aipai.com>
 */
class RedisClient
{
    /**
     * redis客户端的实例
     *
     * @var object
     */
    private $redis = null;

    /**
     * 初始化一个redis客户端
     *
     * @return mixed
     *
     * @author panxin <panxin@aipai.com>
     */
    public function __construct()
    {
        try{
            $this->redis = stream_socket_client('tcp://172.20.0.2:6379', $errno, $errstr, 5);
        }catch(\Exception $e){
            throw new \Exception($e->getCode(), $e->getMessage());
        }
    }

    /**
     * 执行命令吧
     *
     * @param string $line
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function handle($line)
    {
        while(true){
            $params  = explode(' ', $line);
            $cmd     = "*" . count($params) ."\r\n";
            foreach($params as $key=>$value){
                $cmd .= "$" . strlen($value) . "\r\n";
                $cmd .= $value . "\r\n";
            }
            fwrite($this->redis, $cmd, strlen($cmd));
            $ret = fread($this->redis, 4096);
            return $ret;
        }
    }
}