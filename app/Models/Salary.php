<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
  protected $fillable = [
        'user_id',
        'amount',
        'month',
        'year',
        'status',
        'paid_date',
       
        
    ];
    protected $casts = [
    'paid_date' => 'date',
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function bankTransaction()
{
    return $this->belongsTo(BankTransaction::class);
}

}
