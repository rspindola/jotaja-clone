<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'department_id',
    'name',
    'description',
    'email',
    'cnpj',
    'phone',
    'phone_alternative',
    'whatsapp',
  ];

  public function department()
  {
    return $this->belongsTo(Department::class);
  }

  public function addresses()
  {
    return $this->hasOne(CompanyAddress::class);
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
