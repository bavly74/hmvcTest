<?php
namespace App\PayPal;

use GuzzleHttp\Client;

class PayPalService {
    private $base_url;
    private $client_id;
    private $client_secret;
    private $request_client;

    public function __construct(Client $request_client) {
        $this->request_client = $request_client;
        $this->base_url = env('paypal_base_url');
        $this->client_id = env('paypal_id');
        $this->client_secret = env('paypal_secret');
    }

    public function getAccessToken() {
        $response = $this->request_client->post($this->base_url . '/v1/oauth2/token', [
            'auth' => [$this->client_id, $this->client_secret],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['access_token'] ?? null;
    }

    public function createOrder($amount, $currency = 'USD') {
        $accessToken = $this->getAccessToken();

        if (!$accessToken) {
            return ['error' => 'Failed to get access token'];
        }

        $response = $this->request_client->post($this->base_url.'/v2/checkout/orders', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => $currency,
                            'value' => $amount,
                        ],
                    ],
                ],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}

