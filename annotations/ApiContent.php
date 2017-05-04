<?php

namespace ruvents\slate\annotations;

/**
 * @Annotation
 * @Target("ALL")
 */
class ApiContent
{
    /**
     * @var string
     * @Required
     */
    public $title;

    /**
     * @var string
     * @required
     */
    public $description;
}

