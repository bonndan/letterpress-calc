<?php

namespace Letterpress;

class Config
{
    /**
     * papers
     * 
     * @var PaperSheet[]
     */
    private $papers = array();
    
    /**
     * costs per hour
     * @var float 
     */
    private $pricePerHour = 40.00;
    
    /**
     * Add a paper type.
     * 
     * @param PaperSheet $paper
     */
    public function addPaper(PaperSheet $paper)
    {
        $this->papers[] = $paper;
    }
    
    /**
     * Returns the available papers.
     * 
     * @return PaperSheet[]
     */
    public function getPapers()
    {
        return $this->papers;
    }
    
    public function setPricePerHour($price)
    {
        $this->pricePerHour = $price;
    }
    
    public function getPricePerHour()
    {
        return $this->pricePerHour;
    }
}
