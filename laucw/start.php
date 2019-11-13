<?php

namespace laucw;

// 引导文件

// 加载基础文件
require __DIR__ . '/base.php';
// 执行应用并响应
\laucw\lib\Kernel::run();
