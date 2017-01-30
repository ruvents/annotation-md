<?php

namespace nastradamus39\slate\md;

class Action
{

    public $id;

    public $title = "";

    public $description = "";

    public $request = "";

    public $params = "";

    public function __toString()
    {
        $content = "";
        /** title */
        $content .= "## ".$this->id.". ".$this->title."\n";

        /** description */
        $content .= $this->description."\n\n";

        /** Request */
        $content .= $this->request->__toString();

        $content .= "\n\n";

        return $content;
    }

}
