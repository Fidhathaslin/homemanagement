<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
    'company_name', 'bank_name', 'account_number', 'passbook_number',
    'branch_name', 'iban', 'currency', 'account_type', 'passbook_issue_date', 'balance'
];

public function transactions()
{
    return $this->hasMany(BankTransaction::class);
}

}
