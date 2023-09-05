<?php

namespace App\Http\Requests;

use App\Rules\ValidateTagsRule;
use App\Rules\ValidateWithRule;
use Illuminate\Foundation\Http\FormRequest;

class FoodFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'per_page' => ['sometimes','numeric','min:1','max:10'],
            'tags' => ['sometimes',new ValidateTagsRule()],
            'category' => ['sometimes'],
            'diff_time' => ['sometimes','numeric','min:0'],
            'page' => ['sometimes','numeric','min:1'],
            'with' => ['sometimes',new ValidateWithRule()],
        ];
        
    }
}
