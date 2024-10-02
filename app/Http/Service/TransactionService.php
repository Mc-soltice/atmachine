<?php
namespace App\Http\Service;
   
use App\Models\BankAccount;
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
            throw new \Exception('Insufficient funds.');
        }
        
        $transactionData = [
            'amount' => $amount,
            'type' => $transactionType,
            'bank_account_id' => $bankAccountId,
        ];
        
        
        // Update balance
        $bankAccount->balance += $transactionType === 'deposit' ? $amount : -$amount;
        $bankAccount->save();
        return $this->transactionRepository->create($transactionData);
    }
    public function getAllTransactions(){
        return $this->transactionRepository->getAllTransactions();
    }

























    // public function handleTransaction( $request, string $operation)
    // {
    //     // Récupérer le compte bancaire de l'utilisateur connecté
    //     $account = Auth::user()->bankAccount;

    //     // Vérifier que l'utilisateur a un compte bancaire
    //     if (!$account) {
    //         return response()->json(['message' => 'Aucun compte bancaire trouvé'], 404);
    //     }

    //     // Récupérer les donnees validées
    //     $amount = $request['amount'];
    //     $account = $request['bank_account_id'];

    //     // Appeler les services de transaction en fonction de l'opération
    //     if ($operation === 'deposit') {
    //        return $this->transactionRepository->deposit($account, $amount);
            
    //     } elseif ($operation === 'withdraw') {
    //       return $this->transactionRepository->withdraw($account, $amount);

    //     }
    // }

}





   