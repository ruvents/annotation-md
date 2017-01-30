<?php

namespace nastradamus39\slate\annotations\Action;

/**
 * @Annotation
 * @Target("ALL")
 */
class Request
{
    public $method;

    public $url;

    public $body;

    public $params;

    public $response;
}

