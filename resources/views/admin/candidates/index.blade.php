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
                  <h3 class="card-title">Candidates List for {{$election_text}}</h3>
                    <a type="button" class="btn btn-success btn-sm" href="/admin/candidates/create?election_id={{$election_id}}">Add Candidate</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th class="text-center">SNO</th>
                      <th>Picture</th>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Description</th>
                      <th>No of Votes</th>
                      <th>Election Status</th>
                      <th>Actions</th>
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
                            <img src="/assets/img/user_image.png" alt="No Picture" height="150" width="150">
                            @endif
                          </td>
                          <td>{{$candidate->name}}</td>
                          <td>{{$candidate->election->position_name}} | {{$candidate->election->created_at->format('m Y')}}</td>
                          <td>{{$candidate->description}}</td>
                          
                          <td>{{$candidate->votes->count()}}</td>
                          <td>{{$candidate->election->is_active == 'Yes'? 'Active': 'In Active'}}</td>
                          <td style="display:flex; align-items:center; justify-content:space-between">
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default-{{$candidate->id}}">
                                Picture
                            </button>
                            <a type="button" href="{{route('candidates.edit', $candidate->id)}}" class="btn btn-sm btn-rounded btn-warning">Edit</a>
                            <button class="btn btn-sm btn-rounded btn-danger" onclick="if (confirm('Are you sure you want to delete this candidate?')) { document.getElementById('deleteForm-{{$candidate->id}}').submit(); }">Delete</button>
                            <form action="{{route('candidates.destroy', $candidate->id)}}" id="deleteForm-{{$candidate->id}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="text-center">S/NO</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Description</th>
                        <th>No of Votes</th>
                        <th>Election Status</th>
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

    @foreach ($candidates as $candidate)
    <div class="modal fade" id="modal-default-{{$candidate->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Picture of {{$candidate->name}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  @if ($candidate->getFirstMediaUrl())
                  <img src="{{$candidate->getFirstMediaUrl()}}" alt="{{$candidate->name}} Picture" style="max-width: 100%; height: auto;">
                  @else
                  <img src="/admin-site/dist/img/avatar.png" alt="{{$candidate->name}} Picture" style="max-width: 100%; height: auto;">
                  @endif
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @endforeach
@endsection