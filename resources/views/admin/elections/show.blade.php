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
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Election Details</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
          <div class="card-body">

            <table class="table table-bordered table-striped">
              
              <tbody>
                  <tr>
                    <td>Position Name</td>
                    <td>{{$election->position_name}}</td>
                  </tr>
                  <tr>
                    <td>Maximum Selections</td>
                    <td>{{$election->maximum_selections}}</td>
                  </tr>
                  <tr>
                    <td>Is Active</td>
                    <td>{{$election->is_active}}</td>
                  </tr>
                  <tr>
                    <td>Created At</td>
                    <td>{{$election->created_at}}</td>
                  </tr>
                  <tr>
                    <td>Started At</td>
                    <td>{{$election->started_at}}</td>
                  </tr>
                  <tr>
                    <td>Ended At</td>
                    <td>{{$election->ended_at}}</td>
                  </tr>
                  <tr>
                    <td>Election Duration</td>
                    <td># Hours</td>
                  </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <div class="modal-footer justify-content-between">
              <a type="button" href="{{route('elections.edit', $election->id)}}" class="btn  btn-rounded btn-primary">Edit</a>
                              <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#modal-default-{{$election->id}}">
                                Delete
                            </button>
              <a type="button" href="/admin/candidates?election_id={{$election->id}}" class="btn btn-info">Candidates</a>
              <a type="button" href="/admin/voters?election_id={{$election->id}}&status=voted" class="btn btn-secondary">Voted</a>
              <a type="button" href="/admin/voters?election_id={{$election->id}}&status=not_voted" class="btn btn-primary">Not voted</a>
              @if ($election->is_active == 'No') 
              <a type="button" href="/admin/elections/{{$election->id}}/start" class="btn btn-success">Start Election</a>
              @else
              <a type="button" href="/admin/elections/{{$election->id}}/stop" class="btn btn-danger">Stop Election</a>
              @endif
            </div>
          </div>
      </div>
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-default-{{$election->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{route('elections.destroy', $election->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h4 class="modal-title">Delete {{$election->name}}?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  <h3>Are you sure you want to delete this election. This will delete all the past data: candidates and votes permanently</h3>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection