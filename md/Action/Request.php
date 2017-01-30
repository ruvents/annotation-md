<?php

namespace nastradamus39\slate\md\Action;

use nastradamus39\slate\md\MdConfig;

class Request
{

    public $method;

    public $url;

    public $body;

    public $params;

    public $response;

    public function __toString()
    {
        $config = MdConfig::getInstance();

        $this->method = empty($this->method) ? 'GET' : $this->method;

        if(!empty($this->url) ) {
            $content = "`".$this->method." ".$config->params['baseUrl'].$this->url."` \n";
        }

        if(!empty($this->body)) {
            $content .= "### Body\n";
            $content .= "`".$this->body."`\n";
        }

        if(!empty($this->params)) {
            $content.= "### Parameters\n";
            $content .= "Название | Тип | Значение по умолчанию | Описание\n";
            $content .= "-------- | --- | --------------------- | --------\n";
            foreach($this->params as $param) {
                $content .= " ".$param['title']." | ".$param['type']." | ".$param['defaultValue']." | ".$param['description']." \n";
            }
        }

        if(!empty($content)) {
            $content = "### Request \n".$content;
        }

        if(!empty($this->response)) {
            $resp = "```json\n";
            $resp .= $this->response."\n";
            $resp .= "```\n";
            $content = $resp.$content;
        }

        return $content;
    }

}
