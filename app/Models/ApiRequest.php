<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    use HasFactory;

    protected $fillable = ['endpoint', 'request_data', 'user_id'];
    
    public function setRequestDataAttribute($value)
    {
        $this->attributes['request_data'] = serialize($value);
    }

    public function setResponseDataAttribute($value)
    {
        $this->attributes['response_data'] = serialize($value);
    }
}
