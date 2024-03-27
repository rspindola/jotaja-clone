<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
    'customer_id',
    'company_id',
    'status',
    'total',
    'order_date'
  ];

  public function items()
  {
    return $this->hasMany(OrderItem::class);
  }

  public function company()
  {
    return $this->belongsTo(Company::class);
  }
}
