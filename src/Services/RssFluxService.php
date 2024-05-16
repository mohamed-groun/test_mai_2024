<?php

namespace App\Services;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class RssFluxService
{
    private $client;
    private $logger;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getFlux(): array
    {
        try {
            $response = $this->client->request(
                'GET',
                'http://www.commitstrip.com/en/feed/'
            );

            $xmlEncoder = new XmlEncoder();
            $array = $xmlEncoder->decode($response->getContent(), 'xml');

            return $array["channel"]["item"];
        } catch (\Exception $e) {
            $this->logger->error('An error occurred while fetching RSS feed: ' . $e->getMessage());

            return [];
        }
    }
}
