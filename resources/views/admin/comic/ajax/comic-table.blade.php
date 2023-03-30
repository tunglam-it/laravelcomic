<table class="table table-head-fixed text-nowrap table-bordered text-center ">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Tác giả</th>
        <th>Thể loại</th>
        <th>Hình ảnh</th>
        <th>Trạng thái</th>
        <th>Mô tả</th>
        <th>#</th>
    </tr>
    </thead>
    <tbody>
    @if(count($comics)>0)
        @foreach($comics as $comic)
            <tr>
                <td>{{$comic->id}}</td>
                <td style="max-width: 30ch;overflow: hidden;white-space: nowrap;text-overflow: ellipsis">{{$comic->name}}</td>
                <td>{{$comic->author}}</td>
                <td style="max-width: 30ch;overflow: hidden;white-space: nowrap;text-overflow: ellipsis">
                    @foreach($comic->belongCategory as $category)
                        {{$category->name}},
                    @endforeach
                </td>
                <td><img width="100" height="100" src="{{asset('storage/uploads/comic/'.$comic->image)}}"></td>
                <td>{{$comic->status == '0' ? "Đang cập nhật" : "Đã hoàn thành" }}</td>
                <td style="max-width: 40ch;overflow: hidden;white-space: nowrap;text-overflow: ellipsis">{{$comic->description}}</td>
                <td>
                    <a href="{{route('admin.comic.edit',['id'=>$comic->id])}}"
                       class="btn btn-warning">Sửa</a>
                    <a onclick="return confirm('Bạn muốn xoá truyện này không?')"
                       href="{{route('admin.comic.destroy',['id'=>$comic->id])}}"
                       class="btn btn-danger">Xoá</a>
                </td>
            </tr>
        @endforeach
    @else
        <td>Chưa có truyện phù hợp...</td>
    @endif
    </tbody>
</table>
