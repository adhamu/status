<?php
namespace Status\Service;

use GuzzleHttp\Client;

class WebsiteStatusCheckerService
{
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function checkUrl($url)
    {
        $response = $this->httpClient->request('GET', $url);

        $result = [
            'code' => $response->getStatusCode(),
            'phrase' => $response->getReasonPhrase()
        ];

        return $result;
    }
}
