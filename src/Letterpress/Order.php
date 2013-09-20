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
    
    public function __construct(Config $config)
    {
        $this->config = $config;
    }
    
    public function setForms($count)
    {
        $this->addPosition($count, 'Formen a €10,00', $count * 10.00);
    }
    
    public function setColors($count)
    {
        $this->addPosition($count, $count . ' Farben: Maschine waschen a €10,00', $count * 10.00);
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