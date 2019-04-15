<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use Auth;
use App\User;
use Session;

class BookingController extends Controller
{
    /**
     * returns booking page for a property
     *
     * @param int $property
     * @return void
     */
    public function create($property) {
        try {
            $property = Property::findOrFail($property);
            return view('property', compact('property'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * stores a booking made by logged in user.
     * @param Request $request
     * @param Property $property
     */
    
    public function store(Request $request, Property $property) {
        Auth::user()->bookings()->create([
            'property_id' => $property->id,
            'property_name' => $property->property_name,
            'city' => $request->input('city'),
            'checkin' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('start')),
            'checkout' => \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('end'))
        ]);

        return redirect('history')->with(['success' => 'Booking Successfull.']);
    }

    /**
     * returns collection of bookings made by a user.
     * @param User $user
     */

    public function byUser(User $user) {
        return $user->bookings;
    }

    /**
     * returns collection of bookings made for a property
     * @param Property $property
     */

    public function byProperty(Property $property) {
        return $property->bookings()->with(['user'])->get();
    }
}
