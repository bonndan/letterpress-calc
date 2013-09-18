<?php

namespace Letterpress;

/**
 * A paper sheet (Großbogen).
 * 
 * 
 */
class PaperSheet
{
    const LONG_GRAIN  = 'LONG_GRAIN';
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
     * Calculates the number of possible gangruns.
     * 
     * @param \Letterpress\GangRun $gangrun
     * @return int
     */
    public function getNumberOfGangRuns(GangRun $gangrun)
    {
        $lengthRuns  = floor($this->length / $gangrun->getOuterLength());
        $widthRuns   = floor($this->width / $gangrun->getOuterWidth());
        
        if ($lengthRuns == 0) {
            throw new Exception ('Paper is not long enough: ' . $this->length . 'mm vs. gang run of ' . $gangrun->getOuterLength());
        }
        
        if ($widthRuns == 0) {
            throw new Exception ('Paper is not wide enough:' . $this->width . 'mm vs. gang run of ' . $gangrun->getOuterWidth());
        }
        
        return $lengthRuns * $widthRuns;
    }
}
