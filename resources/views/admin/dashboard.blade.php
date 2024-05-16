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
                <h3>{{$candidates}}</h3>

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
                      <h3 class="card-title">Votes</h3>
                    </div>
                    <div class="card-body table-responsive p-0">
                      <table class="table table-striped table-valign-middle">
                        <thead>
                        <tr>
                        <th>Rank</th>
                          <th>Picture</th>
                          <th>Name</th>
                          <th>No of Votes</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>$13 USD</td>
                          <td>
                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                          </td>
                          <td>
                            <small class="text-success mr-1">
                              <i class="fas fa-arrow-up"></i>
                              12%
                            </small>
                            12,000 Sold
                          </td>
                          <td>
                            <a href="#" class="text-muted">
                              <i class="fas fa-search"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                            <td>$29 USD</td>
                          <td>
                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                          </td>
                          <td>
                            <small class="text-warning mr-1">
                              <i class="fas fa-arrow-down"></i>
                              0.5%
                            </small>
                            123,234 Sold
                          </td>
                          <td>
                            <a href="#" class="text-muted">
                              <i class="fas fa-search"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                            <td>$1,230 USD</td>
                          <td>
                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                          </td>
                          <td>
                            <small class="text-danger mr-1">
                              <i class="fas fa-arrow-down"></i>
                              3%
                            </small>
                            198 Sold
                          </td>
                          <td>
                            <a href="#" class="text-muted">
                              <i class="fas fa-search"></i>
                            </a>
                          </td>
                        </tr>
                        <tr>
                            <td>$199 USD</td>
                          <td>
                            <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                          </td>
                          <td>
                            <small class="text-success mr-1">
                              <i class="fas fa-arrow-up"></i>
                              63%
                            </small>
                            87 Sold
                          </td>
                          <td>
                            <a href="#" class="text-muted">
                              <i class="fas fa-search"></i>
                            </a>
                          </td>
                        </tr>
                        </tbody>
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