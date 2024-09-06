<?php

namespace mdobes\Creditas;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use mdobes\Creditas\Exception\ApiException;

class Creditas
{
    private string $apiUrl;
    private string $authorizationToken;
    private string $accountId;
    private Client $client;

    public function __construct(string $authorizationToken, string $accountId)
    {
        $this->apiUrl = 'https://api.creditas.cz/oam/v1/account/';
        $this->authorizationToken = $authorizationToken;
        $this->accountId = $accountId;

        $this->client = new Client([
            'headers' => [
                'Cache-Control' => 'no-cache,no-store,must-revalidate,max-age=-1,private',
                'Pragma' => 'no-cache',
                'Expires' => '-1',
                'Accept-Language' => 'cs',
                'Authorization' => 'Bearer ' . $this->authorizationToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws ApiException
     */
    private function sendPostRequest(array $data, string $endpoint): \stdClass
    {
        try {
            $url = $this->apiUrl . $endpoint;

            $response = $this->client->post($url, [
                'json' => $data
            ]);

            $body = $response->getBody()->getContents();
            $decodedResponse = json_decode($body);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new ApiException('Invalid JSON response', 0, $body);
            }

            return $decodedResponse;

        } catch (RequestException $e) {
            $body = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : null;

            throw new ApiException('HTTP request failed', $e->getCode(), $body);
        } catch (GuzzleException $e) {
            throw new ApiException('HTTP request failed' . $e->getMessage(), $e->getCode());
        }
    }

    /**
     * @throws ApiException
     */
    public function getAccountDetails(): \stdClass
    {
        $data = [
            'accountId' => $this->accountId
        ];

        return $this->sendPostRequest($data, 'current/get');

    }

}
