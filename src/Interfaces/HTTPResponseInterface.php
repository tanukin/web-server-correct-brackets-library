<?php

namespace WebServer\Interfaces;

interface HTTPResponseInterface
{
    public function setHTTPStatusCode(int $code): HTTPResponseInterface;
    public function setMessage(string $message): HTTPResponseInterface;
    public function send();
}