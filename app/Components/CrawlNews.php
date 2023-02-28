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
        $url = 'https://tinanime.com/tin-tuc';
        if ($this->isConnected('tinanime.com')) {
            $client = new Client();
            $crawler = $client->request('GET', $url);

            $crawler->filter('div.container section div.w-full div.grow div.relative')->each(function (Crawler $node) {
                $this->result[$node->filter('a div img')->attr('src')] = 'https://tinanime.com'.$node->filter('a')->attr('href');
            });
            $this->linkPosts = array_reverse($this->result);
            foreach ($this->linkPosts as $imageLink => $urlLink) {
                $this->handleData($imageLink, $urlLink);
            }
        }
    }

    public function handleData($imageLink, $urlLink)
    {
        $client = new Client();
        $crawler = $client->request('GET', $urlLink);

        $title = $crawler->filter('div#news section div.news-container h1')->each(function ($node) {
            return $node->text();
        });

        $rawContent = $crawler->filter('div#news section div.news-container div.news-content')->each(function ($node) {
            return $node->outerHtml();
        });
        if(!empty($title[0]) && !empty($rawContent[0])){
            $pattern = array('/<(p|div) style="text-align: right;.*/i','/<br>Gửi confession của bạn.*/i');
            $content = preg_replace($pattern, '', $rawContent[0]);
            $slug = Str::slug($title[0]);

            News::firstOrCreate([
                'title' => $title[0],
                'content' => $content,
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
