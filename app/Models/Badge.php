<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = ['name', 'required_achievements'];

    // A badge can be earned by many users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_badges')
            ->withTimestamps();
    }
}
