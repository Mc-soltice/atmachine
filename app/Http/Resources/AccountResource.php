<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\BankAccount;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
     public function toArray(Request $request): array
     {
         return [
             'user_id' => $this->user_id,
             'first_name' => $this->user->first_name,
             'bank_account_id' => $this->bank_account_id,
             'balance' => $this->balance,
         ];
     
     }
     
}
