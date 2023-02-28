<table class="table table-head-fixed text-nowrap table-bordered text-center ">
    <thead>
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Ảnh</th>
        <th>Nội dung</th>
        <th>Link gốc</th>
        <th>#</th>
    </tr>
    </thead>
    <tbody>
    @if(count($allNews)>0)
        @foreach($allNews as $news)
            <tr>
                <td>{{$news->id}}</td>
                <td>{{$news->title}}</td>
                <td><img width="100" height="100" src="{{$news->image_crawl}}"></td>
                <td style="max-width: 30ch;overflow: hidden;white-space: nowrap;text-overflow: ellipsis">{{$news->content}}</td>
                <td style="max-width: 30ch;overflow: hidden;white-space: nowrap;text-overflow: ellipsis">{{$news->url}}</td>
                <td>
                    <a href="{{route('admin.news.edit',['id'=>$news->id])}}"
                       class="btn btn-warning">Sửa</a>
                    <a onclick="return confirm('Bạn muốn xoá tin này không?')"
                       href="{{route('admin.news.destroy',['id'=>$news->id])}}"
                       class="btn btn-danger">Xoá</a>
                </td>
            </tr>
        @endforeach
    @else
        <td>Chưa có tin phù hợp...</td>
    @endif
    </tbody>
</table>
