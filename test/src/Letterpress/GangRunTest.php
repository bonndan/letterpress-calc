<?php

namespace Letterpress;

class GangRunTest extends \PHPUnit_Framework_TestCase
{
    public function testGetOuterLength()
    {
        $gangrun = new GangRun(100, 10, 10);
        $this->assertEquals(120, $gangrun->getOuterLength());
    }
    
    public function testGetOuterWidth()
    {
        $gangrun = new GangRun(100, 10, 10);
        $this->assertEquals(30, $gangrun->getOuterWidth());
    }
}