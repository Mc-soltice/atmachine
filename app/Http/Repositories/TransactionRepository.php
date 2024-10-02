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
        // return Transaction::all();
        return Transaction::with(relations: 'user')->orderBy('id', 'desc')->get();

    }

}