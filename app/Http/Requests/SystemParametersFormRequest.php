<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SystemParametersFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'long_left' => 'required|string|min:1|max:30',
            'long_left_direction' => 'required|string|min:1|max:5',
            'long_right' => 'required|string|min:1|max:30',
            'long_right_direction' => 'required|string|min:1|max:5',
            'lat_up' => 'required|string|min:1|max:30',
            'lat_up_direction' => 'required|string|min:1|max:5',
            'lat_down' => 'required|string|min:1|max:30',
            'lat_down_direction' => 'required|string|min:1|max:5',
            'min_elevation' => 'required|string|min:1|max:10',
            'max_elevation' => 'required|string|min:1|max:10',
            'country_id' => 'required|numeric|min:0|max:4294967295',
            'time_type_id' => 'required',
            'e_data_id' => 'required',
            'n_data_id' => 'required',
            'wind_data_id' => 'required',
            'status' => 'boolean',
            'is_deleted' => 'required|array|numeric|min:-2147483648|max:2147483647',
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['long_left', 'long_left_direction', 'long_right', 'long_right_direction', 'lat_up', 'lat_up_direction', 'lat_down', 'lat_down_direction', 'min_elevation', 'max_elevation', 'country_id', 'time_type_id', 'e_data_id', 'n_data_id', 'wind_data_id', 'status', 'is_deleted']);

        $data['status'] = $this->has('status');


        return $data;
    }

}