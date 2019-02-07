<?php

namespace ruvents\slate\annotations\Action;

/**
 * @Annotation
 * @Target("ALL")
 */
class Request
{
    /**
     * @Enum({"GET", "POST", "DELETE", "UPDATE"})
     * @Required
     */
    public $method;

    /**
     * @var string
     * @Required
     */
    public $url;

    /**
     * @var string
     */
    public $body;

    /**
     * @var Param[]
     */
    public $params;

    /**
     * @var Response
     */
    public $response;
}
