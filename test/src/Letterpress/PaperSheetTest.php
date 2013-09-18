<?php

namespace Letterpress;

class PapersheetTest extends \PHPUnit_Framework_TestCase
{
    public function testIsGrain()
    {
        $paper = new Papersheet('test', 700, 300, PaperSheet::LONG_GRAIN);
        $this->assertTrue($paper->isGrain(PaperSheet::LONG_GRAIN));
        $this->assertFalse($paper->isGrain(PaperSheet::SHORT_GRAIN));
    }
}