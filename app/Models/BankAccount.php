<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
class BankAccount extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'bank_account_id',
        'user_id',
        'balance'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}

