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

    const OK = 200;
    const BAD_REQUEST = 400;

    /**
     * App constructor.
     *
     * @param HTTPRequestInterface $httpRequest
     * @param HTTPResponseInterface $httpResponse
     * @param BracketFactory $bracketFactory
     */
    public function __construct(
        HTTPRequestInterface $httpRequest,
        HTTPResponseInterface $httpResponse,
        BracketFactory $bracketFactory
    )
    {
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
        $this->bracketFactory = $bracketFactory;
    }

    public function run(): void
    {
        try {
            $value = $this->httpRequest->getValue($this->key);
            $bracket = $this->bracketFactory->getBracket($value);

            if ($bracket->execute())
                $this->httpResponse->setHTTPStatusCode(self::OK)->setMessage("Brackets are set correctly");
            else
                $this->httpResponse->setHTTPStatusCode(self::BAD_REQUEST)->setMessage("Brackets are not set correctly");

        } catch (HTTPException $e) {
            $this->httpResponse->setHTTPStatusCode(self::BAD_REQUEST)->setMessage($e->getMessage());
        } catch (InvalidArgumentException $e) {
            $this->httpResponse->setHTTPStatusCode(self::BAD_REQUEST)->setMessage($e->getMessage());
        } finally {
            $this->httpResponse->send();
        }
    }

}