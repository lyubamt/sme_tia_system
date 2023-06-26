<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserLoginLogsFormRequest extends FormRequest
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
            'email' => 'required|string|min:1|max:100',
            'http_client_ip' => 'nullable|string|min:0|max:100',
            'http_x_forwarded_for' => 'nullable|string|min:0|max:100',
            'remote_addr' => 'required|string|min:1|max:100',
            'server_name' => 'nullable|string|min:0|max:100',
            'direction' => 'boolean',
            'comment' => 'nullable',
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
        $data = $this->only(['email', 'http_client_ip', 'http_x_forwarded_for', 'remote_addr', 'server_name', 'direction', 'comment', 'status']);

        $data['direction'] = $this->has('direction');
        $data['status'] = $this->has('status');


        return $data;
    }

}