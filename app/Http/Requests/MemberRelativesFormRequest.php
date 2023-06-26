<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class MemberRelativesFormRequest extends FormRequest
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
            'member_id' => 'nullable',
            'first_name' => 'required|string|min:1|max:100',
            'middle_name' => 'required|string|min:1|max:100',
            'last_name' => 'required|string|min:1|max:100',
            'relationship_id' => 'required',
            'phone' => 'nullable|string|min:0|max:20',
            'address' => 'nullable',
            'role' => 'boolean',
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
        $data = $this->only(['member_id', 'first_name', 'middle_name', 'last_name', 'relationship_id', 'phone', 'address', 'role', 'status']);

        $data['role'] = $this->has('role');
        $data['status'] = $this->has('status');


        return $data;
    }

}
