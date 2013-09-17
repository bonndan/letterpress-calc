<?php

namespace Letterpress;

class Config
{
    private $papers = array();
    
    public function addPaper(Paper $paper)
    {
        $this->papers[] = $paper;
    }
}
