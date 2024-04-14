<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status_id',
        'stock_quantity'
    ];

    // Define the relationship with the Status model
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
