<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ElementsFormRequest extends FormRequest
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
            'element_ID' => 'required',
            'name' => 'required|string|min:1|max:15',
            'description' => 'required|string|min:1|max:35',
            'unit_id' => 'required',
            'scale_id' => 'required',
            'calculation_scale_id' => 'required',
            'lower_limit' => 'required|string|min:1|max:5',
            'upper_limit' => 'required|string|min:1|max:5',
            'lower_limit_kef' => 'nullable|string|min:0|max:5',
            'upper_limit_kef' => 'nullable|string|min:0|max:5',
            'is_sparse' => 'boolean|nullable',
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
        $data = $this->only(['element_ID', 'name', 'description', 'unit_id', 'scale_id', 'calculation_scale_id', 'lower_limit', 'upper_limit', 'lower_limit_kef', 'upper_limit_kef', 'is_sparse', 'status', 'is_deleted']);

        $data['is_sparse'] = $this->has('is_sparse');
        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}