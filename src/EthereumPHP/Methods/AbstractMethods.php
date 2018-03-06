<?php

namespace EthereumPHP\Methods;

use Graze\GuzzleHttp\JsonRpc\ClientInterface;

abstract class AbstractMethods
{
    public $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
