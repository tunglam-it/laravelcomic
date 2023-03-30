<?php
namespace App\Components;

use App\Models\News;
use Goutte\Client;
use Illuminate\Support\Str;
use Symfony\Component\DomCrawler\Crawler;

class CrawlNews{

    private $result = array();
    private $linkPosts = array();

    public function crawl()
    {
        $url = 'https://chuuniotaku.com/anime-manga/news/';
        if ($this->isConnected('chuuniotaku.com')) {
            $client = new Client();
            $crawler = $client->request('GET', $url);

            $crawler->filter('div.td-theme-wrap div.td-main-content-wrap div.tdc-content-wrap div.tdc-zone div.tdi_61 div#tdi_70 div.tdi_71 div.tdi_73 div.wpb_wrapper div.tdi_74 div#tdi_74 div.tdb_module_loop')->each(function (Crawler $node) {
                $this->result[$node->filter('div.td-module-container div.td-image-container div.td-module-thumb a span')->attr('data-img-url')] = $node->filter('div.td-module-container div.td-image-container div.td-module-thumb a')->attr('href');
            });
            $this->linkPosts = array_reverse($this->result);
            foreach ($this->linkPosts as $imageLink => $urlLink) {
                $this->handleData($imageLink,$urlLink);
            }
        }
    }

    public function handleData($imageLink, $urlLink)
    {
        $client = new Client();
        $crawler = $client->request('GET', $urlLink);

        $title = $crawler->filter('div.td-theme-wrap div#tdb-autoload-article div.td-main-content-wrap div.tdc-content-wrap article div#tdi_60 div.tdi_61 div#tdi_62 div.tdi_63 div.tdi_65 div.wpb_wrapper div.tdi_67 div.tdb-block-inner h1')->each(function ($node) {
            return $node->text();
        });

        $rawContent = $crawler->filter('div.td-theme-wrap div#tdb-autoload-article div.td-main-content-wrap div.tdc-content-wrap article div#tdi_60 div.tdi_61 div#tdi_62 div.tdi_63 div.tdi_65 div.wpb_wrapper div.tdi_77 div.tdi_82 div.vc_column-inner div.wpb_wrapper div.tdi_83 div.tdb-block-inner')->each(function ($node) {
            return $node->outerHtml();
        });
        if(!empty($title[0]) && !empty($rawContent[0])){
            $slug = Str::slug($title[0]);

            News::firstOrCreate([
                'title' => $title[0],
                'content' => $rawContent[0],
                'slug' => $slug,
                'url' => $urlLink,
                'image_crawl' => $imageLink,
            ]);
        }
    }

    public function isConnected($url)
    {
        $connected = @fsockopen($url, 443);
        if ($connected) {
            fclose($connected);
            return true;
        } else {
            return false;
        }
    }
}
