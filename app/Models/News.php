<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'description', 'created_at', 'author', 'image'];

    public $timestamps = false;

    public function getRssFeed(string $url, string $method): object
    {
        return Http::$method($url);
    }
}
