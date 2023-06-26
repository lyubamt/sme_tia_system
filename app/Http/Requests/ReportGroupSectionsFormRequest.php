<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ReportGroupSectionsFormRequest extends FormRequest
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
            'report_group_id' => 'required',
            'name' => 'required|string|min:1|max:191',
            'description' => 'nullable',
            'direction' => 'boolean',
            'placement_order' => 'required|numeric|min:-2147483648|max:2147483647',
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
        $data = $this->only(['report_group_id', 'name', 'description', 'direction', 'placement_order', 'status']);

        $data['direction'] = $this->has('direction');
        $data['status'] = $this->has('status');


        return $data;
    }

}