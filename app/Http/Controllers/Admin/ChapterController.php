<?php

namespace App\Http\Controllers\Admin;

use App\Components\PreventSQLInjection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chapter\CreateChapterRequest;
use App\Http\Requests\Chapter\UpdateChapterRequest;
use App\Models\Chapter;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChapterController extends Controller
{
    private $comic;
    private $chapter;

    public function __construct(Comic $comic, Chapter $chapter)
    {
        $this->comic = $comic;
        $this->chapter = $chapter;
    }

    public function index()
    {
        $chapters = $this->chapter->with('belongComic')->get();
        return view('admin.chapter.index',compact('chapters'));
    }

    public function create()
    {
        $comics = $this->comic->all();
        return view('admin.chapter.create',compact('comics'));
    }

    public function store(CreateChapterRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('_token');
//            $chapterId = $this->chapter->insertGetId($data);
            $chapterId = DB::table('chapters')->insertGetId($data);
            $this->chapter->findOrFail($chapterId)->belongComic->touch();
            DB::commit();
            return redirect()->route('admin.chapter.index')->with(['message'=>'Thêm chapter mới thành công']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.chapter.index')->with(['message'=>'Thêm chapter mới thất bại']);
        }
    }

    public function edit($id)
    {
        $comics = $this->comic->all();
        $chapter = $this->chapter->findOrFail($id);
        return view('admin.chapter.update',compact('comics','chapter'));
    }

    public function update(UpdateChapterRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $chapter = $this->chapter->findOrFail($id);
            $data = $request->all();
            $chapter->update($data);
            $chapter->belongComic->touch();
            DB::commit();
            return redirect()->route('admin.chapter.index')->with(['message'=>'Cập nhật chapter thành công']);
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.chapter.index')->with(['message'=>'Cập nhật chapter thất bại']);
        }
    }

    public function destroy($id)
    {
        $this->chapter->findOrFail($id)->delete();
        return redirect()->route('admin.chapter.index')->with(['message'=>'Xoá thành công']);
    }

    public function searchAjax(Request $request)
    {
        $prevent = new PreventSQLInjection();
        if($request->ajax()){
            $keyword = $request->keyword;
            if($keyword){
                $query = $prevent->preventSQL($keyword);
                $chapters = $this->chapter->where('title','LIKE','%'.$query.'%')->get();
            }
            else{
                $chapters = $this->chapter->all();
            }
            return view('admin.chapter.ajax.chapter-table',compact('chapters'));
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
