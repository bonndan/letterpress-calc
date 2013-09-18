<?php

namespace Letterpress;

class Config
{
    private $papers = array();
    
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
}
