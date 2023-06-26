<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class BasinsFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:191',
            'description' => 'nullable',
            'hydro_DTB' => 'required|numeric|min:-2147483648|max:2147483647',
            'CHP_ID' => 'nullable',
            'basin_area' => 'required|string|min:1|max:5',
            'basin_area_percentage' => 'nullable|string|min:0|max:5',
            'river_id' => 'required',
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
        $data = $this->only(['name', 'description', 'hydro_DTB', 'CHP_ID', 'basin_area', 'basin_area_percentage', 'river_id', 'status', 'is_deleted']);

        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}
