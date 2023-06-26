<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class TransactionsFormRequest extends FormRequest
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
            'item_id' => 'required',
            'day' => 'required|numeric|min:-2147483648|max:2147483647',
            'month' => 'required|string|min:1|max:2',
            'year' => 'required|string|min:1|max:4',
            'bank_account_id' => 'required|numeric|min:0|max:4294967295',
            'amount' => 'required|string|min:1|max:10',
            'description' => 'nullable',
            'direction' => 'boolean',
            'receipt_no' => 'nullable',
            'name' => 'nullable',
            'phone' => 'nullable',
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
        $data = $this->only(['item_id', 'day', 'month', 'year', 'bank_account_id', 'amount', 'description', 'direction', 'receipt_no', 'name', 'phone', 'status', 'user_id']);

        $data['direction'] = $this->has('direction');
        $data['status'] = $this->has('status');


        return $data;
    }

}
