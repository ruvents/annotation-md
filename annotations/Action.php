<?php

namespace nastradamus39\slate\annotations;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Action
{
    public $title;

    public $description;

    public $request;

    public $params;

}

