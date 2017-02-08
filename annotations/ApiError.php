<?php

namespace nastradamus39\slate\annotations;

/**
 * @Annotation
 * @Target("CLASS")
 */
class ApiError
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
    public $description;

}

