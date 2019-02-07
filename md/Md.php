<?php

namespace ruvents\slate\md;

class Md
{
    public $title = '';

    public $baseUrl = '';

    public $vars = [];

    public $tabs = ['shell: cURL', 'php'];

    public $search = false;

    public $contents = [];

    public $objects = [];

    public $errors = [];

    private $controllers = [];

    public function __toString()
    {
        MdConfig::$lastInsertMenu = 1;

        $_vars = [];

        $content = '';
        $content .= "---\n";

        /* Main title */
        if (!empty($this->title)) {
            $content .= 'title: '.$this->title."\n\n";
        }

        /* Language tabs */
        if (!empty($this->tabs)) {
            $content .= "language_tabs:\n";
            foreach ($this->tabs as $tab) {
                $content .= '  - '.$tab."\n";
            }
            $content .= "\n";
        }

        /* Search */
        if ($this->search) {
            $content .= "search: true\n";
        }

        $content .= "---\n";

        /* Contents blocks */
        if (!empty($this->contents)) {
            $content .= "\n";
            foreach ($this->contents as $c) {
                $c->id = (string) (MdConfig::$lastInsertMenu++);
                $content .= $c->__toString();
            }
            $content .= "\n";
        }

        /* Objects description block */
        if (!empty($this->objects)) {
            $content .= '# '.MdConfig::$lastInsertMenu.". Описание объектов\n\n";
            $i = 1;
            foreach ($this->objects as $c) {
                $c->id = (string) (MdConfig::$lastInsertMenu.'.'.$i++);
                $content .= $c->__toString();
                $objCode = '{$'.$c->code.'}';
                $objLink = 'LNK['.$c->title.'](#'.str_replace('.', '-', $c->id).')';
                $_vars[$objCode] = $objLink;
            }
            $content .= "\n";
            ++MdConfig::$lastInsertMenu;
        }

        /* Controllers */
        if (!empty($this->controllers)) {
            $content .= "\n";
            foreach ($this->controllers as $c) {
                $c->id = (string) (MdConfig::$lastInsertMenu++);
                $content .= $c;
            }
            $content .= "\n";
        }

        /* Errors */
        if (!empty($this->errors)) {
            $content .= Error::toString($this->errors);
        }

        /* Replace all variables */
        foreach ($this->vars as $var => $val) {
            $content = preg_replace('/{{'.$var.'}}/', $val, $content);
        }
        foreach ($_vars as $var => $val) {
            $content = str_replace($var, $val, $content);
        }

        // script for replace links
        $content .= "\n\n";
        $content .= '<script>$(document).ready(function(){$("pre").each(function(a,b){var c=$(b).html();c=c.replace(/LNK\[([^\]\n]+)\]\(([^\)\n]+)\)/g,\'<a href="$2">$1</a>\'),$(b).html(c)})});</script>';

        return $content;
    }

    public function addController(Controller $controller)
    {
        $this->controllers[md5($controller->controller)] = $controller;
    }

    public function addContent(Content $content)
    {
        $this->contents[] = $content;
    }

    public function addObject(Obj $obj)
    {
        $this->objects[] = $obj;
    }

    public function addError(Error $error)
    {
        $this->errors[] = $error;
    }

    public function addAction(Action $action)
    {
        $this->controllers[md5($action->controller)]->addAction($action);
    }

    public function save($file)
    {
        file_put_contents($file, $this->__toString());
    }
}
