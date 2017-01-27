<?php

namespace nastradamus39\slate\md;

class Md
{

    public $title = "Main title";

    public $language_tabs = ['json','php'];

    public $search = true;

    public $contents = [];

    private $controllers=[];

    public function addController(Controller $controller) {
        $this->controllers[]=$controller;
    }

    public function addContent(Content $content){
        $this->contents[]=$content;
    }

    public function save($file) {
        file_put_contents($file, $this->__toString());
    }

    public function __toString()
    {
        $i=1;
        $content = "";
        $content .= "---\n";

        /** Main title */
        if(!empty($this->title)) {
            $content .= "title: ".$this->title."\n\n";
        }

        /** Language tabs */
        if(!empty($this->language_tabs)) {
            $content .= "language_tabs:\n";
            foreach($this->language_tabs as $tab) {
                $content .= "  - ".$tab."\n";
            }
            $content .= "\n";
        }

        /** Search */
        if($this->search) {
            $content .= "search: true\n";
        }

        $content .= "---\n";

        /** Controllers */
        if(!empty($this->controllers)) {
            $content .= "\n";
            foreach($this->controllers as $c){
                $c->id = strval($i++);
                $content .= $c->__toString();
            }
            $content .= "\n";
        }

        /** Contents blocks */
        if(!empty($this->contents)) {
            $content .= "\n";
            foreach($this->contents as $c){
                $c->id = strval($i++);
                $content .= $c->__toString();
            }
            $content .= "\n";
        }

        return $content;
    }

}
