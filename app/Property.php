<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $guarded = ['id'];
    protected $hidden = ['href', 'response'];

    public function bookings() {
        return $this->hasMany('App\Booking', 'property_id', 'id');
    }
}
