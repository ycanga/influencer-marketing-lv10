<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaigns extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function merchant()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id', 'name', 'email');
    }
}
