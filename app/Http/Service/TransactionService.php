<?php
namespace App\Http\Service;

use App\Models\BankAccount;
use App\Models\User;
use App\Http\Repositories\TransactionRepository;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function processTransaction($bankAccountId, $amount, $transactionType)
    {
        $bankAccount = BankAccount::findOrFail($bankAccountId);

        if ($transactionType === 'withdraw' && $bankAccount->balance < $amount) {

            return response()->json('Insufficient funds for transfer.');
        }
        $transactionData = [
            'amount' => $amount,
            'type' => $transactionType,
            'bank_account_id' => $bankAccountId,
        ];

        // Update balance
        if ($transactionType === 'deposit') {

            $bankAccount->balance += $amount; // Dans le cas d'un depot le montant seras ajouter a la balance

        } elseif ($transactionType === 'withdraw') 
        {
            if ($bankAccount->balance < $amount) {

                throw new \Exception('Insufficient funds.'); // Vérifie que le solde est suffisant
            }
            
            $bankAccount->balance -= $amount; // Dans le d'un retrait, on soustrait le montant de la balance
        } 
        else {
            throw new \Exception('Invalid transaction type.'); // Gestion des types de transaction invalides
        }
        $bankAccount->save();
        return $this->transactionRepository->create($transactionData);
    }
    public function getAllTransactions()
    {
        return $this->transactionRepository->getAllTransactions();
    }


    public function transferFunds($userId, $toBankAccountId, $amount)
    {
        $fromBankAccount = User::findOrFail($userId)->bankAccount;

        $fromBankAccountId = User::findOrFail($userId)->bankAccount->id;
        
        $toBankAccount = BankAccount::findOrFail($toBankAccountId);

        if ($fromBankAccount->balance < $amount) {
            return response()->json('Insufficient funds for transfer.');
        }

        $this->transactionRepository->createTransferTransaction($fromBankAccountId, $toBankAccountId, $amount);
        
        // je fais la mise à jour les soldes
        $fromBankAccount->balance -= $amount;
        $fromBankAccount->save();
        
        $toBankAccount->balance += $amount;
        $toBankAccount->save();

    return (object) [
        'from_account_id' => $fromBankAccountId,
        'from_account_balance' => $fromBankAccount->balance,
        'to_account_id' => $toBankAccountId,
        'to_account_balance' => $toBankAccount->balance,
        'amount' => $amount,
    ];
    }
    
}

