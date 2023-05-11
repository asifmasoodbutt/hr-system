<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'pay_scale_id',
        'position',
        'job_description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
