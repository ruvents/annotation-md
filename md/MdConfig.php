<?php

namespace nastradamus39\slate\md;

class MdConfig
{

    public $params = [];

    private static $_instance = null;

    private function __construct() {

    }

    protected function __clone() {

    }

    static public function getInstance() {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

}
