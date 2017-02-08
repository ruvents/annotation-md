<?php

namespace nastradamus39\slate\md\Action;

class Response
{

    public $header;

    public $body;

    public function __toString()
    {

        $resp = $this->body;
        $resp = str_replace("'", '"', $resp);
        $resp = str_replace("\n", '', $resp);
        $resp = str_replace("\r", '', $resp);
        $resp = str_replace("\t", '', $resp);
        $resp = json_decode($resp);

        if(!json_last_error()) {
            $this->body = json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $resp = "\n";
        $resp .= "```json\n";
        $resp .= $this->body."\n";
        $resp .= "```\n\n";

        return $resp;
    }

}




