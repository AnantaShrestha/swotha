<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripChangeImageRequest extends FormRequest
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
            'cover_image'=>'required|mimes:jpeg,bmp,png,gif,jpg|max:32000',
            

        ];
    }
}
