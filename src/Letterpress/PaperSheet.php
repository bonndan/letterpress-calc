<?php

namespace Letterpress;

/**
 * A paper sheet (Großbogen).
 * 
 * 
 */
class PaperSheet
{
    /**
     * Schmalbahn
     * @var string
     */
    const LONG_GRAIN  = 'LONG_GRAIN';
    
    /**
     * Breitbahn
     * @var string
     */
    const SHORT_GRAIN = 'SHORT_GRAIN';
    
    /**
     * name of the paper
     * 
     * @var string
     */
    private $name;
    
    /**
     * length in mm
     * 
     * @var int
     */
    private $length;
    
    /**
     * width in mm
     * @var int
     */
    private $width;
    
    /**
     * fiber long grain = schmalbahn
     * 
     * @var string
     */
    private $grain;
    
    /**
     * price per sheet
     * 
     * @var float
     */
    private $price;
    
    /**
     * Constructor.
     * 
     * @param string $name
     * @param int    $length
     * @param int    $width
     * @param string $grain
     * @param float  $price
     */
    public function __construct($name, $length, $width, $grain, $price = 0)
    {
        $this->name   = $name;
        $this->length = $length;
        $this->width  = $width;
        $this->grain  = $grain;
        $this->price  = $price;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function getWidth()
    {
        return $this->width;
    }
    
    /**
     * Returns the name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Check the grain type
     * 
     * @param string $grain
     * @return bool
     */
    public function isGrain($grain)
    {
        return $this->grain == $grain;
    }
    
    /**
     * Returns the price per sheet.
     * 
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * Returns a string representation.
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->name . ' ' . $this->length . 'mm x ' . $this->width . 'mm';
    }
}
