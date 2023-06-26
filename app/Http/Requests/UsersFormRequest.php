<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UsersFormRequest extends FormRequest
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
        return [
                'name' => 'required|string|min:1|max:191',
            'organisation_id' => 'nullable',
            'gender' => 'required|string|min:1|max:5',
            'user_type' => 'required|string|min:1|max:32',
            'email' => 'required|string|min:1|max:191',
            'phone' => 'nullable|string|min:0|max:15',
            'fax' => 'nullable|string|min:0|max:15',
            'contract_type' => 'nullable|string|min:0|max:15',
            'email_verified_at' => 'nullable|date_format:j/n/Y g:i A',
            'password' => 'required|string|min:1|max:191',
            'remember_token' => 'nullable|string|min:0|max:100',
        ];
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['name', 'organisation_id', 'gender', 'user_type', 'email', 'phone', 'fax', 'contract_type', 'email_verified_at', 'password', 'remember_token']);



        return $data;
    }

}