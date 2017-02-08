<?php

namespace nastradamus39\slate\md;

class Error
{

    public $id;

    public $code;

    public $description;

    public function __toString()
    {
        $content = "d,mfsdfs";
        return $content;
    }

    static function toString($items)
    {

        $content = "\n";
        $content .= "# ".strval(MdConfig::$lastInsertMenu++).". Ошибки \n\n";
        $content .= "<aside class='notice'>\n";
        $content .= 'Описание ошибок';
        $content .= "\n</aside>";
        $content .= "\n\n";

        $content .= "Код ошибки | Описание\n";
        $content .= "---------- | --------\n";
        foreach($items as $error) {
            $content .= $error->code." | ".$error->description."\n";
        }

        return $content;

    }

}
