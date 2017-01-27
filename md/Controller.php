<?php

namespace nastradamus39\slate\md;

class Controller
{

    public $id;

    public $title;

    public $description;

    private $actions=[];

    public function addAction(Action $action) {
        $this->actions[]=$action;
    }

    public function __toString()
    {
        $content = "";
        $content .= "# ".$this->id.". ".$this->title."\n\n";

        /** description */
        $content .= $this->description."\n\n";

        if(!empty($this->actions)) {
            $i=1;
            foreach( $this->actions as $action) {
                $action->id = $this->id.".".strval($i++);
                $content .= $action->__toString();
            }
        }

        return $content;
    }

}
