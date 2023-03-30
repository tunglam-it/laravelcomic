<table class="table table-head-fixed text-nowrap table-bordered text-center ">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Slug</th>
        <th>Trạng thái</th>
        <th>Mô tả</th>
        <th>#</th>
    </tr>
    </thead>
    <tbody>
    @if(count($categories)>0)
        @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->slug}}</td>
                <td>{{$category->status == '0' ? "Ẩn" : "Hiện" }}</td>
                <td style="max-width: 50ch;overflow: hidden;white-space: nowrap;text-overflow: ellipsis">{{$category->description}}</td>
                <td>
                    <a href="{{route('admin.category.edit',['id'=>$category->id])}}"
                       class="btn btn-warning">Sửa</a>
                    <a onclick="return confirm('Bạn muốn xoá thể loại truyện này không?')"
                       href="{{route('admin.category.destroy',['id'=>$category->id])}}"
                       class="btn btn-danger">Xoá</a>
                </td>
            </tr>
        @endforeach
    @else
        <td>Chưa có danh mục truyện phù hợp...</td>
    @endif
</table>
