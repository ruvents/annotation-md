<?php

namespace nastradamus39\slate\annotations;

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

