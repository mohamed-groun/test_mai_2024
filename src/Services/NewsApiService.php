<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class NewsApiService
{
    private $client;
    private $apiKey;
    private $logger;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->apiKey = $_ENV['API_KEY_NEWSAPI'];
        $this->logger = $logger;
    }

    public function getImages(): array
    {
        try {
            $response = $this->client->request(
                'GET',
                'https://newsapi.org/v2/top-headlinesd',
                [
                    'query' => [
                        'country' => 'us',
                        'apikey' => $this->apiKey,
                    ]
                ]
            );

            return $response->toArray()["articles"];
        } catch (\Exception $e) {
            $this->logger->error('Failed to fetch images from News API', [
                'exception' => $e,
            ]);

            return [];
        }
    }
}
