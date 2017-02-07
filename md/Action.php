<?php

namespace nastradamus39\slate\md;

class Action
{

    public $id;

    public $controller;

    public $title = "";

    public $description = "";

    public $request = "";

    public $params = "";

    public function __toString()
    {

        $this->description = nl2br($this->description);
        $this->description=str_replace("  ","&nbsp;&nbsp;",$this->description);

        $content = "";
        /** title */
        $content .= "## ".$this->id.". ".$this->title."\n";

        /** description */
        $content .= $this->description."\n\n";

        /** Request */
        if(!empty($this->request)) {
            $content .= (string)$this->request;
        }

        $content .= "\n\n";

        return $content;
    }

}
