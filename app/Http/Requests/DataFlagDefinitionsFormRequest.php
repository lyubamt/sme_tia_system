<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class DataFlagDefinitionsFormRequest extends FormRequest
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
            'data_flag_id' => 'required',
            'data_flag_type_id' => 'required',
            'data_flag_status_id' => 'required',
            'description' => 'nullable',
            'cell_bg_color' => 'required|string|min:1|max:20',
            'text_color' => 'required|string|min:1|max:20',
            'cell_border_color' => 'nullable|string|min:0|max:20',
            'is_system' => 'boolean|nullable',
            'user_id' => 'required',
            'is_active' => 'boolean|nullable',
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
        $data = $this->only(['data_flag_id', 'data_flag_type_id', 'data_flag_status_id', 'description', 'cell_bg_color', 'text_color', 'cell_border_color', 'is_system', 'user_id', 'is_active', 'is_deleted']);

        $data['is_system'] = $this->has('is_system');
        $data['is_active'] = $this->has('is_active');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}