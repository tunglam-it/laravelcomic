<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrawlNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl tin tuc anime tu vuighe.net';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = new \App\Components\CrawlNews();
        $data->crawl();
    }
}
