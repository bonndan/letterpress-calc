<?php

namespace Letterpress;

class Color
{
    /**
     * name of the color
     * 
     * @var string
     */
    private $name;
    
    public function __construct($name)
    {
        $this->name = $name;
    }
    
    public function __toString()
    {
        return $this->name;
    }
}
