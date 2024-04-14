<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  use HasFactory;

  protected $fillable = [
    'name'
  ];

  //relação status com produtos 1:N
  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
