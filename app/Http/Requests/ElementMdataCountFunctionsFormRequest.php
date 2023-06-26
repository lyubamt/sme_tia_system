<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ElementMdataCountFunctionsFormRequest extends FormRequest
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
            'element_id' => 'required',
            'is_regular' => 'boolean|nullable',
            'mdata_calculation_function_id' => 'required',
            'value_1' => 'required|string|min:1|max:5',
            'value_2' => 'nullable|string|min:0|max:5',
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
        $data = $this->only(['element_id', 'is_regular', 'mdata_calculation_function_id', 'value_1', 'value_2', 'status', 'is_deleted']);

        $data['is_regular'] = $this->has('is_regular');
        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}