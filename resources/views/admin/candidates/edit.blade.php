@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Candidates</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Candidates</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Candidate</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/admin/candidates/{{$candidate->id}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label>Select</label>
              <select class="form-control" name="election_id" required readonly>
                <option value="">Select Election</option>
                @foreach ($elections as $election)
                <option  value="{{$election->id}}" {{$election_id == $election->id ? 'selected' :''}}>{{$election->position_name}} | {{$election->created_at->format('m Y')}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" value="{{$candidate->name}}" readonly>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Description</label>
              <textarea  class="form-control" id="exampleInputPassword1" placeholder="description" name="description">{{$candidate->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">File input</label>
              <div class="input-group">
                  <input type="file" class="form-control" id="exampleInputFile" name="picture">
                <div class="input-group-append">
                  <span class="input-group-text">Upload</span>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection