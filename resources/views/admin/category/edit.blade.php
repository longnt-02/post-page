@extends('admin.layout.master')
@section('title', 'Create category')
@section('title-content', 'Create category')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Update</small>
                    </h1>
                    @if(count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="{{ route("admin.category.update",$category->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Category Name</label>
                            <input class="form-control" name="name" placeholder="Please Enter Category Name" value="{{$category->name}}"/>
                        </div>

                        <button type="submit" class="btn btn-default">Create</button>
                    <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection