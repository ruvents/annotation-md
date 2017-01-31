<?php

namespace nastradamus39\slate\annotations;

/**
 * @Annotation
 * @Target("METHOD")
 */
class ApiAction
{
    public $title;

    public $description;

    public $request;

    public $params;

}

