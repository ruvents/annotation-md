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
     * @var \ruvents\slate\annotations\Action\Param[]
     */
    public $params;

    /**
     * @var \ruvents\slate\annotations\Action\Response
     */
    public $response;
}
