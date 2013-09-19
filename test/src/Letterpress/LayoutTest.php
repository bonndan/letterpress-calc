<?php

namespace Letterpress;

class LayoutTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNumberOfGangRunsOnlyHorizontal()
    {
        $gangrun = new GangRun(100, 10);
        $gangrun->setMargin(0);
        $paper = new PaperSheet('test', 700, 10, PaperSheet::SHORT_GRAIN);
        
        $this->assertEquals(7, $this->calculate($paper, $gangrun));
    }
    
    public function testGetNumberOfGangRunsOnlyHorizontalWithGangrunMargin()
    {
        $gangrun = new GangRun(100, 10);
        $paper = new PaperSheet('test', 700, 40, PaperSheet::SHORT_GRAIN);
        
        $this->assertEquals(5, $this->calculate($paper, $gangrun));
    }
    
    public function testPaperIsNotLongEnough()
    {
        $gangrun = new GangRun(100, 10);
        $paper = new PaperSheet('test', 100, 100, PaperSheet::SHORT_GRAIN);
        
        $this->setExpectedException("\Letterpress\Exception");
        $this->calculate($paper, $gangrun);
    }
    
    public function testPaperIsNotWideEnough()
    {
        $gangrun = new GangRun(50, 50);
        $paper = new PaperSheet('test', 100, 50, PaperSheet::SHORT_GRAIN);
        
        $this->setExpectedException("\Letterpress\Exception");
        $this->calculate($paper, $gangrun);
    }
    
    /**
     * 7*100 + 2*150
     */
    public function testGetNumberOfGangRuns()
    {
        $gangrun = new GangRun(100, 150);
        $gangrun->setMargin(0);
        $paper = new PaperSheet('test', 700, 300, PaperSheet::SHORT_GRAIN);
        
        $this->assertEquals(14, $this->calculate($paper, $gangrun));
    }
    
    public function testGetLengthWaste()
    {
        $gangrun = new GangRun(80, 150);
        $gangrun->setMargin(0);
        $paper = new PaperSheet('test', 100, 300, PaperSheet::SHORT_GRAIN);
        $layout = $this->createLayout($paper, $gangrun);
        
        $this->assertEquals(20, $layout->getLengthWaste());
    }
    
    public function testGetWidthWaste()
    {
        $gangrun = new GangRun(100, 80);
        $gangrun->setMargin(0);
        $paper = new PaperSheet('test', 100, 100, PaperSheet::SHORT_GRAIN);
        $layout = $this->createLayout($paper, $gangrun);
        
        $this->assertEquals(20, $layout->getWidthWaste());
    }
    
    /**
     * Short grain: grain parallel to length
     */
    public function testFoldingIsPossible()
    {
        $gangrun = new GangRun(100, 80);
        $gangrun->setFoldedDimensions(50, 80);
        //just to be sure
        $this->assertEquals(GangRun::FOLD_ALONG_WIDTH, $gangrun->getFold());
        
        $paper = new PaperSheet('test', 100, 100, PaperSheet::SHORT_GRAIN);

        $this->setExpectedException(null);
        $this->createLayout($paper, $gangrun);
    }
    
    /**
     * Short grain: grain parallel to length
     * Fold along length => with grain
     */
    public function testFoldingIsNotPossibleWithShortGrain()
    {
        $gangrun = new GangRun(100, 80);
        $gangrun->setFoldedDimensions(100, 40);
        //just to be sure
        $this->assertEquals(GangRun::FOLD_ALONG_LENGTH, $gangrun->getFold());
        
        $paper = new PaperSheet('test', 100, 100, PaperSheet::SHORT_GRAIN);

        $this->setExpectedException("\Letterpress\Exception");
        $this->createLayout($paper, $gangrun);
    }
    
    /**
     * long grain: grain parallel to width
     * Fold along width => with grain
     */
    public function testFoldingIsNotPossibleWithLongGrain()
    {
        $gangrun = new GangRun(100, 80);
        $gangrun->setFoldedDimensions(50, 80);
        //just to be sure
        $this->assertEquals(GangRun::FOLD_ALONG_WIDTH, $gangrun->getFold());
        
        $paper = new PaperSheet('test', 100, 100, PaperSheet::LONG_GRAIN);

        $this->setExpectedException("\Letterpress\Exception");
        $this->createLayout($paper, $gangrun);
    }
    
    /**
     * Creates a layout.
     * 
     * @param \Letterpress\PaperSheet $paper
     * @param \Letterpress\GangRun $gangrun
     * @return \Letterpress\Layout
     */
    private function createLayout(PaperSheet $paper, GangRun $gangrun)
    {
        $layout = new Layout($paper, $gangrun);
        return $layout;
    }
    
    /**
     * Calculates the number of gang runs.
     * 
     * @param \Letterpress\PaperSheet $paper
     * @param \Letterpress\GangRun $gangrun
     * @return int
     */
    private function calculate(PaperSheet $paper, GangRun $gangrun)
    {
        return $this->createLayout($paper, $gangrun)->getNumberOfGangRuns();
    }
}