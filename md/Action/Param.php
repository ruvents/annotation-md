<?php

namespace nastradamus39\slate\md\Action;

use nastradamus39\slate\md\MdConfig;

class Param
{

    public $title;

    public $type;

    public $defaultValue;

    public $description;

    public $mandatory;

    static $fields = [
        'title'         => 'Название',
        'type'          => 'Тип',
        'description'   => 'Описание',
        'defaultValue'  => 'Значение по умолчанию',
        'mandatory'     => 'Обязательно'
    ];

    public function values()
    {
        $values = [];
        foreach($this->fields as $key=>$title) {
            if (!empty($this->$key) ) {
                $values[$key]=$title;
            }
        }
        return $values;
    }

    public static function table($params = [])
    {
        $content = "";
        $fields=[];
        $allFields = self::$fields;
        if(sizeof($params)) {

            // столбцы таблицы
            foreach (self::$fields as $field=>$fieldTitle) {
                foreach($params as $param) {
                    if( !empty($param->$field) && !in_array($field, $fields) ) {
                        $fields[]=$field;
                    }
                }
            }

            // шапка таблицы.
            $th = [];
            $_th=[];
            array_walk($fields, function ($a) use ($allFields, &$th, &$_th) {
                $th[]=$allFields[$a];
                $_th[]=str_repeat("-", mb_strlen($allFields[$a]));
            });

            // строки таблицы
            $rows = [];
            foreach ($params as $param){
                $row=[];
                foreach($fields as $field ) {
                    $row[$field] = !empty($param->$field) ? $param->$field : '';
                }
                $rows[] = implode(" | ", $row);
            }

            $content .= implode(" | ", $th)."\n";
            $content .= implode(" | ", $_th)."\n";
            $content .= implode("\n", $rows)."\n";
        }

        return $content;
    }

    public static function assocArray($params = [])
    {
        $_params = [];
        if(sizeof($params)) {
            foreach ($params as $param) {
                $_params[$param->title]="value";
            }
        }
        return $_params;
    }

}
