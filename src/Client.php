<?php

namespace Signalgrid;

use Signalgrid\Exception;

class Client
{
    private string $clientKey;
    private string $endpoint;

    public function __construct(
        string $clientKey,
        string $endpoint = 'https://api.signalgrid.co/v1/push'
    ) {
        if (empty($clientKey)) {
            throw new Exception('Client key is required');
        }

        $this->clientKey = $clientKey;
        $this->endpoint  = $endpoint;
    }

    public function send(array $payload): array
    {
        if (empty($payload['channel'])) {
            throw new Exception('Channel token is required');
        }

        $data = array_merge($payload, [
            'client_key' => $this->clientKey
        ]);

        $context = stream_context_create([
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($data),
                'timeout' => 10
            ]
        ]);

        $result = @file_get_contents(
            $this->endpoint,
            false,
            $context
        );

        if ($result === false) {
            throw new Exception('Signalgrid API request failed');
        }

        $decoded = json_decode($result, true);

        if ($decoded === null) {
            throw new Exception('Invalid JSON response from Signalgrid');
        }

        return $decoded;
    }
}