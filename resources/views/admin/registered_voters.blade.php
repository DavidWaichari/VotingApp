@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Registered Voters</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Registered Voters</li>
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
                  <h3 class="card-title">Registered Voters List</h3>
                    <a type="button" class="btn btn-success btn-sm" href="/admin/voters/create">Add Voter</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">SNO</th>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>ID No</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($registered_voters as $registered_voter)
                        <tr>
                          <td class="text-center">{{$loop->index + 1}}</td>
                          <td>{{$registered_voter->name}}</td>
                          <td>{{$registered_voter->phone_number}}</td>
                          <td>{{$registered_voter->id_no}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                      <th class="text-center">SNO</th>
                      <th>Name</th>
                      <th>Phone Number</th>
                      <th>ID No</th>
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