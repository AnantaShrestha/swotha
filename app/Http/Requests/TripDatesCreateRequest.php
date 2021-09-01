<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripDatesCreateRequest extends FormRequest
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
            'trip_id'=>'required|numeric',
            'start_date'=>'required|date',
            'price'=>'required|numeric'
        ];
    }
}
