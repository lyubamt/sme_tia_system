<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ReportGroupOperationsFormRequest extends FormRequest
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
            'first_operand' => 'required|numeric|min:-2147483648|max:2147483647',
            'operator' => 'boolean',
            'second_operand' => 'required|numeric|min:-2147483648|max:2147483647',
            'status' => 'boolean',
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
        $data = $this->only(['first_operand', 'operator', 'second_operand', 'status']);

        $data['operator'] = $this->has('operator');
        $data['status'] = $this->has('status');


        return $data;
    }

}