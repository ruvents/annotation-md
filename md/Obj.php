<?php

namespace ruvents\slate\md;

class Obj
{
    public $id;

    public $code;

    public $title;

    public $json;

    public $description;

    public $params;

    public function __toString()
    {
        $content = '';
        $content .= '## '.$this->id.'. '.$this->title."\n";
        $content .= $this->description."\n\n";

        // Object body
        $resp = $this->json;
        $resp = str_replace(["'", "\n", "\r", "\t"], ['"', '', '', ''], $resp);
        $resp = json_decode($resp);

        if (!json_last_error()) {
            $this->json = json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $resp = "\n";
        $resp .= "> Объект: \n\n";
        $resp .= "```json\n";
        $resp .= $this->json."\n";
        $resp .= "```\n\n";

        $content .= $resp;

        // params
        $content .= "Параметр | Описание\n";
        $content .= "-------- | --------\n";
        foreach ($this->params as $param => $paramDescription) {
            if (\is_string($param) && \is_string($paramDescription)) {
                $content .= implode(' | ', [$param, $paramDescription])."\n";
            }
        }
        $content .= "\n";

        return $content;
    }
}
