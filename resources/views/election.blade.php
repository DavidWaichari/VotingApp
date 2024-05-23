@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-bold">VOTING SYSTEM</h1>
    <div  class="row">
        <div class="col-md-9">
            <h2 class="text-center text-bold text-danger">{{$election->position_name}} Elections Year {{$election->created_at->format('Y')}}</h2>
        </div>
        <div class="col-md-3">
            <a type="button" class="btn btn-info" href="/home">Back Home</a>
        </div>
    </div> 
        <voting-component></voting-component>
</div>
@endsection
