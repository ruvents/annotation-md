<?php

namespace ruvents\slate\parser;

use ruvents\slate\annotations\ApiController;
use ruvents\slate\md\Controller as MdController;

class Controller
{

    public function parse(ApiController $annotation) {

        $md = new MdController();
        $md->controller = $annotation->controller;
        $md->title = $annotation->title;
        $md->description = $annotation->description;

        return $md;
    }

}