<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = ['child_id', 'activity_type', 'description', 'time', 'status'];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
