<?php

namespace nastradamus39\slate\parser;

use nastradamus39\slate\annotations\ApiError;
use nastradamus39\slate\md\Error as MdError;

class Error
{

    public function parse(ApiError $annotation) {
        $md = new MdError();
        $md->code = $annotation->code;
        $md->description = $annotation->description;
        return $md;
    }

}