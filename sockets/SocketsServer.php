<?php

/**
 * 
 */
class SocketsServer
{
    private $socket;
    private $clients = [];

    public function __construct()
    {
        error_reporting(E_ALL);
        set_time_limit(0);
        try{
            $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
            if(0 > $socket){
                throw new \Exception(socket_last_error());
            }
        }catch(\Exception $e){
            var_dump($e->getMessage());
        }
        $this->socket = $socket; 
    }
    
    /**
     * 开启一个套接字连接的服务
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function bind($address = '127.0.0.1', $port = 6379)
    {
        try{
            $result = socket_bind($this->socket, $address, $port);
            if(0 > $result){
                throw new \Exception(socket_last_error());
            }
            echo "===================服务开启==================\n";
        }catch(\Exception $e){
            var_dump("socket bind error". $e->getMessage());
        }
    }

    /**
     * 开启监听
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function listen()
    {
        try{
            $result = socket_listen($this->socket, 1);
            if(0 > $result){
                throw new \Exception(socket_last_error());
            }
            echo "===================正在监听==================\n";
        }catch(\Exception $e){
            var_dump("socket listen error". $e->getMessage());
        }
    }

    /**
     * 开启接收
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function accept()
    {
        try{
            $newc = socket_accept($this->socket);
            if(0 > $newc){
                throw new \Exception(socket_last_error());
            }
            $this->clients[] = $newc;
        }catch(\Exception $e){
            var_dump("socket accept error". $e->getMessage());
        }
    }

    /**
     * 关闭socket连接
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function close()
    {
        socket_close($this->socket);
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
        $str = 'hello world!';
        socket_write($this->socket, $str, strlen($str));
    }

    /**
     * 获取已连接的客户端文件描述
     *
     * @return void
     *
     * @author panxin <panxin@aipai.com>
     */
    public function getClients()
    {
        return $this->clients;
    }
}
$sockets = new SocketsServer();
$sockets->bind('0.0.0.0', 6379);
$sockets->listen();
while(true){
    $sockets->accept();
    $sockets->write();
}

