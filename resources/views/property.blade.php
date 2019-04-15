@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-6 offset-md-3">
            <div class="card">
                    <h5 class="card-header">{{$property->property_name}}</h5>
                    <img class="card-img-top" src="https://source.unsplash.com/400x250/?resort,hotel" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text">{{$property->address}}</p>
                        <form method="POST" action="{{url("book/" . $property->id)}}">
                            <div class="form-group">
                                    <label for="date">Select Booking Date</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="input-sm form-control" name="start" autocomplete="off" />
                                        <span class="input-group-text mx-1">to</span>
                                        <input type="text" class="input-sm form-control" name="end" autocomplete="off" />
                                    </div>
                                    @csrf
                                <input type="hidden" name="city" value="{{Facades\App\Lib\Here::getPlace($property->href)['city']}}">
                            </div>
                            <button type="submit" @if(!Auth::user()) disabled @endif class="btn btn-success btn-block">Confirm Booking</button>
                        </form>
                        @if(!Auth::user())
                        <p class="text-center mt-2 text-danger">Please <a href="{{ url('login') }}">Login</a> or <a href="{{ url('register') }}">Register</a> to confirm your Booking.</p>
                        @endif
                    </div>
            </div>
    </div>
</div>
@endsection

@section("footerScripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script>
$('.input-daterange').datepicker({
    format: "dd-mm-yyyy",
    startDate: "+0d"
});
</script>
@stop

@push("styles")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.standalone.css" />
@endpush
