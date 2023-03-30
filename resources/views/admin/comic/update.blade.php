@extends('admin.admin-dashboard')
@section('title')
    <title>Cập nhật Truyện</title>
@endsection
@section('minor_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.layouts.content-header',['minorTitle'=>'Cập nhật Truyện'])
    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                       placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-3">
                        <form action="{{route('admin.comic.update',['id'=>$comic->id])}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="comicName">Tên Truyện</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror" id="comicName"
                                           value="{{$comic->name}}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="comicSlug">Slug Truyện</label>
                                    <input type="text" name="slug"
                                           class="form-control @error('name') is-invalid @enderror" id="comicSlug"
                                           value="{{$comic->slug}}">
                                    @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="comicAuthor">Tác giả</label>
                                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="comicAuthor" value="{{$comic->author}}">
                                    @error('author')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="comicDescription">Tóm tắt</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              id="comicDescription" rows="5">{{$comic->description}}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Chọn Thể loại Truyện</label>
                                <select multiple="multiple" class="comic-select form-control form-control-sm @error('category_id') is-invalid @enderror" name="category_id[]">
                                    @foreach($allCategories as $category)
                                        <option
                                            value="{{$category->id}}" {{$categoriesComic->contains('id',$category->id)?'selected':''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="comicStatus1" name="status"
                                           class="custom-control-input @error('status') is-invalid @enderror"
                                           value="0" {{$comic->status=='0'?'checked':''}}>
                                    <label class="custom-control-label" for="comicStatus1">Đang cập nhật</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="comicStatus2" name="status"
                                           class="custom-control-input @error('status') is-invalid @enderror"
                                           value="1" {{$comic->status=='1'?'checked':''}}>
                                    <label class="custom-control-label" for="comicStatus2">Đã hoàn thành</label>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Upload Ảnh</label>
                                <div class="input-group">
                                    <input name="image" type="file" @error('image') is-invalid
                                           @enderror onchange="readURL(this);">
                                    <img style="width: 90px;height: 80px;" id="preview_img"
                                         src="{{asset('storage/uploads/comic/'.$comic->image)}}" alt="your image"/>
                                </div>
                                @error('image')
                                <div class="text-danger col-sm-4">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview_img').show().attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#comicName').change(function (){
            $.ajax({
                url:'{{route("admin.comic.slug")}}',
                dataType:'json',
                type:'get',
                data:{name:$(this).val()},
                success:function (response){
                    $('#comicSlug').val(response.slug)
                }
            })
        })

        $(".comic-select").select2({
            tags: true,
            tokenSeparators: [',']
        })
    </script>
@endsection
