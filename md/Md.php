<?php

namespace nastradamus39\slate\md;

class Md
{

    public $title = "";

    public $baseUrl = '';

    public $vars = [];

    public $tabs = ['json', 'javascript', 'php', 'shell', 'ruby', 'python'];

    public $search = false;

    public $contents = [];

    public $errors = [];

    private $controllers=[];

    public function addController(Controller $controller) {
        $this->controllers[md5($controller->controller)]=$controller;
    }

    public function addContent(Content $content){
        $this->contents[]=$content;
    }

    public function addError(Error $error){
        $this->errors[]=$error;
    }

    public function addAction(Action $action)
    {
        $this->controllers[md5($action->controller)]->addAction($action);
    }

    public function save($file) {
        file_put_contents($file, $this->__toString());
    }

    public function __toString()
    {
        MdConfig::$lastInsertMenu = 1;

        $content = "";
        $content .= "---\n";

        /** Main title */
        if(!empty($this->title)) {
            $content .= "title: ".$this->title."\n\n";
        }

        /** Language tabs */
        if(!empty($this->tabs)) {
            $content .= "language_tabs:\n";
            foreach($this->tabs as $tab) {
                $content .= "  - ".$tab."\n";
            }
            $content .= "\n";
        }

        /** Search */
        if($this->search) {
            $content .= "search: true\n";
        }

        $content .= "---\n";

        /** Contents blocks */
        if(!empty($this->contents)) {
            $content .= "\n";
            foreach($this->contents as $c){
                $c->id = strval(MdConfig::$lastInsertMenu++);
                $content .= $c->__toString();
            }
            $content .= "\n";
        }

        /** Controllers */
        if(!empty($this->controllers)) {
            $content .= "\n";
            foreach($this->controllers as $c){
                $c->id = strval(MdConfig::$lastInsertMenu++);
                $content .= (string)$c;
            }
            $content .= "\n";
        }


        /** Errors */
        if(!empty($this->errors)) {
            $content .= Error::toString($this->errors);
        }

        /** Replace all variables */
        foreach($this->vars as $var=>$val) {
            $content = preg_replace("/{{".$var."}}/", $val, $content);
        }

        return $content;
    }

}
