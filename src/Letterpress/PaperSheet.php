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
     * Constructor.
     * 
     * @param string $name
     * @param int    $length
     * @param int    $width
     * @param string $grain
     */
    public function __construct($name, $length, $width, $grain)
    {
        $this->name   = $name;
        $this->length = $length;
        $this->width  = $width;
        $this->grain  = $grain;
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
     * Returns a string representation.
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->name . ' ' . $this->length . 'mm x ' . $this->width . 'mm ' . $this->grain;
    }
}
