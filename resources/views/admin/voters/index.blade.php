@extends('admin/layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-9" style="display:flex; align-items: center; justify-content:space-between ">
                <h1 class="m-0">{{$title}} Voters</h1>
                <a href="/admin/voters?status=registered" type="button" class="btn btn-success btn-sm">Registered</a>
                <a href="/admin/voters?status=unregistered" type="button" class="btn btn-secondary btn-sm">Unregistered</a>
                <a href="/admin/voters?status=voted" type="button" class="btn btn-secondary btn-sm">Voted</a>
                <a href="/admin/voters?status=not_voted" type="button" class="btn btn-secondary btn-sm">Not Voted</a>
            </div><!-- /.col -->
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">{{$title}} Voters</li>
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
                    <div class="card-header">
                      <div class="row">
                        <div class="col-md-6" style="display: flex; justify-content:space-evenly">
                          <h3 class="card-title">{{$title}} Voters List</h3>
                          <a type="button" class="btn btn-success btn-sm" style="width: 30%" href="/admin/voters/create">Add Voter</a>
                        </div>
                        <div class="col-md-6">
                          <form action="{{ route('voters.import') }}" method="POST" enctype="multipart/form-data" style="display: flex; align-items:center; justify-content: space-evenly">
                            @csrf
                            <input type="file" name="file" class="form-control">
                            <button type="submit" class="btn btn-primary btn-sm btn-block ml-2">Import Excel</button>
                        </form>
                        </div>
                      </div>
                          
                          
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">SNO</th>
                                    <th>Name</th>
                                    <th>Member Number</th>
                                    <th>ID No</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Can Vote</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($voters as $voter)
                                <tr>
                                    <td class="text-center">{{$loop->index + 1}}</td>
                                    <td>{{$voter->name}}</td>
                                    <td>{{$voter->member_number}}</td>
                                    <td>{{$voter->id_number}}</td>
                                    <td>{{$voter->phone_number}}</td>
                                    <td>{{$voter->email}}</td>
                                    <td>{{$voter->can_vote}}</td>
                                    <td style="display:flex; align-items:center;">
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default-{{$voter->id}}">
                                            Picture
                                        </button>
                                        <a type="button" href="{{route('voters.edit', $voter->id)}}" class="btn btn-sm btn-rounded btn-warning">Edit</a>
                                        <button class="btn btn-sm btn-rounded btn-danger" onclick="if (confirm('Are you sure you want to delete this voter?')) { document.getElementById('deleteForm-{{$voter->id}}').submit(); }">Delete</button>
                                        <form action="{{route('voters.destroy', $voter->id)}}" id="deleteForm-{{$voter->id}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-center">SNO</th>
                                    <th>Name</th>
                                    <th>Member Number</th>
                                    <th>ID No</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Can Vote</th>
                                    <th>Action</th>
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

@foreach ($voters as $voter)
<div class="modal fade" id="modal-default-{{$voter->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Picture of {{$voter->name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              @if ($voter->getFirstMediaUrl())
              <img src="{{$voter->getFirstMediaUrl()}}" alt="{{$voter->name}} Picture" style="max-width: 100%; height: auto;">
              @else
              <img src="/admin-site/dist/img/avatar.png" alt="{{$voter->name}} Picture" style="max-width: 100%; height: auto;">
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
