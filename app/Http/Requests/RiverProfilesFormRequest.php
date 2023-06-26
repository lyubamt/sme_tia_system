<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class RiverProfilesFormRequest extends FormRequest
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
            'river_id' => 'required',
            'distance' => 'required|string|min:1|max:5',
            'height' => 'required|string|min:1|max:5',
            'description' => 'nullable',
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
        $data = $this->only(['river_id', 'distance', 'height', 'description', 'status', 'is_deleted']);

        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}