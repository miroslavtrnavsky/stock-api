<?php

namespace Http\Requests\Package;

use App\Enums\PackageStateEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;

class UpdatePackage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        return Gate::allows('package.update');        //TODO
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
            'stock_id' => ['sometimes', 'required', 'numeric', 'exists:stocks,id'],
            'code' => ['sometimes', 'required', 'numeric', 'unique:packages'],
            'position' => ['sometimes', 'required', 'string'],
            'state' => ['sometimes', 'required', new Enum(PackageStateEnum::class)]
        ];
    }
}