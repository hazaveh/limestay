@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-olive rounded box-shadow">
        <img class="mr-3" src="{{asset('lime.png')}}" alt="" width="48" height="48">
        <div class="lh-100">
          <h6 class="mb-0 text-white lh-100">Welcome To Lime Stay</h6>
          <p>
            Find & Book Awesome Places nearby your Location.
          </p>
        </div>
    </div>

    <div class="my-3 p-4 bg-white rounded box-shadow container-fluid" id="bookingapp">
      <div v-if="!accommodations.length && !locationError" class="text-center">
        <img src="{{asset('lime.png')}}" width="64" class="mb-3" alt="">
        <h3>Loading Accommodations...</h3>
      </div>
      <div class="text-center" v-if="accommodations.length">
          <h1>Properties Nearby</h1>
          <div class="row justify-content-md-center">
              <property v-for="(property, i) in accommodations" :key="property.id" :id="i" :property="property"></property>
          </div>
      </div>
      <div v-if="locationError" class="text-center text-danger">
        <img src="{{asset('error.png')}}" class="mb-3" alt="">
        <h5>@{{locationError}}</h5>
      </div>
    </div>
</div>
@endsection

@section('footerScripts')
  <script src="{{asset('js/booking.js')}}"></script>
@endsection

