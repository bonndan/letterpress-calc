<?php

namespace Letterpress;

/**
 * Gang run per sheet calculation.
 * 
 */
class Layout
{
    private $sheet;
    private $gangrun;
    
    /**
     * Constructor.
     * 
     * @param \Letterpress\PaperSheet $sheet
     * @param \Letterpress\GangRun $gangrun
     */
    public function __construct(PaperSheet $sheet, GangRun $gangrun)
    {
        $this->sheet = $sheet;
        $this->gangrun = $gangrun;
    }
    
    /**
     * Calculates the number of possible gangruns.
     * 
     * @return int
     */
    public function getNumberOfGangRuns()
    {
        $lengthRuns  = floor($this->sheet->getLength() / $this->gangrun->getOuterLength());
        $widthRuns   = floor($this->sheet->getWidth() / $this->gangrun->getOuterWidth());
        
        if ($lengthRuns == 0) {
            throw new Exception ('Paper is not long enough: ' . $this->sheet->getLength() . 'mm vs. gang run of ' . $this->gangrun->getOuterLength());
        }
        
        if ($widthRuns == 0) {
            throw new Exception ('Paper is not wide enough:' . $this->sheet->getWidth() . 'mm vs. gang run of ' . $this->gangrun->getOuterWidth());
        }
        
        return $lengthRuns * $widthRuns;
    }
}
