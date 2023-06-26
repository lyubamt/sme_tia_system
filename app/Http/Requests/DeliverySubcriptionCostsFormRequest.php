<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class DeliverySubcriptionCostsFormRequest extends FormRequest
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
            'product_subscription_duration_id' => 'required',
            'currency_id' => 'required',
            'amount' => 'required|string|min:1|max:10',
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
        $data = $this->only(['product_subscription_duration_id', 'currency_id', 'amount', 'status']);

        $data['status'] = $this->has('status');


        return $data;
    }

}