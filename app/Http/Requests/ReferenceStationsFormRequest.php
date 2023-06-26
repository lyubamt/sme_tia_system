<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ReferenceStationsFormRequest extends FormRequest
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
            'station_id' => 'required',
            'station_reference_purpose_id' => 'required',
            'station_reference_use_id' => 'required',
            'seq_no' => 'required|string|min:1|max:20',
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
        $data = $this->only(['station_id', 'station_reference_purpose_id', 'station_reference_use_id', 'seq_no', 'status', 'is_deleted']);

        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}