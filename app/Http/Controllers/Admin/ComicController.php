<?php

namespace App\Http\Controllers\Admin;

use App\Components\HandleImage;
use App\Components\PreventSQLInjection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comic\CreateComicRequest;
use App\Http\Requests\Comic\UpdateComicRequest;
use App\Models\Category;
use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ComicController extends Controller
{
    private $category;
    private $comic;

    public function __construct(Category $category, Comic $comic)
    {
        $this->category = $category;
        $this->comic = $comic;
    }

    public function index()
    {
        $comics = $this->comic->with('belongCategory')->get();
        return view('admin.comic.index', compact('comics'));
    }

    public function create()
    {
        $categories = $this->category->all();
        return view('admin.comic.create', compact('categories'));
    }

    public function store(CreateComicRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('category_id');

            $image = new HandleImage();
            $name = $image->uploadImage($request, 'image', 'comic');
            if (!empty($name)) {
                $data['image'] = $name;
                $insertData = $this->comic->create($data);
                $insertData->belongCategory()->attach($request->category_id);
            }
            DB::commit();
            return redirect()->route('admin.comic.index')->with(['message' => 'Thêm mới truyện thành công']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.comic.index')->with(['message' => 'Thêm mới truyện thất bại']);
        }
    }

    public function edit($id)
    {
        $comic = $this->comic->findOrFail($id);
        $allCategories = $this->category->all();
        $categoriesComic = $comic->belongCategory;
        return view('admin.comic.update', compact('comic', 'allCategories','categoriesComic'));
    }

    public function update(UpdateComicRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->except('category_id');
            $comic = $this->comic->findOrFail($id);

            if ($request->hasFile('image') == false) {
                $comic->update($data);
                $comic->belongCategory()->sync($request->category_id);
            } else {
                $image = new HandleImage();
                $image->removeImage($request, 'comic', $comic->image);
                $name = $image->uploadImage($request, 'image', 'comic');
                $data['image'] = $name;
                $comic->update($data);
                $comic->belongCategory()->sync($request->category_id);

            }
            DB::commit();
            return redirect()->route('admin.comic.index')->with(['message' => 'Cập nhật truyện thành công']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.comic.index')->with(['message' => 'Cập nhật truyện thất bại']);
        }
    }

    public function destroy($id)
    {
        $remove = $this->comic->findOrFail($id)->delete();
        if ($remove) {
            return redirect()->route('admin.comic.index')->with(['message' => 'Xoá truyện thành công']);
        } else {
            return redirect()->route('admin.comic.index')->with(['message' => 'Xoá truyện thất bại']);

        }
    }

    public function searchAjax(Request $request)
    {
        $prevent = new PreventSQLInjection();
        if($request->ajax()){
            $keyword = $request->keyword;
            if($keyword){
                $query = $prevent->preventSQL($keyword);
                $comics = $this->comic->where('name','LIKE','%'.$query.'%')->get();
            }
            else{
                $comics = $this->comic->all();
            }
            return view('admin.comic.ajax.comic-table',compact('comics'));
        }
    }

    public function getSlug(Request $request)
    {
        $slug = Str::slug($request->name);
        return response()->json([
            'status' => true,
            'slug' => $slug
        ]);
    }
}
