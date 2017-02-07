<?php

namespace nastradamus39\slate\annotations;

/**
 * @Annotation
 * @Target("CLASS")
 */
class ApiController
{
    public $controller;

    public $title;

    public $description;
}

