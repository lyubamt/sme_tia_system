<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class DeliverySubcriptionsFormRequest extends FormRequest
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
            'delivery_subcription_cost_id' => 'required',
            'user_id' => 'required',
            'expiry_date' => 'required|string|min:1|max:15',
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
        $data = $this->only(['delivery_subcription_cost_id', 'user_id', 'expiry_date', 'status']);

        $data['status'] = $this->has('status');


        return $data;
    }

}