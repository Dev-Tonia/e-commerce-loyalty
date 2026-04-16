<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = ['name', 'required_purchases'];

    // An achievement can be unlocked by many users
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_achievements')
            ->withTimestamps();
    }
}
