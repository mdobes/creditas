<?php

namespace mdobes\Creditas\Exception;

class ApiException extends \Exception
{
    private ?\stdClass $responseBody;

    public function __construct(string $message, int $code = 0, ?string $responseBody = null)
    {
        $this->responseBody = json_decode($responseBody);

        $formattedMessage = $this->formatMessage($message, $code);

        parent::__construct($formattedMessage, $code);
    }

    private function formatMessage(string $message, int $code): string
    {
        $codeName = $this->responseBody->name;
        $errorMessage = null;

        if ($codeName === 'SYS_ValidationExc') {
            throw new ValidationException($this->responseBody);
        }

        switch ($codeName) {
            case 'OAM_SecurityExc':
                $errorMessage = 'User is not authorized';
                break;
            case 'SYS_UnexpectedExc':
                $errorMessage = 'Unexpected error';
                break;
            case 'SYS_ValidationExc':
                $errorMessage = 'Validation error';
                break;
        }

        return $message . ', ' . $errorMessage . ' (' . $codeName . ')';
    }
}
