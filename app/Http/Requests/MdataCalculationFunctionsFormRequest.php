<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class MdataCalculationFunctionsFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:20',
            'formula' => 'required|string|min:1|max:191',
            'description' => 'nullable',
            'is_calculation' => 'boolean|nullable',
            'is_count' => 'boolean|numeric',
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
        $data = $this->only(['name', 'formula', 'description', 'is_calculation', 'is_count', 'status', 'is_deleted']);

        $data['is_calculation'] = $this->has('is_calculation');
        $data['is_count'] = $this->has('is_count');
        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}