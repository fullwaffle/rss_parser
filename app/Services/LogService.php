<?php


namespace App\Services;


use App\Models\Log;

class LogService
{
    public function store(string $method, string $url, int $code, string $body): void
    {
        Log::create([
            'method' => $method,
            'link' => $url,
            'code' => $code,
            'body' => $body,
        ]);
    }
}
