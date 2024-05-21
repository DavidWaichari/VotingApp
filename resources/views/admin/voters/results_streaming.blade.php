@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Live Results for {{$elections_text}} Elections</h1>
            <form action="" method="get" action="/admin/voters/streaming" style="display: flex; align-items:center; justify-content:space-between; padding:10px">
                <select class="form-control" style="margin-right: 10px" name="election_id">
                    <option value="">Select election</option>
                    @foreach ($elections as $election)
                    <option {{$election_id == $election->id ? 'selected': ''}} value="{{$election->id}}">{{$election->position_name}}</option>
                    @endforeach
                </select>
                <button  class="btn btn-primary" type="submit">Select</button>
            </form>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Results Streaming</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <results-component>

        </results-component>
    </section>
    <!-- /.content -->
@endsection