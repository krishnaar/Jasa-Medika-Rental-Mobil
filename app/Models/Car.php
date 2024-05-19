<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "cars";
    protected $fillable = [
        "merk",
        "model",
        "plat",
        "rate",
        "image",
    ];

    public function rent()
    {
      return $this->hasMany('App\Models\RentCar')->latest();
    }
}
