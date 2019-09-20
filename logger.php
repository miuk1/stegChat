<?php
//setting logger for events
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

define('mylog', new Logger('logs'));
$mylog->pushHandler(new StreamHandler('../logs.log', Logger::DEBUG));
