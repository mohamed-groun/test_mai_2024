<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;


class NewsApiService
{
    private $client;
    private $apiKey;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->apiKey = $_ENV['API_KEY_NEWSAPI'];
    }


    public function getImages(): array
    {

        $response = $this->client->request(
            'GET',
            'https://newsapi.org/v2/top-headlines',
            [
                'query' => [
                    'country' => 'us',
                    'apikey' => $this->apiKey,
                ]
            ]
        );

        return $response->toArray()["articles"];
    }
}