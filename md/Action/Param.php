<?php

namespace nastradamus39\slate\md\Action;

use nastradamus39\slate\md\MdConfig;

class Param
{

    public $title;

    public $type;

    public $defaultValue;

    public $description;

    public function values($fields)
    {

        $values = [];

        if(in_array('title', $fields))          $values[] = $this->title;
        if(in_array('type', $fields))           $values[] = $this->type;
        if(in_array('defaultValue', $fields))   $values[] = $this->defaultValue;
        if(in_array('description', $fields))    $values[] = $this->description;

        $content = implode(" | ", $values)."\n";
        return $content;
    }


    public function fields()
    {

        $fields = [];
        if(!empty($this->title))        $fields['title']='Название';
        if(!empty($this->type))         $fields['type']='Тип';
        if(!empty($this->description))  $fields['description']='Описание';
        if(!empty($this->defaultValue)) $fields['defaultValue']='Значение по умолчанию';

        return $fields;

    }

}
