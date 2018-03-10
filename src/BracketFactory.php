<?php

namespace WebServer;

use Library\Services\BracketService;

class BracketFactory
{
    /**
     * @param $string
     *
     * @return BracketService
     *
     * @throws \Library\Exceptions\InvalidArgumentException
     */
    public function getBracket(string $string): BracketService
    {
        return new BracketService($string);
    }
}