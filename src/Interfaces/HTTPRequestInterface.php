<?php

namespace WebServer\Interfaces;

use WebServer\Exceptions\InvalidArgumentHTTPException;
use WebServer\Exceptions\MethodIsForbiddenHTTPException;

interface HTTPRequestInterface
{
    /**
     * @param string $key
     *
     * @return string
     *
     * @throws MethodIsForbiddenHTTPException
     * @throws InvalidArgumentHTTPException
     */
    public function getValue(string $key): string;
}