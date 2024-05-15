<?php

namespace App\Helper;

class Helper
{
    public static  function getOnlyImagesLinks($articles)
    {
        $imageLinks = array();

        foreach ($articles as $article) {
            if (!empty($article['urlToImage'])) {
                $imageLinks[] = $article['urlToImage'];
            }
        }

        return $imageLinks;
    }

    public static function getMediaContentURLs($flux) {
        $mediaContentURLs = array();

        foreach ($flux as $item) {
            if (isset($item['media:content']['@url']) && !empty($item['media:content']['@url'])) {
                $mediaContentURLs[] = $item['media:content']['@url'];
            }
        }

        return $mediaContentURLs;
    }


}