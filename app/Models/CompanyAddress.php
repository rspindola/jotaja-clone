<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'postal_code',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
