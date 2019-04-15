<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Property;
use Facades\App\Lib\Here;

class APIController extends Controller
{
    public function searchNearby(Request $request) {
        $this->validate($request, [
            'lat' => 'required',
            'lng' => 'required'
        ]);

        try {


            if (Session::has('nearbyProperties')) {
                $properties = Session::get('nearbyProperties');
            } else {
                $result = Here::nearby($request->input('lat') . ',' . $request->input('lng'));
                $properties = collect([]);
                if (count($result)) {
                    foreach ($result as $property) {
                        $properties[] = Property::updateOrCreate([
                            'property_id' => $property['id']
                        ],[
                            'property_name' => $property['title'],
                            'address' => $property['vicinity'],
                            'href' => $property['href'],
                            'response' => serialize($property)                
                        ]);
                    }
                    
                    Session::put('nearbyProperties', $properties);

                } else {
                    throw new \Exception('No Properties Found');
                }
             }

             return $properties;

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function userBookings(User $user) {
        return response()->json(["bookings" => app('App\Http\Controllers\BookingController')->byUser($user)]);
    }

    public function propertyBookings(Property $property) {
        return response()->json(["bookings" => app('App\Http\Controllers\BookingController')->byProperty($property)]);
    }
}
