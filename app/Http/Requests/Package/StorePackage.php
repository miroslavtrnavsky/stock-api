<?php

namespace Http\Requests\Package;

use App\Enums\PackageStateEnum;
use http\Client\Curl\User;
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
//        Gate::authorize('package.create') //TODO
        return true;
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