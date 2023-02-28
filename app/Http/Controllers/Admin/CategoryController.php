<?php

namespace App\Http\Controllers\Admin;

use App\Components\PreventSQLInjection;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $this->category->create($data);
            DB::commit();
            return redirect()->route('admin.category.index')->with(['message' => 'Thêm mới thành công']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.category.index')->with(['message' => 'Thêm mới thất bại']);
        }
    }

    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
        return view('admin.category.update', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $this->category->findOrFail($id)->update($data);
            DB::commit();
            return redirect()->route('admin.category.index')->with(['message' => 'Cập nhật thành công']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('admin.category.index')->with(['message' => 'Cập nhật thất bại']);
        }
    }

    public function destroy($id)
    {
        $remove = $this->category->findOrFail($id)->delete();
        if ($remove) {
            return redirect()->route('admin.category.index')->with(['message' => 'Xoá thành công']);
        } else {
            return redirect()->route('admin.category.index')->with(['message' => 'Xoá thất bại']);
        }
    }

    public function searchAjax(Request $request)
    {
        $prevent = new PreventSQLInjection();
        if($request->ajax()){
            $keyword = $request->keyword;
            if($keyword){
                $query = $prevent->preventSQL($keyword);
                $categories = $this->category->where('name','LIKE','%'.$query.'%')->get();
            }
            else{
                $categories = $this->category->all();
            }
            return view('admin.category.ajax.category-table',compact('categories'));
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
