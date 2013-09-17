<?php

namespace Letterpress;

class ArcTest extends \PHPUnit_Framework_TestCase
{
    public function testGetNumberOfGangRunsOnlyHorizontal()
    {
        $gangrun = new GangRun(100, 10, 0);
        $arc = new Arc();
        $arc->setWidth($gangrun->getOuterWidth());
        
        $this->assertEquals(7, $arc->getNumberOfGangRuns($gangrun));
    }
    
    public function testGetNumberOfGangRunsOnlyHorizontalWithGangrunMargin()
    {
        $gangrun = new GangRun(100, 10, 5);
        $arc = new Arc();
        $arc->setWidth($gangrun->getOuterWidth());
        
        $this->assertEquals(6, $arc->getNumberOfGangRuns($gangrun));
    }
    
    /**
     * 7*100 + 2*150
     */
    public function testGetNumberOfGangRuns()
    {
        $gangrun = new GangRun(100, 150, 0);
        $arc = new Arc();
        
        
        $this->assertEquals(14, $arc->getNumberOfGangRuns($gangrun));
    }
}