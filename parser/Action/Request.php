<?php

namespace nastradamus39\slate\parser\Action;

use nastradamus39\slate\annotations\Action\Request as RequestAnnotation;
use nastradamus39\slate\annotations\Action\Response;

use nastradamus39\slate\md\Action\Param as MdParam;
use nastradamus39\slate\md\Action\Request as MdRequest;
use nastradamus39\slate\md\Action\Response as MdResponse;

class Request
{

    public function parse(RequestAnnotation $annotation) {

        $md = new MdRequest();

        if(!is_string($annotation->method)) dd($annotation);

        $md->method = $annotation->method;
        $md->url = $annotation->url;
        $md->body = $annotation->body;

        /**
         * Parse response to md objects
         */
        if(!empty( $annotation->response )) {
            $mdResponse = new MdResponse();
            if($annotation->response instanceof Response) {
                $mdResponse->body = $annotation->response->body;
                $mdResponse->header = $annotation->response->header;
            }
            if(is_string($annotation->response)) {
                $mdResponse->body = $annotation->response;
            }
            $md->response=$mdResponse;
        }

        /**
         * Parse request params to md objects
         */
        if(!empty($annotation->params)) {
            foreach($annotation->params as $param) {
                $mdParam = new MdParam();
                $mdParam->type = $param->type;
                $mdParam->title = $param->title;
                $mdParam->description = $param->description;
                $mdParam->defaultValue = $param->defaultValue;
                $mdParam->mandatory = $param->mandatory;
                $md->addParam($mdParam);
            }
        }

        return $md;
    }

}