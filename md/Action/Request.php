<?php

namespace nastradamus39\slate\md\Action;

use api\components\Exception;
use nastradamus39\slate\md\MdConfig;

class Request
{

    public $method;

    public $url;

    public $body;

    public $response;

    private $_params;

    public function addParam(Param $param)
    {
        $this->_params[] = $param;
    }

    public function __toString()
    {
        $content = $this->_buildResponse();
        $content .= $this->_buildUrl();
        $content .= $this->_buildBody();
        $content .= $this->_buildParams();
        return $content;
    }

    private function _buildBody()
    {
        $content = '';
        if(!empty($this->body)) {
            $content .= "### Body\n";
            $content .= "`".$this->body."`\n";
        }
        return $content;
    }

    private function _buildParams()
    {
        $content = "";
        if(!empty($this->_params)) {
            $content.= "### Parameters\n";
            $content.= Param::table($this->_params);
        }
        return $content;
    }

    private function _buildResponse()
    {
        $content = "";
        if(!empty($this->response) && !empty($this->response->body)) {
            $content .= (string)$this->response;
        }
        return $content;
    }

    private function _buildUrl()
    {
        $content = "";
        $config = MdConfig::getInstance();
        $this->method = empty($this->method) ? 'GET' : $this->method;
        if(!empty($this->url) ) {
            $content = "`".$this->method." ".$config->params['baseUrl'].$this->url."` \n";
        }
        return $content;
    }

    private function _buildCurlString()
    {
        $config = MdConfig::getInstance();
        $curl = "\n```shell\n";
        $curl .= "$ curl -X ".$this->method." ".$config->params['baseUrl'].$this->url."\n";
        $curl .= "```\n\n";
        return $curl;
    }

}
