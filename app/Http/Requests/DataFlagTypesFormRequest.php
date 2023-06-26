<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class DataFlagTypesFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:50',
            'description' => 'nullable',
            'status' => 'boolean',
            'user_id' => 'required',
            'is_active' => 'boolean|nullable',
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
        $data = $this->only(['name', 'description', 'status', 'user_id', 'is_active', 'is_deleted']);

        $data['status'] = $this->has('status');
        $data['is_active'] = $this->has('is_active');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}
