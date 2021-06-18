<?php


namespace App\Services;


use App\Models\News;
use Illuminate\Http\Client\Response;

class NewsService
{
    public function processFeed(Response $rssFeed): mixed
    {
        $xml = simplexml_load_string($rssFeed->body(), null, LIBXML_NOCDATA);

        $json = json_encode($xml);

        return json_decode($json,TRUE);
    }

    public function isImage(array $newsItem): bool
    {
        return $newsItem['@attributes']['type'] === 'image/jpeg';
    }

    public function hasAssets(array $newsItem): bool
    {
        return isset($newsItem['enclosure']);
    }

    public function hasAuthor(array $newsItem): bool
    {
        return isset($newsItem['author']);
    }

    public function isOneAsset(array $newsItem): bool
    {
        return count($newsItem['enclosure']) === 1;
    }

    public function getAuthor(array $newsItem): mixed
    {
        if ($this->hasAuthor($newsItem)) {
            return $newsItem['author'];
        }

        return null;
    }

    public function getImage(array $newsItem): mixed
    {
        if ($this->hasAssets($newsItem)) {
            if ($this->isOneAsset($newsItem)) {
                if ($this->isImage($newsItem['enclosure'])) {
                    return $newsItem['enclosure']['@attributes']['url'];
                }
            } else {
                foreach ($newsItem['enclosure'] as $arAsset) {
                    if ($this->isImage($arAsset)) {
                        return $arAsset['@attributes']['url'];
                    }
                }
            }
        }

        return null;
    }

    public function store(array $newsItem): void
    {
        News::firstOrCreate([
            'name' => $newsItem['title'],
            'link' => $newsItem['link'],
            'description' => $newsItem['description'],
            'created_at' => $newsItem['pubDate'],
            'author' => $this->getAuthor($newsItem),
            'image' => $this->getImage($newsItem),
        ]);
    }
}
