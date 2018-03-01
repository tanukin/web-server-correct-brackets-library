<?php

namespace WebServer;

use Library\Exceptions\InvalidArgumentException;
use WebServer\Exceptions\HTTPException;
use WebServer\Interfaces\AppInterface;
use WebServer\Interfaces\HTTPRequestInterface;
use WebServer\Interfaces\HTTPResponseInterface;

class App implements AppInterface
{
    /**
     * @var HTTPRequestInterface
     */
    private $httpRequest;

    /**
     * @var HTTPResponseInterface
     */
    private $httpResponse;

    /**
     * @var BracketFactory
     */
    private $bracketFactory;

    /**
     * @var string
     */
    private $key = "string";

    /**
     * App constructor.
     *
     * @param HTTPRequestInterface $httpRequest
     * @param HTTPResponseInterface $httpResponse
     * @param BracketFactory $bracketFactory
     */
    public function __construct(HTTPRequestInterface $httpRequest, HTTPResponseInterface $httpResponse, BracketFactory $bracketFactory)
    {
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->bracketFactory = $bracketFactory;
    }

    public function run()
    {
        try {
            $value = $this->httpRequest->getValue($this->key);
            $bracket = $this->bracketFactory->getBracket($value);

            if ($bracket->check())
                $this->httpResponse->setHTTPStatusCode(200)->setMessage("Brackets are set correctly");
            else
                $this->httpResponse->setHTTPStatusCode(400)->setMessage("Brackets are not set correctly");

        } catch (HTTPException $e) {
            $this->httpResponse->setHTTPStatusCode(400)->setMessage($e->getMessage());
        } catch (InvalidArgumentException $e) {
            $this->httpResponse->setHTTPStatusCode(400)->setMessage($e->getMessage());
        } finally {
            $this->httpResponse->send();
        }
    }

}