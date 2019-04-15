@extends('layouts.app')
@section('content')
<div class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-olive rounded box-shadow">
        <img class="mr-3" src="{{asset('lime.png')}}" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">{{ ucfirst(Auth::user()->name) }} Booking History</h6>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
    @endif
    <ul class="list-group">
        @foreach($history as $booking)
        <li class="list-group-item">{{$booking->property_name}} <small>({{ $booking->created_at->diffForHumans() }})</small></li>
        @endforeach
    </ul>
</div>
@endsection