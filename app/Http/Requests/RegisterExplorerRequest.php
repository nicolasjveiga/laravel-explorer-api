<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterExplorerRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:explorers',
            'password'  => 'required|string|min:8',
            'age'       => 'required|integer|min:0',
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ];
    }
}
