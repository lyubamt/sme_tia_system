<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ItemsFormRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:20',
            'description' => 'nullable',
            'is_asset' => 'boolean|nullable',
            'is_liability' => 'boolean|nullable',
            'is_capital' => 'boolean|nullable',
            'is_purchase' => 'boolean|nullable',
            'is_sale' => 'boolean|nullable',
            'is_expense' => 'boolean|nullable',
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
        $data = $this->only(['name', 'description', 'is_asset', 'is_liability', 'is_capital', 'is_purchase', 'is_sale', 'is_expense', 'status', 'is_deleted']);

        $data['is_asset'] = $this->has('is_asset');
        $data['is_liability'] = $this->has('is_liability');
        $data['is_capital'] = $this->has('is_capital');
        $data['is_purchase'] = $this->has('is_purchase');
        $data['is_sale'] = $this->has('is_sale');
        $data['is_expense'] = $this->has('is_expense');
        $data['status'] = $this->has('status');
        $data['is_deleted'] = $this->has('is_deleted');


        return $data;
    }

}
