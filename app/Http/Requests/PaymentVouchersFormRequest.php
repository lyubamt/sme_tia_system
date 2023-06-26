<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PaymentVouchersFormRequest extends FormRequest
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
            'payee_name' => 'required|string|min:1|max:191',
            'payee_number' => 'required|string|min:1|max:30',
            'payee_address' => 'required|string|min:1|max:191',
            'payment_reason' => 'required',
            'amount' => 'required|string|min:1|max:30',
            'condolence_id' => 'required',
            'transaction_id' => 'required',
            'status' => 'boolean',
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
        $data = $this->only(['payee_name', 'payee_number', 'payee_address', 'payment_reason', 'amount', 'condolence_id', 'transaction_id', 'status', 'user_id']);

        $data['status'] = $this->has('status');


        return $data;
    }

}
