<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SiteController extends Controller
{
    public function index() {
        return view('index');
    }

    /**
     * Make use of the User API to get booking history for currently logged in user.
     */
    public function bookingHistory() {
        return view('history', [
            "history" => app('App\Http\Controllers\BookingController')->byUser(Auth::user())
        ]);
    }
}
