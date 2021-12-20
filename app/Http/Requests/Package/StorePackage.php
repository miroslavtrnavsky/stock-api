<?php

namespace Http\Requests\Package;

use App\Enums\PackageStateEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;

class StorePackage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('package.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'stock_id' => ['required', 'numeric', 'exists:stocks,id'],
            'code' => ['required', 'numeric', 'unique:packages'],
            'position' => ['required', 'string'],
            'state' => ['required', new Enum(PackageStateEnum::class)]
        ];
    }
}