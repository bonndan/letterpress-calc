<?php

namespace Letterpress;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Ensures that the order throws an exception if the end format is larger
     * than the selected paper.
     */
    public function testCountSheetsThrowsNonPrintableException()
    {
        $paper = new PaperSheet('name', 700, 1000, PaperSheet::LONG_GRAIN, 0);
        $config = new Config();
        $config->addPaper($paper);
        $order = new Order($config);
        
        $this->setExpectedException("\Letterpress\Exception");
        $order->countSheets($paper, 30);
    }
}