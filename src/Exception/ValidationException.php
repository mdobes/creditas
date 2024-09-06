<?php

namespace mdobes\Creditas\Exception;

class ValidationException extends \Exception
{
    private ?\stdClass $responseBody;

    public function __construct(?\stdClass $responseBody)
    {
        $this->responseBody = $responseBody;
        $message = $this->formatValidationMessage();

        parent::__construct($message);
    }

    private function formatValidationMessage(): string
    {
        $codeName = $this->responseBody->data->validationResult->validationErrorCode;
        $errorMessage = null;

        switch ($codeName) {
            case 'VAERR1001':
                $errorMessage = 'Product don\'t exist or access is not allowed';
                break;
        }

        return $errorMessage;
    }

}
