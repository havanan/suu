<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:5|max:190|unique:products',
            'slug' => 'unique:products',
            'price_import' => 'required|min:0|numeric',
            'price' => 'required|min:0|numeric',
            'images' => 'required|array',
            'category_id' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Trường này không được để trống',
            'slug.unique' => 'Seo Url đã tồn tại, vui lòng nhập đường dẫn khác',
            'numeric' => 'Trường này phải là dạng chữ số',
            'min' => 'Trường này phải lớn hơn :min',
            'images.array' => 'Ảnh không được để trống'
        ];
    }

    protected function failedValidation(Validator $validator) {
        $errors = $validator->errors()->messages();
        $messages = [];
        if (!empty($errors)){
            foreach ($errors as $key => $error) {
                if (isset($error[0])){
                    $messages[$key] = $error[0];
                }
            }
        }
        throw new HttpResponseException(response()->json([
            'errors' => $messages,
            'status' => false
        ], 422));
    }
}
