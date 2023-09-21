<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category_id=$this->route('category');
        return [
            'name'=>"required|string|min:3|max:255|unique:categories,name,$category_id",
            'image'=>'image|mimes:jpeg,png,jpg,gif',
            'parent_id'=>[
                'nullable','integer','exists:categories,id'
            ],
            'description'=>"string",
            'status'=>"in:active,archived"
        ];
    }
}
