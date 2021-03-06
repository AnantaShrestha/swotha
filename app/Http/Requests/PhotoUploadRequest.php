<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoUploadRequest extends FormRequest
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
        $rules =[];
        $photos = count($this->input('image'));
        foreach(range(0, $photos) as $index) {
            $rules['image.' . $index] = 'image|mimes:jpeg,bmp,png|max:8000';
        }
        return $rules;

    }
}
