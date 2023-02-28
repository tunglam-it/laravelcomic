@extends('admin.admin-dashboard')
@section('title')
    <title>Tạo mới Thể loại Truyện</title>
@endsection
@section('minor_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.layouts.content-header',['minorTitle'=>'Thêm mới Thể loại'])
    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
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
                        <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="categoryName">Tên thể loại</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="categoryName" value="{{old('name')}}">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="categorySlug">Slug thể loại</label>
                                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="categorySlug" value="{{old('slug')}}">
                                    @error('slug')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="categoryDescription">Mô tả</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="categoryDescription" rows="5">{{old('description')}}</textarea>
                                    @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" name="status" class="custom-control-input @error('status') is-invalid @enderror" value="0">
                                        <label class="custom-control-label" for="customRadioInline1">Ẩn</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" name="status" class="custom-control-input @error('status') is-invalid @enderror" value="1">
                                        <label class="custom-control-label" for="customRadioInline2">Hiện</label>
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
        $('#categoryName').change(function (){
            $.ajax({
                url:'{{route("admin.category.slug")}}',
                dataType:'json',
                type:'get',
                data:{name:$(this).val()},
                success:function (response){
                    $('#categorySlug').val(response.slug)
                }
            })
        })
    </script>
@endsection
