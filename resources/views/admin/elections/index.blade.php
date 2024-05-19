@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Elections</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Elections</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between">
                  <h3 class="card-title">Elections List</h3>
                    <a type="button" class="btn btn-success btn-sm" href="/admin/elections/create">Add Elections</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">SNO</th>
                      <th>Position Name</th>
                      <th>Maximum Selections</th>
                      <th>Is Active</th>
                      <th>Created At</th>
                      <th>Started At</th>
                      <th>Ended At</th>
                      <th>Duration</th>
                      <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($elections as $election)
                        <tr>
                          <td class="text-center">{{$loop->index + 1}}</td>
                          <td>{{$election->position_name}}</td>
                          <td>{{$election->maximum_selections}}</td>
                          <td>{{$election->is_active}}</td>
                          <td>{{$election->created_at}}</td>
                          <td>{{$election->started_at}}</td>
                          <td>{{$election->ended_at}}</td>
                          <td>{{$election->duration}}</td>
                          <td style="display:flex; align-items:center;">
                            <a type="button" class="btn btn-primary btn-sm" href="{{route('elections.show', $election->id)}}">Manage</a>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th class="text-center">SNO</th>
                      <th>Position Name</th>
                      <th>Maximum Selections</th>
                      <th>Is Active</th>
                      <th>Created At</th>
                      <th>Started At</th>
                      <th>Ended At</th>
                      <th>Duration</th>
                      <th>Actions</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row --> 
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection