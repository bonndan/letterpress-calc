<?php

namespace Letterpress;

/**
 * A paper arc.
 * 
 * 
 */
class Arc
{
    /**
     * length in mm
     * 
     * @var int
     */
    private $length = 700;
    
    /**
     * width in mm
     * @var int
     */
    private $width = 300;
    
    /**
     * non-printable area (mm)
     * 
     * @var int
     */
    private $margin = 0;
    
    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = (int)$length;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = (int)$width;
    }
    
    /**
     * Calculates the number of possible gangruns.
     * 
     * @param \Letterpress\GangRun $gangrun
     * @return int
     */
    public function getNumberOfGangRuns(GangRun $gangrun)
    {
        $innerLength = $this->length - $this->margin;
        $innerWidth  = $this->width  - $this->margin;
        
        $lengthRuns  = floor($innerLength / $gangrun->getOuterLength());
        $widthRuns   = floor($innerWidth) / $gangrun->getOuterWidth();
        
        return $lengthRuns * $widthRuns;
    }
}
