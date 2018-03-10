<?php

namespace WebServer;

use WebServer\Interfaces\HTTPResponseInterface;

class HTTPResponse implements HTTPResponseInterface
{
    /**
     * @var int
     */
    private $codeStatus;

    /**
     * @var string
     */
    private $message;

    /**
     * @param int $code
     *
     * @return HTTPResponseInterface
     */
    public function setHTTPStatusCode(int $code): HTTPResponseInterface
    {
        $this->codeStatus = $code;

        return $this;
    }

    /**
     * @param string $message
     *
     * @return HTTPResponseInterface
     */
    public function setMessage(string $message): HTTPResponseInterface
    {
        $this->message = $message;

        return $this;
    }

    public function send(): void
    {
        http_response_code($this->codeStatus);
        echo $this->message;
    }
}