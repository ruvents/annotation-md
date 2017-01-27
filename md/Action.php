<?php

namespace nastradamus39\slate\md;

class MdAction
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
        $content .= "### Request \n";
        $content .= "`".$this->request."`\n\n";

        /** Params */
        $content .= "### Params \n";
        $content .= $this->params."\n\n";

        return $content;
    }

}
