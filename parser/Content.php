<?php

namespace ruvents\slate\parser;

use ruvents\slate\annotations\ApiContent;
use ruvents\slate\md\Content as MdContent;

class Content
{

    public function parse(ApiContent $annotation) {

        $md = new MdContent();
        $md->title = $annotation->title;
        $md->description = $annotation->description;

        return $md;
    }

}