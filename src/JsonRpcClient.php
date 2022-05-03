<?php

namespace Vladi\Landing;

use GuzzleHttp\Client;

class JsonRpcClient
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function send(string $method, array $params)
    {
        $response = $this->client->post(config('activitylog.logToUrl'), [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'jsonrpc' => '2.0',
                'id' => time(),
                'method' => $method,
                'params' => $params,
            ],
        ])->getBody()->getContents();

        //TODO isJson, toJson ?
        $response = json_decode($response, true);

        if (array_key_exists('error', $response)) {
            $error = $response['error'];
            throw new Exception($error['message'], $error['code']);
        }

        return $response;
    }

    public function notify(string $method, array $params)
    {
        $this->client->post(config('activitylog.logToUrl'), [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'jsonrpc' => '2.0',
                'method' => $method,
                'params' => $params,
            ],
        ]);
    }
}