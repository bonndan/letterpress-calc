<?php

namespace Letterpress;

/**
 * Gang run per sheet calculation.
 * 
 */
class Layout
{
    /**
     * the sheet 
     * 
     * @var PaperSheet
     */
    private $sheet;
    
    /**
     * single gang run
     * 
     * @var GangRun 
     */
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
        $this->assertFoldingIsPossible();
    }

    /**
     * Asserts that folding is possible with the given grain.
     * 
     * 
     */
    private function assertFoldingIsPossible()
    {
        $fold = $this->gangrun->getFold();
        if ($fold == GangRun::FOLD_NONE) {
            return;
        }
        
        if ($this->sheet->isGrain(PaperSheet::SHORT_GRAIN) && $fold == GangRun::FOLD_ALONG_LENGTH) {
            throw new Exception('Short grain paper prohibits folding along length', 500);
        }
        
        if ($this->sheet->isGrain(PaperSheet::LONG_GRAIN) && $fold == GangRun::FOLD_ALONG_WIDTH) {
            throw new Exception('Long grain paper prohibits folding along width', 500);
        }
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
