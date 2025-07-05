<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTradeRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'from_explorer_id' => 'required|exists:explorers,id',
            'to_explorer_id' => 'required|exists:explorers,id|different:from_explorer_id',
            'sent_items' => 'required|array|min:1',
            'sent_items.*' => 'required|exists:items,id',
            'received_items' => 'required|array|min:1',
            'received_items.*' => 'required|exists:items,id',
        ];
    }
}
