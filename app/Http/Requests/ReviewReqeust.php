<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewReqeust extends FormRequest
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
            'name' => 'required',
            'title' => 'required',
            'email' => 'required|email',
            'review' => 'required',
            'exp' => 'required',
            'staff' => 'required',
            'value' => 'required',
            'meal' => 'required',
            'accomodation' => 'required',
            'transportation' => 'required',
            'guide' => 'required',
            'custom_name' => 'required',
        ];
    }
}
