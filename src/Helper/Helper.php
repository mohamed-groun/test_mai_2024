<?php

namespace App\Helper;

final class Helper
{
    private const IMAGE_EXTENSIONS = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

    /**
     * Récupère les liens d'images des articles.
     *
     * @param array $articles Liste des articles.
     * @return array Liste des liens d'images.
     */
    public static function getOnlyImagesLinks(array $articles): array
    {
        $imageLinks = [];

        foreach ($articles as $article) {
            if (!empty($article['urlToImage'])) {
                $imageLinks[] = $article['urlToImage'];
            }
        }

        return $imageLinks;
    }

    /**
     * Récupère les URLs du contenu média qui sont des images.
     *
     * @param array $flux Liste des items du flux.
     * @return array Liste des URLs de contenu média.
     */
    public static function getMediaContentURLs(array $flux): array
    {
        $mediaContentURLs = [];

        foreach ($flux as $item) {
            if (isset($item['media:content']['@url']) && !empty($item['media:content']['@url'])) {
                $url = $item['media:content']['@url'];
                $extension = pathinfo($url, PATHINFO_EXTENSION);

                if (in_array(strtolower($extension), self::IMAGE_EXTENSIONS, true)) {
                    $mediaContentURLs[] = $url;
                }
            }
        }

        return $mediaContentURLs;
    }
}
