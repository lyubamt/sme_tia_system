<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class HelpsFormRequest extends FormRequest
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
            'help_category_id' => 'required',
            'name' => 'required|string|min:1|max:191',
            'title' => 'required|string|min:1|max:191',
            'sub_title' => 'required|string|min:1|max:191',
            'content' => 'required',
            'uid' => 'required|string|min:1|max:191',
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
        $data = $this->only(['help_category_id', 'name', 'title', 'sub_title', 'content', 'uid', 'status']);

        $data['status'] = $this->has('status');


        return $data;
    }

}