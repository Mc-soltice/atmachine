<?php
namespace App\Http\Repositories;

use App\Models\Transaction;
class TransactionRepository 
{
protected $model;

public function __construct(Transaction $transaction)
{
    $this->model = $transaction;
}
  

    public function create(array $data)
    {
        return Transaction::create($data);
    }
    public function getAllTransactions(){
        return Transaction::with(relations: 'user')->orderBy('id', 'desc')->get();

    }
        // Sa c'est la éthode pour enregistrer le transfert
        public function createTransferTransaction($fromAccountId, $toAccountId, $amount)
        {
            // Enregistre la transaction de retrait
            $this->model->create([
                'bank_account_id' => $fromAccountId,
                'amount' => $amount,
                'type' => 'withdraw',
            ]);
    
            // Enregistre la transaction de dépôt
            $this->model->create([
                'bank_account_id' => $toAccountId,
                'amount' => $amount,
                'type' => 'deposit',
            ]);
        }

}