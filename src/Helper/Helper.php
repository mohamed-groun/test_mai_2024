<?php

namespace App\Helper;

use phpDocumentor\Reflection\Types\Self_;

class Helper
{
    public static $imageExtensions = array('jpg', 'jpeg', 'png', 'gif', 'bmp');

    public static function getOnlyImagesLinks($articles)
    {
        $imageLinks = array();

        foreach ($articles as $article) {
            if (!empty($article['urlToImage'])) {
                $imageLinks[] = $article['urlToImage'];
            }
        }

        return $imageLinks;
    }

    public static function getMediaContentURLs($flux)
    {
        $mediaContentURLs = array();

        foreach ($flux as $item) {
            if (isset($item['media:content']['@url']) && !empty($item['media:content']['@url'])) {

                $url = $item['media:content']['@url'];
                $extension = pathinfo($url, PATHINFO_EXTENSION);

                if (in_array(strtolower($extension), Self::$imageExtensions)) {
                    $mediaContentURLs[] = $url;
                }
            }
        }

        return $mediaContentURLs;
    }


}