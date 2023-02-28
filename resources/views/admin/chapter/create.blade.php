@extends('admin.admin-dashboard')
@section('title')
    <title>Thêm mới Chapter</title>
@endsection
@section('minor_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.layouts.content-header',['minorTitle'=>'Thêm mới Chapter'])
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
                        <form action="{{route('admin.chapter.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="title">Tiêu đề</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           value="{{old('title')}}">
                                    @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="chapterSlug">Slug Chapter</label>
                                    <input type="text" name="slug_chapter"
                                           class="form-control @error('slug_chapter') is-invalid @enderror" id="chapterSlug"
                                           value="{{old('slug_chapter')}}">
                                    @error('slug_chapter')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="chapterDescription">Mô tả</label>
                                    <textarea name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              id="chapterDescription" rows="5">{{old('description')}}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="chapterContent">Nội dung</label>
                                    <textarea name="chapter_content"
                                              class="form-control @error('chapter_content') is-invalid @enderror"
                                              id="chapterContent">{{old('chapter_content')}}</textarea>
                                    @error('chapter_content')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Chọn Truyện</label>
                                <select class="form-control form-control-sm @error('comic_id') is-invalid @enderror" name="comic_id">
                                    <option value="">--- Hãy chọn Truyện ---</option>
                                    @foreach($comics as $comic)
                                        <option value="{{$comic->id}}">{{$comic->name}}</option>
                                    @endforeach
                                </select>
                                @error('comic_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="chapterStatus1" name="status"
                                           class="custom-control-input @error('status') is-invalid @enderror" value="0">
                                    <label class="custom-control-label" for="chapterStatus1">Ẩn</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="chapterStatus2" name="status"
                                           class="custom-control-input @error('status') is-invalid @enderror" value="1">
                                    <label class="custom-control-label" for="chapterStatus2">Hiện</label>
                                </div>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
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
        $('#title').change(function () {
            $.ajax({
                url: '{{route("admin.chapter.slug")}}',
                dataType: 'json',
                type: 'get',
                data: {title: $(this).val()},
                success: function (response) {
                    $('#chapterSlug').val(response.slug)
                }
            })
        })

        CKEDITOR.replace('chapterContent')
    </script>
@endsection
