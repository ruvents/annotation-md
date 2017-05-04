<?php

namespace ruvents\slate\md;

class Content
{

    public $id;

    public $title;

    public $description;

    public function __toString()
    {

        $this->description = nl2br($this->description);
        $this->description=str_replace("  ","&nbsp;&nbsp;",$this->description);

        $content = "";
        $content .= "# ".$this->id.". ".$this->title."\n\n";
        $content .= "<aside class='notice'>";
        $content .= $this->description;
        $content .= "\n</aside>";
        $content .= "\n\n";
        return $content;
    }

}
