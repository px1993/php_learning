<?php
// namespace LearningProject;

include "./common/Loader.php";

//spl自动加载注册类
spl_autoload_register('Loader::autoload');