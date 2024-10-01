<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model

{
    use HasFactory;
    protected $fillable = 
    [
        'bank_account_id', 
        'type', 
        'amount', 
        'target_account_id'
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function targetAccount()
    {
        return $this->belongsTo(BankAccount::class, 'target_account_id');
    }
}
