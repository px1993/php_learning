<?php

//demo1: fork一个新的子进程出来
//$childPid = pcntl_fork();
// if ($childPid == 0) {
//     echo "i am child process!" . PHP_EOL;
// } elseif ($childPid > 0) {
//     echo "i am parent process!" . PHP_EOL;
// } else {
//     echo "pcntl error!" . PHP_EOL;
// }

//demo2: COW进程隔离，父子进程之间的数据在写时候就进行了隔离
// $string   = "hello world！";
// $childPid = pcntl_fork();
// if (0 == $childPid) {
//     echo $string . "child  processing" . "| 子进程pid：" .posix_getpid() . "| 父进程pid：" . posix_getppid() . PHP_EOL;
// } elseif (0 < $childPid) {
//     echo $string . "parent processing" . "| 子进程pid：" .posix_getpid() . "| 父进程pid：" . posix_getppid() . PHP_EOL;
// } else {
//     echo "pnctl error!" . PHP_EOL;
// }

//demo3: for循环fork，父子进程都会继续fork (答案是：7次)
// for ($i=1; $i <= 3; $i++) {
//     $childPid = pcntl_fork();
//     if (0 == $childPid) {
//         echo "@child: " . posix_getpid() . PHP_EOL;
//     }
// }

//demo4: for+exit循环fork，父子进程都会继续fork (答案是：3次) 子进程退出循环，父进程依然继续运行，执行的次数就是循环的次数
// for ($i=1; $i <= 3; $i++) {
//     $childPid = pcntl_fork();
//     if (0 == $childPid) {
//         echo "@child: " . posix_getpid() . PHP_EOL;
//         exit;
//     }
// }

//demo5:pnctl_fork()测试redis链接
// require "../../sockets/SocketsRedisClient.php";
// $client = new RedisClient();
// //使用for循环fork三个子进程
// for ($i=1; $i <= 4; $i++) {
//     $childPid = pcntl_fork();
//     if (0 == $childPid) {
//         $b_ret = $client->handle("sismember uid " . $i);
//         echo $i.':'.json_encode($b_ret).PHP_EOL;
//         // 使用while保证三个子进程不会退出...
//         while (true) {
//             sleep(1);
//         }
//     }
// }
// // 使用while保证主进程不会退出...
// while (true) {
//     sleep(1);
// }

//demo6:使用for循环搞出3个子进程来
// for ($i = 1; $i <= 7; $i++) {
//     $i_pid = pcntl_fork();
//     var_dump($i_pid);
//     if (0 == $i_pid) {
//         file_put_contents("./Core.log", $i.PHP_EOL, FILE_APPEND );
//         // 使用while保证三个子进程不会退出...
//         exit;
//     }
// }
// // 使用while保证主进程不会退出...
// while (true) {
//     sleep(1);
// }


for ( $i = 1; $i <= 30; $i++ ) {
    $pid = pcntl_fork();
    if ( 0 == $pid ) {
      $my_pid = posix_getpid();
      for ( $counter = 1; $counter <= 100; $counter++ ) {
        file_put_contents( "./api.log", "what\r\n", FILE_APPEND );
        //file_put_contents( "./api.log", date( 'Y-m-d H:i:s' ).' : '.$str."\r\n", FILE_APPEND|LOCK_EX );
      }
      exit;
    }
  }

//demo5:pnctl_fork()结论：
//1. 如果想得到子进程的个数，在子进程执行完毕，必须要exit退出
