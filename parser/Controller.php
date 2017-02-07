<?php

namespace nastradamus39\slate\parser;

use nastradamus39\slate\annotations\ApiController;
use nastradamus39\slate\md\Controller as MdController;

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