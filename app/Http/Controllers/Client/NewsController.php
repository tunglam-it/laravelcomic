<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $news;

    public function __construct(News $news)
    {
        $this->news = $news;
    }
    /*
    * Hiển thị tất cả các tin tức anime crawl được
    * */
    public function index()
    {
        $allNews = $this->news->orderByDesc('id')->paginate(12);
        if($allNews){
            return view('client.news.allnews', compact('allNews'));
        }
        else{
            return abort(404);
        }
    }

    /*
     * Hiển thị chi tiết 1 tin
     * */
    public function detail($slug)
    {
        $news = $this->news->whereSlug($slug)->first();
        if($news){
            return view('client.news.news-detail', compact('news'));
        }
        else{
            return abort(404);
        }
    }
}
