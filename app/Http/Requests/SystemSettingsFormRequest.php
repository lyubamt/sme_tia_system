<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class SystemSettingsFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:100',
            'value' => 'required|string|min:1|max:100',
            'descrption' => 'nullable',
            'status' => 'boolean',
            'position' => 'required|numeric|min:-2147483648|max:2147483647',
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
        $data = $this->only(['name', 'value', 'descrption', 'status', 'position', 'is_deleted']);

        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}