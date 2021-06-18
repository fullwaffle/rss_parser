<?php


namespace App\Services;


use App\Models\Log;

class LogService
{
    protected object $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function store(string $method, string $url, int $code, string $body): void
    {
        $this->log->create([
            'method' => $method,
            'link' => $url,
            'code' => $code,
            'body' => $body,
        ]);
    }
}
