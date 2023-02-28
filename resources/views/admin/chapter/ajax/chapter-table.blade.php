<table class="table table-head-fixed text-nowrap table-bordered text-center ">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Truyện</th>
        <th>Mô tả</th>
        <th>Nội dung</th>
        <th>Trạng thái</th>
        <th>#</th>
    </tr>
    </thead>
    <tbody>
    @if(count($chapters)>0)
    @foreach($chapters as $chapter)
        <tr>
            <td>{{$chapter->id}}</td>
            <td>{{$chapter->title}}</td>
            <td>{{$chapter->belongComic->name}}</td>
            <td style="max-width: 30ch;overflow: hidden;white-space: nowrap;text-overflow: ellipsis">{{$chapter->description}}</td>
            <td style="max-width: 30ch;overflow: hidden;white-space: nowrap;text-overflow: ellipsis">{{$chapter->chapter_content}}</td>
            <td>{{$chapter->status == '0' ? "Ẩn" : "Hiện" }}</td>
            <td>
                <a href="{{route('admin.chapter.edit',['id'=>$chapter->id])}}"
                   class="btn btn-warning">Sửa</a>
                <a onclick="return confirm('Bạn muốn xoá chapter truyện này không?')"
                   href="{{route('admin.chapter.destroy',['id'=>$chapter->id])}}"
                   class="btn btn-danger">Xoá</a>
            </td>
        </tr>
    @endforeach
    @else
        <td>Chưa có chapter phù hợp...</td>
    @endif
    </tbody>
</table>
