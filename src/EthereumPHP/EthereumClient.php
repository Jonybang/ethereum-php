<?php

namespace EthereumPHP;

use EthereumPHP\Methods\Eth;
use EthereumPHP\Methods\Net;
use EthereumPHP\Methods\Personal;
use EthereumPHP\Methods\Shh;
use EthereumPHP\Methods\Web3;
use Graze\GuzzleHttp\JsonRpc\Client;

class EthereumClient
{
    private $client;
    private $methods = [];

    public function __construct($url)
    {
        $this->client = Client::factory($url);
        $this->methods = [
            'net' => new Net($this->client),
            'eth' => new Eth($this->client),
            'shh' => new Shh($this->client),
            'web3' => new Web3($this->client),
            'personal' => new Personal($this->client),
        ];
    }

    public function net() {
        return $this->methods['net'];
    }

    public function web3() {
        return $this->methods['web3'];
    }

    public function shh() {
        return $this->methods['shh'];
    }

    public function eth() {
        return $this->methods['eth'];
    }

    public function personal() {
        return $this->methods['personal'];
    }
}
