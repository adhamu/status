<?php
namespace Status\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;

class WebsiteStatusCheckerService
{
    private $httpClient;

    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function checkUrl($url)
    {
        $result = [];
        try {
            $response = $this->httpClient->request('GET', $url);
            $result = [
                'code' => $response->getStatusCode(),
                'phrase' => $response->getReasonPhrase()
            ];
        } catch (RequestException $e) {
            $result = [
                'code' => 200,
                'phrase' => 'OK'
            ];
        } catch (ConnectException $e) {
            $result = [
                'code' => 500,
                'phrase' => 'Cannot connect'
            ];
        } catch (ClientException $e) {
            $result = [
                'code' => $e->getResponse()->getStatusCode(),
                'phrase' => $e->getResponse()->getReasonPhrase()
            ];
        }
        return $result;
    }
}
