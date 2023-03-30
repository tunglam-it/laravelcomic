@extends('admin.admin-dashboard')
@section('title')
    <title>Admin Manager</title>
@endsection
@section('minor_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('admin.layouts.content-header',['minorTitle'=>'Dashboard'])
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <span style="font-size: 18px">Hey there! Welcome to the Admin Page, designed to help manage data for Comic Site :")</span>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
