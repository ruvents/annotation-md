<?php

namespace nastradamus39\slate\annotations\Action;

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
     * @var array nastradamus39\slate\annotations\Action\Param
     */
    public $params;

    /**
     * @var nastradamus39\slate\annotations\Action\Response
     */
    public $response;
}

