<?php

namespace Letterpress;

class PapersheetTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNumberOfGangRunsOnlyHorizontal()
    {
        $gangrun = new GangRun(100, 10);
        $gangrun->setMargin(0);
        $paper = new PaperSheet('test', 700, 10, PaperSheet::SHORT_GRAIN);
        
        $this->assertEquals(7, $paper->getNumberOfGangRuns($gangrun));
    }
    
    public function testGetNumberOfGangRunsOnlyHorizontalWithGangrunMargin()
    {
        $gangrun = new GangRun(100, 10);
        $paper = new PaperSheet('test', 700, 40, PaperSheet::SHORT_GRAIN);
        
        $this->assertEquals(5, $paper->getNumberOfGangRuns($gangrun));
    }
    
    public function testPaperIsNotLongEnough()
    {
        $gangrun = new GangRun(100, 10);
        $paper = new PaperSheet('test', 100, 100, PaperSheet::SHORT_GRAIN);
        
        $this->setExpectedException("\Letterpress\Exception");
        $paper->getNumberOfGangRuns($gangrun);
    }
    
    public function testPaperIsNotWideEnough()
    {
        $gangrun = new GangRun(50, 50);
        $paper = new PaperSheet('test', 100, 50, PaperSheet::SHORT_GRAIN);
        
        $this->setExpectedException("\Letterpress\Exception");
        $paper->getNumberOfGangRuns($gangrun);
    }
    
    /**
     * 7*100 + 2*150
     */
    public function testGetNumberOfGangRuns()
    {
        $gangrun = new GangRun(100, 150);
        $gangrun->setMargin(0);
        $paper = new PaperSheet('test', 700, 300, PaperSheet::SHORT_GRAIN);
        
        $this->assertEquals(14, $paper->getNumberOfGangRuns($gangrun));
    }
}