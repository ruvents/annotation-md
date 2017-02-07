<?php

namespace nastradamus39\slate\parser;

use nastradamus39\slate\annotations\ApiAction;

use nastradamus39\slate\md\Action as MdAction;
use nastradamus39\slate\parser\Action\Request as RequestParser;

class Action
{

    public function parse(ApiAction $annotation) {

        $md = new MdAction();
        $md->controller = $annotation->controller;
        $md->title = $annotation->title;
        $md->description = $annotation->description;

        if(!empty($annotation->request)){
            $md->request = (new RequestParser())->parse($annotation->request);
        }

        return $md;
    }


}