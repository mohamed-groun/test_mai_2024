<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class NewsApiService implements DataProviderInterface
{
    private HttpClientInterface $client;
    private string $apiKey;
    private LoggerInterface $logger;

    private const NEWS_API_URL = 'https://newsapi.org/v2/top-headlines';

    public function __construct(HttpClientInterface $client, LoggerInterface $logger, string $apiKey)
    {
        $this->client = $client;
        $this->logger = $logger;
        $this->apiKey = $apiKey;
    }

    /**
     * Fetches top headlines and returns the articles array.
     *
     * @return array
     */
    public function fetchData(): array
    {
        try {
            $response = $this->client->request(
                'GET',
                self::NEWS_API_URL,
                [
                    'query' => [
                        'country' => 'us',
                        'apikey' => $this->apiKey,
                    ]
                ]
            );

            $data = $response->toArray();

            if (!isset($data['articles'])) {
                $this->logger->error('Unexpected API response structure', [
                    'response' => $data,
                ]);
                return [];
            }

            return $data['articles'];
        } catch (\Exception $e) {
            $this->logger->error('Failed to fetch images from News API', [
                'exception' => $e,
            ]);

            return [];
        }
    }
}
