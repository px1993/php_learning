<?php

/**
 * 
 */
class SocketsClient
{
    private $client;

    public function __construct()
    {
        error_reporting(E_ALL);
        set_time_limit(0);
        try{
            $client = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            if(0 > $client){
                throw new \Exception(socket_last_error());
            }
        }catch(\Exception $e){
            var_dump($e->getMessage());
        }
        $this->client = $client; 
    }

    /**
     * 建立连接
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function connect($address = '127.0.0.1', $port = 6379)
    {
        try{
            $result = socket_connect($this->client, $address, $port);
            if(0 > $result){
                throw new \Exception(socket_last_error());
            }
        }catch(\Exception $e){
            var_dump("socket connect error". $e->getMessage());
        }
    }

    /**
     * 发送数据
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function write()
    {
        try{
            $str = 'hello world!';
            socket_write($this->socket, $str, strlen($str));
        }catch(\Exception $e){
            var_dump("socket write error". $e->getMessage());
        }
    }

    /**
     * 读取数据
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function read()
    {
        try{
            $result = socket_read($this->client, 1024);
            if(0 > $result){
                throw new \Exception(socket_last_error());
            }
            print "from simple-tcp-server:" . $result . PHP_EOL;
        }catch(\Exception $e){
            var_dump("socket connect error". $e->getMessage());
        }
    }
}

$client = new SocketsClient();
$client->connect('127.0.0.1', 6379);
$client->write();
$client->read();