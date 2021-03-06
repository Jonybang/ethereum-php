<?php

namespace EthereumPHP\Methods;

use EthereumPHP\Types\Address;
use EthereumPHP\Types\Transaction;
use EthereumPHP\Types\TransactionHash;

class Personal extends AbstractMethods
{
    /**
     * @return Address[]
     */
    public function listAccounts() {
        $addresses = [];
        $response = $this->client->send(
            $this->client->request(67, 'personal_listAccounts', [])
        );

        if (!$response->getRpcResult()) {
            return $addresses;
        }
        foreach ($response->getRpcResult() as $address) {
            $addresses[] = new Address($address);
        }

        return $addresses;
    }

    public function newAccount($password) {
        $response = $this->client->send(
            $this->client->request(67, 'personal_newAccount', [$password])
        );

        return new Address($response->getRpcResult());
    }

    public function unlockAccount(Address $address, $password, $duration = null) {
        $response = $this->client->send(
            $this->client->request(67, 'personal_unlockAccount', [$address->toString(), $password, $duration])
        );

        return $response->getRpcResult();
    }

    public function sendTransaction(Transaction $transaction, $password) {
        $response = $this->client->send(
            $this->client->request(1, 'personal_sendTransaction', [$transaction->toArray(), $password])
        );

        return new TransactionHash($response->getRpcResult());

    }
}
