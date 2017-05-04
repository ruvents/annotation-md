<?php

namespace ruvents\slate\parser;

use ruvents\slate\annotations\ApiError;
use ruvents\slate\md\Error as MdError;

class Error
{

    public function parse(ApiError $annotation) {
        $md = new MdError();
        $md->code = $annotation->code;
        $md->description = $annotation->description;
        return $md;
    }

}