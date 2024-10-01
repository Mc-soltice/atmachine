<?php
namespace App\Http\Service;

use App\Http\Repositories\AuthentificationRepository;
use App\Http\Repositories\BankAccountRepository;
use App\Models\User;
use App\Models\BankAccount;


class AuthentificationService
{

    protected $authentificationRepository,$bankAccountRepository;

    public function __construct(AuthentificationRepository $authentificationRepository,BankAccountRepository $bankAccountRepository)
    {
        $this->authentificationRepository = $authentificationRepository;
        $this->bankAccountRepository = $bankAccountRepository;
    }

    public function register($request){
        //Recuperer les donnees du Request
        $data = [];
        $data["email"] = $request->email;
        $data["password"] = $request->password;
        $data["last_name"] = $request->last_name;
        $data["first_name"] = $request->first_name;
        $user = $this->authentificationRepository->register($data);

        // Générer un identifiant de compte bancaire unique (8 chiffres)
        $bankAccountId = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);        
        // Créer le compte bancaire associé
        $account = new BankAccount();
        $account->user_id = $user->id;
        $account->balance = 0; // solde initial
        $account->bank_account_id = $bankAccountId; // Assigner l'identifiant
        $this->bankAccountRepository->save($account);
        return $user;
    }

    public function loginAdminUser($request)
    {
        // Récupérer les données d'authentification
        $data = 
        [
            'email' => $request->email,
            'password' => $request->password,
        ];
        // Appel au dépôt pour tenter l'authentification
        $user = $this->authentificationRepository->loginAdminUser($data);   
        // Vérifier si l'utilisateur est authentifié
        if ($user) {
            // Retourner l'utilisateur authentifié
            return $user;
        } else {
            // Si la connexion échoue, retourner une erreur
            return null; // Laissez la gestion de l'erreur au contrôleur
        }
    }
    
}   
