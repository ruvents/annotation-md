<?php

namespace nastradamus39\slate\parser;

use nastradamus39\slate\annotations\ApiAction;
use nastradamus39\slate\md\Action as MdAction;
use nastradamus39\slate\parser\Action\Request as RequestParser;
use nastradamus39\slate\md\Action\Sample;

class Action
{

    public function parse(ApiAction $annotation) {

        $md = new MdAction();
        $md->controller = $annotation->controller;
        $md->title = $annotation->title;
        $md->description = $annotation->description;

        /** Parse code samples */
        if(!empty($annotation->samples)) {
            $md->samples=[];
            foreach ($annotation->samples as $sample) {
                $mdSample=new Sample();
                $mdSample->lang=$sample->lang;
                $mdSample->code=$sample->code;
                $md->samples[]=$mdSample;
            }
        }

        /** Parse action request */
        if(!empty($annotation->request)) {
            $md->request = (new RequestParser())->parse($annotation->request);
        }

        return $md;
    }


}