<?php

namespace App\Http\Requests\ProductCategory;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
                'name' => 'required|min:5|max:190|unique:stock,name,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
                'required' => 'Trường này không được để trống',
                'max' => 'Trường này không được nhập quá :max kí tự',
                'name.unique' => 'Tên đã tồn tại, vui lòng chọn tên khác'
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
