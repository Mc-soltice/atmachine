<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     public function toArray(Request $request): array
     {
         return [
             'id' => $this->id,
             'bank_account_id' => $this->bankAccount->id,
             'type'=> $this->type,
             'amount'=> $this->amount,
             'balance' => $this->bankAccount->balance,
         ];
     
     }
}
