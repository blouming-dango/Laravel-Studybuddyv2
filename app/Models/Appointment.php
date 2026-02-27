<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['group_id', 'date_time', 'location', 'subject'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function rsvps()
    {
        return $this->hasMany(AppointmentRsvp::class);
    }
}
