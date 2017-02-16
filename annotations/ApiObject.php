<?php

namespace nastradamus39\slate\annotations;

/**
 * @Annotation
 * @Target("ALL")
 */
class ApiObject
{
    /**
     * @var string
     * @Required
     */
    public $code;

    /**
     * @var string
     * @Required
     */
    public $title;

    /**
     * @var string
     */
    public $json;

    /**
     * @var string
     * @Required
     */
    public $description;


    public $params;

}

