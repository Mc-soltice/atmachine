<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'amount' => 'required|numeric|min:0.01',
            'type' => 'required|in:deposit,withdrawal,transfer',
        ];
            // Si le type est 'transfer', on ajoute la validation pour le compte de destination
            if ($this->input('type') === 'transfer') {
                $rules['to_account_id'] = 'required|exists:bank_accounts,id'; // Validation du compte de destination
            }

            return $rules;
    }
    
}
