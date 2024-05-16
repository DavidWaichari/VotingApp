@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Add Voter</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Voter</li>
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
          <h3 class="card-title">Add Voter</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/admin/voters" method="POST" enctype="multipart/form-data" autocomplete="off">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" class="form-control" id="Name" placeholder="Enter name" name="name" value="" required>
            </div>
            <div class="form-group">
              <label for="MemberNumber">Member Number</label>
              <input type="text" class="form-control" id="MemberNumber" placeholder="Enter member's number" name="member_number" value="">
            </div>
            <div class="form-group">
              <label for="IDNumber">ID Number</label>
              <input type="text" class="form-control" id="IDNumber" placeholder="Enter ID number" name="id_number" value="">
            </div>
            <div class="form-group">
              <label for="Phonenumber">Phone Number</label>
              <input type="text" class="form-control" id="Phonenumber" placeholder="Enter phone number" name="phone_number" value="">
            </div>
            <div class="form-group">
              <label for="Email">Email</label>
              <input type="email" class="form-control" id="Email" placeholder="Enter email" name="email" value="">
            </div>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1" name="can_vote">
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