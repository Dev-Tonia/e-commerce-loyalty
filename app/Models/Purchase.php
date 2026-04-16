<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'amount', 'item_name'];

    // A purchase belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
