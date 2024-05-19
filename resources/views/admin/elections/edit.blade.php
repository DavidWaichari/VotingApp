@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">ELections</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">ELections</li>
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
          <h3 class="card-title">Edit Election</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/admin/elections/{{$election->id}}" method="POST">
          @csrf
          @method('PUT')
          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Position Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter position name" name="position_name" value="{{$election->position_name}}" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Maximum Selections</label>
              <input type="number" class="form-control" id="exampleInputEmail1" min="1" name="maximum_selections" value="{{$election->maximum_selections}}" required>
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