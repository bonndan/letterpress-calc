<?php

namespace Letterpress;

class GangRunTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDefaultOuterLength()
    {
        $gangrun = new GangRun(100, 10);
        $this->assertEquals(130, $gangrun->getOuterLength());
    }
    
    public function testGetOuterLengthWithLoweredMargin()
    {
        $gangrun = new GangRun(100, 10);
        $gangrun->setMargin(10);
        $this->assertEquals(120, $gangrun->getOuterLength());
    }
    
    public function testGetOuterWidth()
    {
        $gangrun = new GangRun(100, 10);
        $this->assertEquals(40, $gangrun->getOuterWidth());
    }
    
    public function testGetOuterWidthWithLoweredMargin()
    {
        $gangrun = new GangRun(100, 10);
        $gangrun->setMargin(10);
        $this->assertEquals(30, $gangrun->getOuterWidth());
    }
    
    public function testFoldAlongLength()
    {
        $gangrun = new GangRun(100, 100);
        $gangrun->setFoldedDimensions(100, 50);
        $this->assertEquals(GangRun::FOLD_ALONG_LENGTH, $gangrun->getFold());
    }
    
    public function testFoldAlongWidth()
    {
        $gangrun = new GangRun(100, 100);
        $gangrun->setFoldedDimensions(50, 100);
        $this->assertEquals(GangRun::FOLD_ALONG_WIDTH, $gangrun->getFold());
    }
    
    public function testSetFoldedDimensionsException()
    {
        $gangrun = new GangRun(100, 100);
        $this->setExpectedException("\Letterpress\Exception");
        $gangrun->setFoldedDimensions(50, 50);
    }
    
    public function testNotFolded()
    {
        $gangrun = new GangRun(100, 100);
        $this->assertEquals(GangRun::FOLD_NONE, $gangrun->getFold());
    }
}