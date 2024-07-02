<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignCategories extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(CampaignCategories::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by','id')->select('id', 'name');
    }
}
