<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StationsFormRequest extends FormRequest
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
            'station_ID' => 'required',
            'icao_ID' => 'required',
            'wmo_ID' => 'required',
            'hydro_ID' => 'required',
            'clicom_ID' => 'required',
            'hist_ID' => 'required',
            'begin' => 'required|string|min:1|max:30',
            'end' => 'required|string|min:1|max:30',
            'name' => 'required|string|min:1|max:25',
            'qual' => 'required|string|min:1|max:25',
            'district_id' => 'required',
            'basin_id' => 'nullable',
            'river_distance' => 'nullable|string|min:1|max:5',
            'full_name' => 'required|string|min:1|max:50',
            'historic_name' => 'nullable',
            'remark' => 'nullable|max:100',
            'longitude' => 'required|string|min:1|max:10',
            'latitude' => 'required|string|min:1|max:10',
            'elevation' => 'required|string|min:1|max:5',
            'time_deviation' => 'required|string|min:1|max:5',
            'reference_station_id' => 'nullable',
            'station_type_id' => 'required',
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
        $data = $this->only(['station_ID', 'icao_ID', 'wmo_ID', 'hydro_ID', 'clicom_ID', 'hist_ID', 'begin', 'end', 'name', 'qual', 'district_id', 'basin_id', 'river_distance', 'full_name', 'historic_name', 'remark', 'longitude', 'latitude', 'elevation', 'time_deviation', 'reference_station_id', 'station_type_id', 'status', 'is_deleted']);

        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}
