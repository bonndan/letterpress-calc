<?php

namespace Letterpress;

class Paper
{
    /**
     * fibers transversal?
     * 
     * @var boolean
     */
    private $transverse = false;
    
    /**
     * Check if paper fibers are transversal to longer side
     * 
     * @return bool
     */
    public function isTransversal()
    {
        return $this->transverse;
    }
}
