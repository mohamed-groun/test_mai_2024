<?php

namespace App\Services;

use App\Helper\Helper;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Psr\Log\LoggerInterface;

class RssFluxService implements DataProviderInterface
{
    private const RSS_FEED_URL = 'http://www.commitstrip.com/en/feed/';

    private HttpClientInterface $client;
    private LoggerInterface $logger;

    public function __construct(HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * Fetches and decodes the RSS feed.
     *
     * @return array The decoded RSS feed items.
     */
    public function fetchData(): array
    {
        try {
            $responseContent = $this->fetchRssFeed();
            return $this->decodeXmlResponse($responseContent);
        } catch (\Exception $e) {
            $this->logger->error('An error occurred while fetching RSS feed: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Fetches the RSS feed content from the specified URL.
     *
     * @return string The RSS feed content.
     * @throws \Exception If the request fails.
     */
    private function fetchRssFeed(): string
    {
        $response = $this->client->request('GET', self::RSS_FEED_URL);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Failed to fetch RSS feed, status code: ' . $response->getStatusCode());
        }

        return $response->getContent();
    }

    /**
     * Decodes the XML response content.
     *
     * @param string $responseContent The XML response content.
     * @return array The decoded RSS feed items.
     * @throws \Exception If the decoding fails.
     */
    private function decodeXmlResponse(string $responseContent): array
    {
        $xmlEncoder = new XmlEncoder();
        $array = $xmlEncoder->decode($responseContent, 'xml');

        if (!isset($array['channel']['item'])) {
            throw new \Exception('Invalid RSS feed format');
        }

        return $array['channel']['item'];
    }
}
