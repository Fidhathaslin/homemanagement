<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;

  protected $fillable = [
        'bank_account_id',
          'user_id',
        'type',
        'amount',
        'description',
        'reference_no',
        'transaction_date',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function bankAccount()
{
    return $this->belongsTo(BankAccount::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}


public function salary()
{
    return $this->hasOne(Salary::class);
}


}
