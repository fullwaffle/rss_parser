<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Services\LogService;
use App\Services\NewsService;

class NewsController extends Controller
{
    protected object $news;
    protected object $logService;
    protected object $newsService;

    public function __construct(LogService $logService, News $news, NewsService $newsService)
    {
        $this->news = $news;
        $this->logService = $logService;
        $this->newsService = $newsService;
    }

    public function index()
    {
        $url = 'http://static.feed.rbc.ru/rbc/logical/footer/news.rss';
        $method = 'get';
        $response = $this->news->getRssFeed($url, $method);

        $this->logService->store($method, $url, $response->status(), $response->body());

        $rss = $this->newsService->processFeed($response);

        foreach ($rss['channel']['item'] as $newsItem) {
            $this->newsService->store($newsItem);
        }
    }
}
