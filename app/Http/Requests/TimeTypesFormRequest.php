<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class TimeTypesFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:191',
            'abbreviation' => 'required|string|min:1|max:10',
            'description' => 'nullable',
            'time_distance' => 'required|string|min:1|max:3',
            'time_zone_id' => 'required',
            'is_local' => 'boolean|nullable',
            'is_server' => 'boolean|nullable',
            'is_default' => 'boolean|nullable',
            'status' => 'boolean',
            'is_deleted' => 'boolean|nullable',
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
        $data = $this->only(['name', 'abbreviation', 'description', 'time_distance', 'time_zone_id', 'is_local', 'is_server', 'is_default', 'status', 'is_deleted']);

        $data['is_local'] = $this->has('is_local');
        $data['is_server'] = $this->has('is_server');
        $data['is_default'] = $this->has('is_default');
        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}