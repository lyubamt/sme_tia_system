<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class RecaptchasFormRequest extends FormRequest
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
            'recaptcha_ID' => 'required',
            'recaptcha_code' => 'required|string|min:1|max:191',
            'session_ID' => 'required',
            'remote_address' => 'required|string|min:1|max:50',
            'forwarded_ip' => 'required|string|min:1|max:50',
            'client_ip' => 'required|string|min:1|max:50',
            'host_name' => 'required|string|min:1|max:191',
            'host_address' => 'required|string|min:1|max:50',
            'request_uri' => 'required|string|min:1|max:50',
            'email' => 'nullable|string|min:0|max:191',
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
        $data = $this->only(['recaptcha_ID', 'recaptcha_code', 'session_ID', 'remote_address', 'forwarded_ip', 'client_ip', 'host_name', 'host_address', 'request_uri', 'email', 'status']);

        $data['status'] = $this->has('status');


        return $data;
    }

}