<?php

namespace nastradamus39\slate\parser;

use nastradamus39\slate\annotations\ApiObject;
use nastradamus39\slate\md\Obj as MdObj;

class Obj
{

    public function parse(ApiObject $annotation) {
        $md = new MdObj();
        $md->code = $annotation->code;
        $md->title = $annotation->title;
        $md->description = $annotation->description;
        $md->json = $annotation->json;
        $md->params = $annotation->params;
        return $md;
    }

}