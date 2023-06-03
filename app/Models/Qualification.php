<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'degree_level_id',
        'institution',
        'graduation_year'
    ];

    public function degreeLevel()
    {
        return $this->belongsTo(DegreeLevel::class);
    }
}
