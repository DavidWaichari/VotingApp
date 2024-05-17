@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$candidates->count()}}</h3>

                <p>Candidates</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="/admin/candidates" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$registered_voters}}</h3>

                <p>Registered Voters</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/admin/voters?status=registered" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$unregistered_voters}}</h3>

                <p>Unregistered Voters</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="/admin/voters?status=unregistered" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$votes}}</h3>

                <p>All Votes Cast</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                      <h3 class="card-title">Candidates</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th class="text-center">SNO</th>
                          <th>Picture</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>No of Votes</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($candidates as $candidate)
                            <tr>
                              <td class="text-center">{{$loop->index + 1}}</td>
                              <td>
                                @if ($candidate->getFirstMediaUrl())
                                <img src="{{$candidate->getFirstMediaUrl()}}" alt="No Picture" height="150" width="150">
                                @else
                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="No Picture" height="150" width="150">
                                @endif
                              </td>
                              <td>{{$candidate->name}}</td>
                              <td>{{$candidate->description}}</td>
                              
                              <td>{{$candidate->votes->count()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-center">S/NO</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>No of Votes</th>
                        </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
        <!-- Main row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection