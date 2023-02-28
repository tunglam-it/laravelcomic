<?php

namespace App\Http\Controllers\Admin;

use App\Components\PreventSQLInjection;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    private $news;
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function index()
    {
        $allNews = $this->news->all();
        return view('admin.news.index',compact('allNews'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
            $this->news->create($data);
            DB::commit();
            return redirect()->route('admin.news.index')->with(['message'=>'Thêm news mới thành công']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.news.index')->with(['message'=>'Thêm news mới thất bại']);
        }
    }

    public function edit($id)
    {
        $news = $this->news->findOrFail($id);
        return view('admin.news.update',compact('news'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $news = $this->news->findOrFail($id);
            $data = $request->all();
            $news->update($data);
            DB::commit();
            return redirect()->route('admin.news.index')->with(['message'=>'Cập nhật news thành công']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.news.index')->with(['message'=>'Cập nhật news thất bại']);
        }
    }

    public function destroy($id)
    {
        $this->news->findOrFail($id)->delete();
        return redirect()->route('admin.news.index')->with(['message'=>'Xoá thành công']);
    }

    public function searchAjax(Request $request)
    {
        $prevent = new PreventSQLInjection();
        if($request->ajax()){
            $keyword = $request->keyword;
            if($keyword){
                $query = $prevent->preventSQL($keyword);
                $allNews = $this->news->where('title','LIKE','%'.$query.'%')->get();
            }
            else{
                $allNews = $this->news->all();
            }
            return view('admin.news.ajax.news-table',compact('allNews'));
        }
    }

    public function getSlug(Request $request)
    {
        $slug = Str::slug($request->title);
        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    }
}
