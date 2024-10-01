<?php
namespace App\Http\Service;
   
use App\Models\BankAccount;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Repositories\TransactionRepository;



   class TransactionService
   {
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    //   Handle: Un switch Pour les operation de depots et retrait 
public function handleTransaction( $request, string $operation)
{
    // Récupérer le compte bancaire de l'utilisateur connecté
    $account = Auth::user()->bankAccount;

    // Vérifier que l'utilisateur a un compte bancaire
    if (!$account) {
        return response()->json(['message' => 'Aucun compte bancaire trouvé'], 404);
    }

    // Récupérer le montant validé
    $amount = $request['amount'];

    // Appeler les services de transaction en fonction de l'opération
    if ($operation === 'deposit') {
        $this->transactionRepository->deposit($account, $amount);
        
    } elseif ($operation === 'withdraw') {
        $this->transactionRepository->withdraw($account, $amount);

    }

    // Retourner un message de succès
}

   
       public function transfer(BankAccount $fromAccount, BankAccount $toAccount, float $amount)
       {
           $this->transactionRepository->withdraw($fromAccount, $amount);
           $this->transactionRepository->deposit($toAccount, $amount);
   
           return transaction::create([
               'bank_account_id' => $fromAccount->id,
               'type' => 'transfer',
               'amount' => $amount,
               'target_account_id' => $toAccount->id
           ]);
       }
   }
   