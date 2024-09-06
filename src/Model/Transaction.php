<?php

namespace mdobes\Creditas\Model;

class Transaction
{
    public string $transactionId;
    public string $category;
    public string $type;
    public string $code;
    public ?string $codeI18N;
    public object $partnerAccount;
    public object $amount;
    public string $exchangeRate;
    public string $effectiveDate;
    public string $cardAuthorizationDate;
    public ?string $userNote = null;
    public ?string $variableSymbol = null;
    public ?string $remittanceInfo = null;
    public object $balance;
    public string $paymentOrderId;

    public function __construct(\stdClass $data)
    {
        $this->transactionId = $data->transactionId;
        $this->category = $data->category;
        $this->type = $data->type;
        $this->code = $data->code;
        $this->codeI18N = $data->codeI18N ?? null;
        $this->partnerAccount = $data->partnerAccount;
        $this->amount = $data->amount;
        $this->exchangeRate = $data->exchangeRate;
        $this->effectiveDate = $data->effectiveDate;
        $this->cardAuthorizationDate = $data->cardAuthorizationDate;
        $this->userNote = $data->userNote ?? null;
        $this->variableSymbol = $data->variableSymbol ?? null;
        $this->remittanceInfo = $data->remittanceInfo ?? null;
        $this->balance = $data->balance;
        $this->paymentOrderId = $data->paymentOrderId;
    }
}
