<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class MediaArchivesFormRequest extends FormRequest
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
            'media_category_id' => 'required',
            'media_type_id' => 'required',
            'file_type_id' => 'required',
            'role' => 'boolean',
            'name' => 'required|string|min:1|max:191',
            'description' => 'nullable',
            'size' => 'nullable|string|min:0|max:5',
            'meta_data' => 'nullable|string|min:0|max:191',
            'user_id' => 'required',
            'parent' => 'required|numeric|min:-2147483648|max:2147483647',
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
        $data = $this->only(['media_category_id', 'media_type_id', 'file_type_id', 'role', 'name', 'description', 'size', 'meta_data', 'user_id', 'parent', 'status', 'is_deleted']);

        $data['role'] = $this->has('role');
        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}