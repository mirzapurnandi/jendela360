<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = "sales";

    protected $fillable = ['nama', 'email', 'no_hp', 'car_id', 'tanggal_jual'];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
