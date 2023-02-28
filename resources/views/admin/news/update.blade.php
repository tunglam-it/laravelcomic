@extends('admin.admin-dashboard')
@section('title')
    <title>Cập nhật News</title>
@endsection
@section('minor_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.layouts.content-header',['minorTitle'=>'Cập nhật News'])
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
                        <form action="{{route('admin.news.update',['id'=>$news->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           value="{{$news->title}}">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="newsSlug">Slug News</label>
                                    <input type="text" name="slug"
                                           class="form-control @error('slug') is-invalid @enderror" id="newsSlug"
                                           value="{{$news->slug}}">
                                    @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="newsContent">Nội dung</label>
                                    <textarea name="content"
                                              class="form-control @error('content') is-invalid @enderror"
                                              id="newsContent">{{$news->content}}</textarea>
                                    @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Upload Ảnh</label>
                                <div class="input-group">
                                    <input name="image" type="file" @error('image') is-invalid
                                           @enderror onchange="readURL(this);">
                                    <img style="width: 90px;height: 80px;" id="preview_img"
                                         src="{{$news->image}}" alt="your image"/>
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

        $('#title').change(function () {
            $.ajax({
                url: '{{route("admin.news.slug")}}',
                dataType: 'json',
                type: 'get',
                data: {title: $(this).val()},
                success: function (response) {
                    $('#newsSlug').val(response.slug)
                }
            })
        })

        CKEDITOR.replace('newsContent')
    </script>
@endsection
