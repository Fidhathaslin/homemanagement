<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id', 'role',
    'account_name', 'company_name', 'bank_name', 'address', 'city',
    'account_number', 'swift_code', 'passbook_number',
    'branch_name', 'iban', 'currency', 'account_type',
    'passbook_issue_date', 'balance'
];
protected $casts = [
    'passbook_issue_date' => 'date',
];

public function transactions()
{
    return $this->hasMany(BankTransaction::class);
}
public function user()
{
    return $this->belongsTo(User::class);
}

}
