<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Uses the Model to fill the attributes that are protected.
class Computer extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'brand', 'graphics_card', 'processor', 'storage', 'ram', 'price'];
    // protected $guarded= [];
}
