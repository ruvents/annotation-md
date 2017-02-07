<?php

namespace nastradamus39\slate\annotations;

/**
 * @Annotation
 * @Target("METHOD")
 */
class ApiAction
{

    /**
     * @var string
     * @Required
     */
    public $controller;

    /**
     * @var string
     * @Required
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var nastradamus39\slate\annotations\Action\Request
     */
    public $request;

    /**
     * @var array nastradamus39\slate\annotations\Action\Param
     */
    public $params;

}

