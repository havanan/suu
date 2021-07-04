<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
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
            'file' => 'required|max:5012|mimes:jpeg,jpg,png'//max 5mb upload
        ];
    }
    public function messages()
    {
        return [
                'file.required' => 'File upload không được để trống',
                'file.max' => 'File upload không được vượt quá 5Mb',
                'file.mimes' => 'File upload phải là định dạng :mimes',

        ];
    }
}
