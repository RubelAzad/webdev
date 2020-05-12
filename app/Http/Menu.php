<?php
/**
 * Created by PhpStorm.
 * User: bashet
 * Date: 01/09/2018
 * Time: 18:40
 */

namespace App\Http;


class Menu
{
    public $position;
    public $icon = '';
    public $link;
    public $text;
    public $active = 0;
    public $children = '';
    public $ability;
    public $class;

    public function __construct($position, $text, $link = '', $ability = '', $class = '', $icon = '', $children = '', $active = 0){
        $this->position = $position;
        $this->text = $text;
        $this->link = $link;
        $this->icon = $icon;
        $this->active = $active;

        if($children){
            $this->children = $children;
        }else{
            $this->children = collect();
        }

        $this->ability = $ability;
        $this->class = $class;

    }

}
