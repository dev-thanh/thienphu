<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Psr\Http\Message\UriInterface;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SitemapGenerator::create(url('/'))
        ->shouldCrawl(function (UriInterface $url) {
           
            return strpos($url->getPath(), '/change-language') === false &&
            strpos($url->getPath(), '/upload') === false ;
        })
        ->writeToFile('sitemap.xml');

        $this->info('Added sitemap successfully!');
    }
}