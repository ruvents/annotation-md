<?php

namespace nastradamus39\slate\parser;

use nastradamus39\slate\annotations\ApiContent;
use nastradamus39\slate\md\Content as MdContent;

class Content
{

    public function parse(ApiContent $annotation) {

        $md = new MdContent();
        $md->title = $annotation->title;
        $md->description = $annotation->description;

        return $md;
    }

}