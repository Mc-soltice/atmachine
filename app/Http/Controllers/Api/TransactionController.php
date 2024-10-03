<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Service\TransactionService;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\User;

class TransactionController extends Controller
{
    protected $transactionService;
    
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    
    public function doTransaction (TransactionRequest $request,$userId)
    {
        $data = $request->validated();

        $user = User::findOrFail($userId);

        $bankAccountId = $user->bankAccount->id;
        
        $status = $this->transactionService->processTransaction($bankAccountId, $data['amount'], $data['type']);

        return  new TransactionResource($status);

    }
    public function getAllTransactions()
    {
        $transaction= $this->transactionService->getAllTransactions();

        return TransactionResource::collection($transaction);
    }
    public function transferFunds (TransactionRequest $request,$userId){

        $data = $request->validated();

        return $this->transactionService->transferFunds($userId,$data['to_account_id'],$data['amount'], );
    }

}
