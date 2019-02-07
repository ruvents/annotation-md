<?php

namespace ruvents\slate\md;

class Controller
{
    public $id;

    public $controller;

    public $title;

    public $description;

    private $actions = [];

    public function __toString()
    {
        $this->description = nl2br($this->description);
        $this->description = str_replace('  ', '&nbsp;&nbsp;', $this->description);

        $content = '';
        $content .= '# '.$this->id.'. '.$this->title."\n\n";

        /* description */
        $content .= $this->description."\n\n";

        if (!empty($this->actions)) {
            $i = 1;
            foreach ($this->actions as $action) {
                $action->id = $this->id.'.'.($i++);
                $content .= $action;
            }
        }

        return $content;
    }

    public function addAction(Action $action)
    {
        $this->actions[] = $action;
    }
}
