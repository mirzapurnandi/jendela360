<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = ['nama', 'harga', 'stok'];

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }
}
