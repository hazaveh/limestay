<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $guarded = ['id'];

    public function user() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
