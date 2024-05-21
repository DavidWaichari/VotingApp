@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center text-bold">VOTING SYSTEM</h1>
    <h2 class="text-center text-bold text-danger">{{$election->position_name}} Elections Year {{$election->created_at->format('Y')}}</h2>
    <voting-component></voting-component>
</div>
@endsection
