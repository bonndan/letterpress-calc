<?php
namespace Letterpress;

/**
 * Position on an order
 */
class Position
{
    public $count;
    public $description;
    public $price;
    public $total;
    
    /**
     * 
     * @param int    $count
     * @param string $description
     * @param float  $price per unit
     */
    public function __construct($count, $description, $price)
    {
        $this->count       = $count;
        $this->description = $description;
        $this->price       = $price;
        $this->total       = $count * $price;
    }
}