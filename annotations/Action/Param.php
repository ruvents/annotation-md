<?php

namespace nastradamus39\slate\annotations\Action;

/**
 * @Annotation
 * @Target("ALL")
 */
class Param
{
    public $title;

    public $type;

    public $defaultValue;

    public $description;
}

