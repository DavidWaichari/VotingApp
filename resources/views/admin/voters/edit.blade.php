@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Edit Voter</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Voter</li>
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
          <h3 class="card-title">Edit Voter</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/admin/voters/{{$voter->id}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" value="{{$voter->name}}" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Member Number</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter member's number" name="member_number" value="{{$voter->member_number}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">ID Number</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter ID number" name="id_number" value="{{$voter->id_number}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Phone Number</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter phone number" name="phone_number" value="{{$voter->phone_number}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="{{$voter->email}}">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name="can_vote" {{$voter->can_vote == 'Yes' ? 'checked' : ''}}>
              <label class="form-check-label" for="exampleCheck1">Can vote</label>
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