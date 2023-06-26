<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class KefFormsFormRequest extends FormRequest
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
            'form_type' => 'required|numeric|min:-2147483648|max:2147483647',
            'headers' => 'required|numeric|min:-2147483648|max:2147483647',
            'columns' => 'required|string|min:1|max:100',
            'columns_selections' => 'required',
            'rows' => 'required|string|min:1|max:100',
            'rows_selections' => 'required',
            'is_deleted' => 'boolean|nullable',
            'user_id' => 'required',
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
        $data = $this->only(['name', 'form_type', 'headers', 'columns', 'columns_selections', 'rows', 'rows_selections', 'is_deleted', 'user_id']);

        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}