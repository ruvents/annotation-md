<?php

namespace ruvents\slate\md\Action;

class Sample
{
    public $lang;

    public $code;

    public function __toString()
    {
        $resp = "```{$this->lang}\n";
        $resp .= $this->code."\n";
        $resp .= "```\n";

        return $resp;
    }
}
