<?php

namespace Letterpress;

class Order
{
    /**
     * configuration
     * 
     * @var Config
     */
    private $config;
    
    /**
     * positions
     * 
     * @var Position[]
     */
    private $positions = array();
    
    private $paper;
    
    /**
     * Constructor.
     * 
     * @param \Letterpress\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->addPosition(1, 'Rüsten (1h)', $this->config->getPricePerHour());
    }
    
    /**
     * Puts the number of sheets on order.
     * 
     * @param \Letterpress\PaperSheet $paper
     * @param int $prints
     * @param \Letterpress\Layout $layout1
     * @param \Letterpress\Layout $layout2
     */
    public function countSheets(PaperSheet $paper, $prints, Layout $layout1 = null, Layout $layout2 = null)
    {
        $this->paper = $paper;
        $count1 = $layout1 ? $layout1->getNumberOfGangRuns() : 0;
        $count2 = $layout2 ? $layout2->getNumberOfGangRuns() : 0;
        $perSheet = max($count1, $count2);
        
        $requiredSheets = ceil($prints / $perSheet);
        $this->addPosition($requiredSheets, ' Bögen bei ' . $perSheet . '/Bogen', $paper->getPrice());
    }
    
    public function setForms($count)
    {
        $this->addPosition($count, 'Formen', 10.00);
    }
    
    public function setColors($count)
    {
        $this->addPosition($count, $count . ' Farben: Maschine waschen a €10,00', 10.00);
    }
    
    /**
     * add a position
     * 
     * @param string $description
     * @param float  $price
     */
    private function addPosition($count, $description, $price)
    {
        $this->positions[] = new Position($count, $description, $price);
    }
    
    /**
     * Returns all positions.
     * 
     * @return Position[]
     */
    public function getPositions()
    {
        return $this->positions;
    }
}