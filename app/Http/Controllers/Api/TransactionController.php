<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Transaction;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Service\TransactionService; // Correct namespace
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function deposit(transactionRequest $request, $operation)
    {
        $transaction = $this->transactionService->handleTransaction($request, 'deposit');

        return $transaction->json(['message' => ucfirst($operation) . ' réussi'], 200);
        
    }

    public function withdraw(transactionRequest $request, $operation)
    {
        $transaction = $this->transactionService->handleTransaction($request, 'withdraw');
        return $transaction->json(['message' => ucfirst($operation) . ' réussi'], 200);
    }

    public function transfer(TransactionRequest $request)
    {

        $fromAccount = Auth::user()->bankAccount;
        if (!$fromAccount) {
            return response()->json(['message' => 'Aucun compte bancaire trouvé'], 404);
        }

        $toAccount = BankAccount::findOrFail('target_account_id');
        $amount ='amount';

        $this->transactionService->transfer($fromAccount, $toAccount, $amount);

        return response()->json(['message' => 'Transfert réussi'], 200);
    }
}
