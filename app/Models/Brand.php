<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // returns the brand's computers
    // eg. $brand->computers
    public function computers()
    {
        return $this->hasMany(Computer::class);
    }
}
