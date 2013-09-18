<?php

namespace Letterpress;

/**
 * A gang run (multiple prints per arc).
 * 
 * 
 */
class GangRun
{
    /**
     * margin per side (mm)
     * 
     * @var int
     */
    private $margin = 15;
    
    /**
     * longer side (mm)
     * 
     * @var int
     */
    private $length = 0;
    
    /**
     * shorter side (mm)
     * 
     * @var int
     */
    private $width = 0;
    
    /**
     * Constructor.
     * 
     * @param int $length
     * @param int $width
     */
    public function __construct($length, $width)
    {
        if ($length < 0 || $width < 0) {
            throw new \InvalidArgumentException('Length and width must be greater than zero.');
        }
        
        $this->length = $length;
        $this->width  = $width;
    }
    
    /**
     * Returns the gangrun with flipped width and height.
     * 
     * @return \Letterpress\GangRun
     */
    public function rotate()
    {
        return new GangRun($this->width, $this->length);
    }
    
    /**
     * Returns the length
     * 
     * @return int
     */
    public function getInnerLength()
    {
        return $this->length;
    }
    
    /**
     * Returns the width
     * 
     * @return int
     */
    public function getInnerWidth()
    {
        return $this->width;
    }
    
    /**
     * Returns the length plus margins
     * 
     * @return int
     */
    public function getOuterLength()
    {
        return $this->length + 2 * $this->margin;
    }
    
    /**
     * Returns the width plus margins
     * 
     * @return int
     */
    public function getOuterWidth()
    {
        return $this->width + 2 * $this->margin;
    }
    
    /**
     * Returns the margin in mm
     * 
     * @return int
     */
    public function getMargin()
    {
        return $this->margin;
    }
    
    /**
     * Set the margin.
     * 
     * @param int $margin
     */
    public function setMargin($margin)
    {
        $this->margin = $margin;
    }
}
