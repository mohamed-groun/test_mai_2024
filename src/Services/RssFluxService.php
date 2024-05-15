<?php

namespace App\Services;

use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class RssFluxService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;

    }

    public function getFlux(): array
    {

        $response = $this->client->request(
            'GET',
            'http://www.commitstrip.com/en/feed/'
        );

        $xmlEncoder = new XmlEncoder();
        $array = $xmlEncoder->decode($response->getContent(), 'xml');

        return $array["channel"]["item"];
    }

}