<?php

namespace ruvents\slate\md;

class MdConfig
{
    public static $lastInsertMenu;
    public $params = [];
    private static $_instance;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
}
