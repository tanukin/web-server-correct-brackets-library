<?php

namespace WebServer;

use WebServer\Exceptions\InvalidArgumentHTTPException;
use WebServer\Exceptions\MethodIsForbiddenHTTPException;
use WebServer\Interfaces\HTTPRequestInterface;

class HTTPRequest implements HTTPRequestInterface
{
    /**
     * @param string $key
     *
     * @return string
     *
     * @throws MethodIsForbiddenHTTPException
     * @throws InvalidArgumentHTTPException
     */
    public function getValue(string $key): string
    {
        if (!$this->isPost())
            throw new MethodIsForbiddenHTTPException('Only use the POST method');

        if (!$this->issetKey($key))
            throw new InvalidArgumentHTTPException(sprintf('%s argument not passed', $key));

        return $_POST[$key];
    }

    /**
     * @return bool
     */
    private function isPost(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * @param $key
     *
     * @return bool
     */
    private function issetKey($key): bool
    {
        return array_key_exists($key, $_POST);
    }
}