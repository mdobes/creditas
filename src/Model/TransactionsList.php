<?php

namespace mdobes\Creditas\Model;

class TransactionsList
{
    /** @var Transaction[] */
    public array $transactions = [];
    public int $itemCount;

    public function __construct(\stdClass $data)
    {
        $this->itemCount = $data->itemCount;
        foreach ($data->transactions as $transactionData) {
            $this->transactions[] = new Transaction($transactionData);
        }
    }
}
