<?php

namespace nastradamus39\slate\annotations\Action;

/**
 * @Annotation
 * @Target("ALL")
 */
class Response
{
    /**
     * @var string
     */
    public $header;

    /**
     * @var string
     * @Required
     */
    public $body;
}

