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
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
