<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'salary',
        // Add other fillable fields here as needed
    ];
    public function events() 
    {
        return $this->hasMany(Event::class);
    }
}
