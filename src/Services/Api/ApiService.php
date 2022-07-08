<?php


namespace App\Services\Api;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiService
{
    private $client;

    private $apiHost;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->apiHost = $_ENV['API_HOST'];
    }

    public function getUsers(int $count = 1)
    {
        $url = $this->apiHost . '/api?';
        $url .= http_build_query(['results' => $count]);

        $result = $this->client->request(
            'GET',
            $url
        );
        $content = $result->getContent();

        return json_decode($content, false);
    }
}