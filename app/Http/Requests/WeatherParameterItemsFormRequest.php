<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class WeatherParameterItemsFormRequest extends FormRequest
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
            'weather_parameter_id' => 'nullable',
            'name' => 'nullable|string|min:0|max:200',
            'name_sw'=> 'nullable|string|min:0|max:200',
            'description' => 'nullable|string|min:0|max:300',
            'attachment' => 'nullable',
            'code'=> 'nullable|string|min:0|max:10'
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
        $data = $this->only(['weather_parameter_id', 'name','name_sw', 'description', 'attachment','code']);



        return $data;
    }

}
