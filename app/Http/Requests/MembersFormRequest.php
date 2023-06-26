<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class MembersFormRequest extends FormRequest
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
            'first_name' => 'required|string|min:1|max:191',
            'middle_name' => 'nullable|string|min:0|max:191',
            'last_name' => 'required|string|min:1|max:191',
            'gender' => 'required|string|min:1|max:2',
            'phone' => 'required|string|min:1|max:20',
            'check_no' => 'required|numeric|min:-2147483648|max:2147483647',
            'dept' => 'required|string|min:1|max:10',
            'vote' => 'required|string|min:1|max:3',
            'membership_no' => 'required|numeric|min:-2147483648|max:2147483647',
            'reg_date' => 'required|string|min:10|max:10',
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
        $data = $this->only(['first_name', 'middle_name', 'last_name', 'gender', 'phone', 'check_no', 'dept', 'vote', 'membership_no', 'reg_date', 'status']);

        $data['status'] = $this->has('status');


        return $data;
    }

}
