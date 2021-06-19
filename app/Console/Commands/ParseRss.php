<?php

namespace App\Console\Commands;

use App\Http\Controllers\NewsController;
use Illuminate\Console\Command;

class ParseRss extends Command
{
    protected object $newsController;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:rss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse RSS feed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(NewsController $newsController)
    {
        parent::__construct();
        $this->newsController = $newsController;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->newsController->index();
    }
}
