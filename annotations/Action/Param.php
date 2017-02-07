<?php

namespace nastradamus39\slate\annotations\Action;

/**
 * @Annotation
 * @Target("ALL")
 */
class Param
{
    /**
     * @var string
     * @Required
     */
    public $title;

    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $defaultValue;

    /**
     * @var string
     */
    public $description;
}

