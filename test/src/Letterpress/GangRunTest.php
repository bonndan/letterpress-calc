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
}