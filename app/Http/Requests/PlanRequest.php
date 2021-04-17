<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'barbers_count' => 'required|numeric|min:0',
            'prepayment' => 'required|boolean',
        ];
    }
}
