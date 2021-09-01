<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripEditRequest extends FormRequest
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
            'name'=>'required',
            'description'=>'required',
            's_id'=>'required',
            'trip_information'=>'required',
            'days'=>'required|min:1|numeric',
            'start_location'=>'required',
            'why_this_trip'=>'required',
            'transportation'=>'required',
            'is_this_trip_right'=>'required',
            'finish_location'=>'required',
            'physical_rating'=>'required|min:1',
            'ages'=>'required',
            'trip_notes'=>'required',
            'traveldeal'=>'required',
            'featured'=>'required',
            'min_group_size'=>'required|numeric',
            'max_group_size'=>'required|numeric',
            'price'=>'required|numeric',
            'poplularity'=>'required|numeric',
            'hidden_gem'=>'required',
//            'cover_image'=>'required|mimes:jpeg,bmp,png,jpg,gif'
        ];
    }
}
