<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function ownedGroups()
    {
        return $this->hasMany(Group::class, 'owner_id');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user');
    }

    public function rsvps()
    {
        return $this->hasMany(AppointmentRsvp::class);
    }

    // Dashboard berekende attributen (ipv UserDashboard tabel)
    public function getOpenTasksCountAttribute()
    {
        return $this->tasks()->where('status', '!=', 'done')->count();
    }

    public function getCompletedPercentageAttribute()
    {
        $total = $this->tasks()->count();
        return $total > 0 ? round(($this->tasks()->where('status', 'done')->count() / $total) * 100, 1) : 0;
    }

    public function getNextAppointmentAttribute()
    {
        return $this->groups()
            ->with(['appointments' => fn($q) => $q->where('date_time', '>=', now())->orderBy('date_time')])
            ->get()
            ->pluck('appointments')
            ->flatten()
            ->sortBy('date_time')
            ->first();
    }
}
