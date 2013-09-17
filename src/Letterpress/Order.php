<?php

namespace Letterpress;

class Order
{
    /**
     * paper arc
     * 
     * @var Arc
     */
    private $arc;
    
    private $colors;
    
    private $paper;
    
    public function getArc()
    {
        return $this->arc;
    }

    public function setArc(Arc $arc)
    {
        $this->arc = $arc;
    }

    public function getColors()
    {
        return $this->colors;
    }

    public function addColor(Color $color)
    {
        $this->colors[] = $color;
    }

    public function getPaper()
    {
        return $this->paper;
    }

    public function setPaper(Paper $paper)
    {
        $this->paper = $paper;
    }

}