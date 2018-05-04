<?php

namespace WebServer;

use Library\Command\BracketCommand;
use Library\Interfaces\BracketCommandInterface;

class BracketFactory
{
    /**
     * @param string $string
     *
     * @return BracketCommandInterface
     */
    public function getBracket(string $string): BracketCommandInterface
    {
        return new BracketCommand($string);
    }
}