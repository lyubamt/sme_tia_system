<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StationInstrumentsFormRequest extends FormRequest
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
            'instrument_id' => 'required',
            'name' => 'required|string|min:1|max:100',
            'description' => 'nullable',
            'producer' => 'nullable|string|min:0|max:191',
            'instrument_type_id' => 'required',
            'from_date' => 'required|string|min:1|max:15',
            'to_date' => 'required|string|min:1|max:15',
            'valid_to_date' => 'nullable|string|min:0|max:15',
            'instrument_no' => 'nullable|string|min:0|max:20',
            'inventory_no' => 'nullable|string|min:0|max:20',
            'met_reg_no' => 'nullable|string|min:0|max:20',
            'attachment' => 'nullable|string|min:0|max:191',
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
        $data = $this->only(['station_id', 'instrument_id', 'name', 'description', 'producer', 'instrument_type_id', 'from_date', 'to_date', 'valid_to_date', 'instrument_no', 'inventory_no', 'met_reg_no', 'attachment', 'status', 'is_deleted']);

        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}