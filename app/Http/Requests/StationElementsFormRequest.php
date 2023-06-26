<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StationElementsFormRequest extends FormRequest
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
            'element_id' => 'required',
            'station_instrument_id' => 'required',
            'instrument_id' => 'nullable',
            'instrument_height' => 'nullable|string|min:0|max:10',
            'from_date' => 'required|string|min:1|max:15',
            'to_date' => 'required|string|min:1|max:15',
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
        $data = $this->only(['station_id', 'element_id', 'station_instrument_id', 'instrument_id', 'instrument_height', 'from_date', 'to_date', 'status', 'is_deleted']);

        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}
