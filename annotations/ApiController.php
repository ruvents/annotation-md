<?php

namespace ruvents\slate\annotations;

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
