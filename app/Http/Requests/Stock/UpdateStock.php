<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateStock extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        return Gate::allows('stock.update');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        \Log::info($this->all());
        return [
            'name' => ['sometimes', 'required', 'string'],
            'street' => ['sometimes', 'required', 'string'],
            'street_no' => ['sometimes', 'required', 'string'],
            'zip' => ['sometimes', 'required', 'string'],
            'city' => ['sometimes', 'required', 'string'],
            'type' => ['sometimes', 'required', 'string']
        ];
    }
}