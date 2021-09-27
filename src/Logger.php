<?php

class Logger
{
    private static $instances = [];

    public static function getInstance($key)
    {
        if (!array_key_exists($key, self::$instances)) {
            self::$instances[$key] = new self();
        }

        return self::$instances[$key];
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}

$logInstance = Logger::getInstance('file');
$emailInstance = Logger::getInstance('email');
