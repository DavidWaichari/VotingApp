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
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between">
                  <h3 class="card-title">Candidates List</h3>
                    <a type="button" class="btn btn-success btn-sm" href="/admin/candidates/create">Add Candidate</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">SNO</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Picture</th>
                      <th>No of Votes</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidates as $candidate)
                        <tr>
                          <td class="text-center">{{$loop->index + 1}}</td>
                          <td>{{$candidate->name}}</td>
                          <td>{{$candidate->description}}</td>
                          <td>
                            @if ($candidate->getFirstMediaUrl())
                            <img src="{{$candidate->getFirstMediaUrl()}}" alt="No Picture" height="150" width="150">
                            @else
                            <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="No Picture" height="150" width="150">
                            @endif
                          </td>
                          <td>{{$candidate->votes->count()}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="text-center">S/NO</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Picture</th>
                        <th>No of Votes</th>
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