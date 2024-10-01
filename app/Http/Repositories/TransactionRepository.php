<?php
namespace App\Http\Repositories;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\BankAccount;
use App\Models\Transaction;
class TransactionRepository 
{
protected $model;

public function __construct(Transaction $transaction,BankAccount $bankAccount)
{
    $this->model = $transaction;
    $this->model = $bankAccount;
}
  
    public function deposit(BankAccount $account, float $amount)
    {
        $account->balance += $amount;
        $account->save();
        
        return transaction::create([
            'bank_account_id' => $account->id,
            'type' => 'deposit',
            'amount' => $amount
        ]);
    }
    
    public function withdraw(BankAccount $account, float $amount)
    {
        if ($account->balance < $amount) {
            throw new \Exception("Fonds insuffisants");
        }
        
        $account->balance -= $amount;
        $account->save();
        
        return transaction::create([
            'bank_account_id' => $account->id,
            'type' => 'withdrawal',
            'amount' => $amount
        ]);
    }
}