<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'biography'];

    public function computers()
    {
        return $this->belongstoMany(Computer::class)->withTimestamps();
    }
}
