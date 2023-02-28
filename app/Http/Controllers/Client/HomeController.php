<?php

namespace App\Http\Controllers\Client;

use App\Components\PreventSQLInjection;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Comic;
use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $comic;
    private $category;
    private $chapter;
    private $user;
    private $news;

    public function __construct(Comic $comic, Category $category, Chapter $chapter, User $user, News $news)
    {
        $this->category = $category;
        $this->comic = $comic;
        $this->chapter = $chapter;
        $this->user = $user;
        $this->news = $news;
    }

    public function index()
    {
        $updatedComics = $this->comic->orderByDesc('updated_at')->limit(6)->get();
        $hotComics = $this->comic->orderByDesc('views')->with('hasChapter')->limit(6)->get();
        $news = $this->news->orderByDesc('id')->limit(6)->get();
        return view('client.layouts.content', compact('updatedComics', 'hotComics', 'news'));
    }

    /*
     * Hiển thị các truyện trong 1 thể loại
     * Lấy slug từ url và get được thông tin cate,comic
     * */
    public function clientCategory($slug)
    {
        $category = $this->category->whereSlug($slug)->first();
        if ($category) {
            $comics = $this->category->findOrFail($category->id)->belongComic()->paginate(12);
            return view('client.comic.category', compact('category', 'comics'));
        } else {
            return abort(404);
        }
    }

    /*
     * Hiển thị thông tin chi tiết của 1 truyện
     * Lấy slug từ url và get comic, get cate từ thông tin comic lấy đc
     * Laaý thông tin truyện cùng tác giả or cùng thể loại
     *
     * */
//
    public function clientDetailComic($slug)
    {
        $comic = $this->comic->whereSlug($slug)->first();
        if ($comic) {
            $comic->increment('views',1,['updated_at'=>$comic->updated_at]);
            $categories = $this->comic->findOrFail($comic->id)->belongCategory;
            $cateOfComic = $categories->first();
            $allComics = $this->category->findOrFail($cateOfComic->id)->belongComic()->get();
            $comicSameCate = $allComics->whereNotIn('id', [$comic->id]);

            $comicsSameAuthor = $this->comic->whereAuthor($comic->author)->whereNotIn('id', [$comic->id])->limit(4)->get();

            $likedComic = $comic->likedByUser->first() ? $comic->likedByUser->first()->pivot->comic_id : '';
            $chapter = $this->chapter->whereComicId($comic->id)->whereStatus(1);
            $allChapter = $chapter->get();
            $firstChapter = $chapter->first();
            return view('client.comic.detail', compact('comic', 'likedComic', 'categories', 'allChapter', 'firstChapter', 'comicsSameAuthor', 'comicSameCate'));
        } else {
            return abort(404);
        }
    }

    /*
     * Đọc chapter truyện, lấy slug từ url, lấy chapter hiện đang xem
     * Lấy max và min id truyện để hiển thị các chapter truyện,nếu đã hết và cố tình bấm thì điều hướng về trang chủ
     * */
    public function clientChapterComic($slug, $slug_chapter)
    {
        $comic = $this->comic->whereSlug($slug)->with('hasChapter')->first();
        if ($comic) {
            $likedComic = $comic->likedByUser->first() ? $comic->likedByUser->first()->pivot->comic_id : '';
            $max_id = $this->chapter->whereComicId($comic->id)->orderByDesc('id')->first()->slug_chapter;
            $min_id = $this->chapter->whereComicId($comic->id)->orderBy('id')->first()->slug_chapter;
            $currentChapter = $this->chapter->whereComicIdAndSlugChapterAndStatus($comic->id,$slug_chapter,1)->first();
            if ($currentChapter) {
                $prevChapter = $this->chapter->whereComicId($comic->id)->where('id','<', $currentChapter->id)->max('slug_chapter');
                $nextChapter = $this->chapter->whereComicId($comic->id)->where('id','>', $currentChapter->id)->min('slug_chapter');
                return view('client.comic.chapter', compact('currentChapter', 'comic', 'likedComic', 'prevChapter', 'nextChapter', 'max_id', 'min_id'));
            } else {
                return redirect()->route('client.home');
            }
        } else {
            return abort(404);
        }
    }

    /*
     * Search sử dụng ajax, sql injection
     * Gõ từ khoá và enter hiển thị trang kq tìm kiếm
     * */
    public function searchAjax(Request $request)
    {
        $prevent = new PreventSQLInjection();

        if ($request->ajax()) {
            $keyword = $request->keyword;
            if ($keyword) {
                $query = $prevent->preventSQL($keyword);
                $comics = $this->comic->where('name', 'LIKE', '%' . $query . '%')->get();
                return view('client.search.search-ajax', compact('comics'));
            }
        } else {
            $kw = $request->search_input;
            if ($kw) {
                $query = $prevent->preventSQL($kw);
                $comics = $this->comic->where('name', 'LIKE', '%' . $query . '%')->paginate(6)->appends($request->input());
                return view('client.search.search-result', compact('comics'));
            }
        }
    }

    /*
     * Hiển thị trang truyện yêu thích
     * */
    public function favorComic()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $comics = $this->user->findOrFail($user_id)->likedComic()->paginate(18);
            return view('client.comic.favor', compact('comics'));
        } elseif (!Auth::check()) {
            return view('client.comic.favor');
        } else {
            return abort(404);
        }
    }

    /*
     * Xử lý ajax khi bấm like/dislike truyện
     * */
    public function handleFavorComic(Request $request)
    {
        if (Auth::check()) {
            $status = $request->status;
            $comic_id = $request->comicId;
            $user_id = Auth::id();
            $comic = $this->comic->findOrFail($comic_id);
            if ($status == 'follow') {
                $comic->increment('likes',1,['updated_at'=>$comic->updated_at]);
                $comic->likedByUser()->attach($user_id);
            } else {
                $comic->decrement('likes',1,['updated_at'=>$comic->updated_at]);
                $comic->likedByUser()->detach($user_id);
            }
        }
    }
}
