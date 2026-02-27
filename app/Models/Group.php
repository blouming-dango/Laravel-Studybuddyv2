<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'description', 'owner_id', 'join_code'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function isMember(?User $user = null): bool
    {
        if (! $user) {
            return false;
        }

        return $this->members()->where('user_id', $user->id)->exists()
            || $this->owner_id === $user->id;
    }
}
