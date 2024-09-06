<?php

namespace mdobes\Creditas\Model;

class AccountDetail
{
    public string $accountId;
    public string $bban;
    public string $bankCode;
    public string $iban;
    public string $bic;
    public string $currency;
    public string $country;
    public string $status;
    public string $name;
    public string $productCode;
    public string $productI18N;
    public string $currentBalance;
    public string $availableBalance;

    public function __construct(\stdClass $data = null)
    {
        if ($data !== null) {
            $this->hydrate($data);
        }
    }

    private function hydrate(\stdClass $data): void
    {
        $this->accountId = $data->accountId;
        $this->bban = $data->bban;
        $this->bankCode = $data->bankCode;
        $this->iban = $data->iban;
        $this->bic = $data->bic;
        $this->currency = $data->currency;
        $this->country = $data->country;
        $this->status = $data->status;
        $this->name = $data->name;
        $this->productCode = $data->productCode;
        $this->productI18N = $data->productI18N;
        $this->currentBalance = $data->currentBalance;
        $this->availableBalance = $data->availableBalance;
    }
}
