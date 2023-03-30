@extends('admin.admin-dashboard')
@section('title')
    <title>Chapter</title>
@endsection
@section('minor_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('admin.layouts.content-header',['minorTitle'=>'Chapter'])
    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <span class="card-title"><a href="{{route('admin.chapter.create')}}" class="btn btn-success">Thêm mới</a></span>
                        @if(session('message'))
                            <span id="session-message" class="m-2 text-success" onclick="setTimeout(function (){$('#session-message').hide()},3000)">{{session('message')}}</span>
                        @endif
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="admin_search"
                                       class="form-control float-right admin-search"
                                       placeholder="Nhập để tìm kiếm">
                                <div class="input-group-append">
                                    <button class="btn btn-default reset-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0 ajax-response" style="height: 700px;">

                        <div id="overlay">
                            <div>
                                <img src="{{asset('admin/assets/img/loading.gif')}}" width="32px" height="32px"/>
                            </div>
                        </div>
                        {{csrf_field()}}
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
    <script src="{{asset('admin/assets/js/ajax/ajax.chapter.js')}}"></script>
@endsection
