<?php

namespace ruvents\slate\annotations;

use ruvents\slate\annotations\Action\Param;
use ruvents\slate\annotations\Action\Request;
use ruvents\slate\annotations\Action\Sample;

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
     * @var Request
     */
    public $request;

    /**
     * @var Param[]
     */
    public $params;

    /**
     * @var Sample[]
     */
    public $samples;
}
