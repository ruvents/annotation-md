<?php

namespace nastradamus39\slate\md;

class Content
{

    public $id;

    public $title;

    public $description;

    public function __toString()
    {
        $content = "";
        $content .= "# ".$this->id.". ".$this->title."\n\n";
        $content .= "<aside class='notice'>";
        $content .= $this->description;
        $content .= "</aside>";
        $content .= "\n\n";
        return $content;
    }

}
