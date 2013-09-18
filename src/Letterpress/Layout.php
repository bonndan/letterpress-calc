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
        return $this->getLengthRuns() * $this->getWidthRuns();
    }

    /**
     * Returns the length waste in mm.
     * 
     * @return int
     */
    public function getLengthWaste()
    {
        $runs = $this->getLengthRuns();
        $diff = $this->sheet->getLength() - ($runs * $this->gangrun->getOuterLength());
        
        return $diff;
    }
    
    /**
     * Returns the width waste in mm.
     * 
     * @return int
     */
    public function getWidthWaste()
    {
        $runs = $this->getWidthRuns();
        $diff = $this->sheet->getWidth() - ($runs * $this->gangrun->getOuterWidth());
        
        return $diff;
    }

    private function getLengthRuns()
    {
        $lengthRuns = floor($this->sheet->getLength() / $this->gangrun->getOuterLength());
        if ($lengthRuns == 0) {
            throw new Exception('Paper is not long enough: ' . $this->sheet->getLength() . 'mm vs. gang run of ' . $this->gangrun->getOuterLength());
        }
        return $lengthRuns;
    }

    private function getWidthRuns()
    {
        $widthRuns = floor($this->sheet->getWidth() / $this->gangrun->getOuterWidth());
        if ($widthRuns == 0) {
            throw new Exception('Paper is not wide enough:' . $this->sheet->getWidth() . 'mm vs. gang run of ' . $this->gangrun->getOuterWidth());
        }
        return $widthRuns;
    }

}
