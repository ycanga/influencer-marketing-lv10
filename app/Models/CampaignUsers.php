<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignUsers extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'email', 'photo');
    }

    public function campaigns()
    {
        return $this->belongsTo(Campaigns::class, 'campaign_id')->select('id', 'name', 'type');
    }
}
