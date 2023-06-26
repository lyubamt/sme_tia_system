<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ElementImportLimitsFormRequest extends FormRequest
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
            'from_elevation' => 'required|string|min:1|max:10',
            'to_elevation' => 'required|string|min:1|max:10',
            'month_id' => 'required',
            'is_max' => 'boolean|nullable',
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
        $data = $this->only(['element_id', 'from_elevation', 'to_elevation', 'month_id', 'is_max', 'status', 'is_deleted']);

        $data['is_max'] = $this->has('is_max');
        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}