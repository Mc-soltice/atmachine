<?php

namespace App\Http\Controllers;

use App\Http\Service\AccountService; 
use App\Http\Resources\AccountResource;

class BankAccountsController extends Controller

{
    protected $accountService;
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }
    public function getAccounts()
    {
        $account= $this->accountService->getAllAccounts();
        return AccountResource::collection($account);
    }


}
