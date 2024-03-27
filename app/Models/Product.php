<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory;

  protected $fillable = [
    'company_id',
    'category_id',
    'name',
    'description',
    'price',
    'image',
  ];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}
