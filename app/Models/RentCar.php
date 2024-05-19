<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCar extends Model
{
    use HasFactory;

    protected $table = "rent_cars";
    protected $fillable = [
        "user_id",
        "car_id",
        "from_date",
        "to_date",
        "return_date",
        "status",
        "fee",
        "total_fee",
    ];

    public function user()
    {
      return $this->belongsTo('App\Models\User')->withTrashed();
    }

    public function car()
    {
      return $this->belongsTo('App\Models\Car')->withTrashed();
    }
}
