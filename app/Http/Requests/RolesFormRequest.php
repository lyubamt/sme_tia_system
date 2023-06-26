<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class RolesFormRequest extends FormRequest
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
        return [
          'name' => 'bail|required|string|min:1|max:255',
          'guard_name' => 'required|string|min:1|max:255',
          'permissions'=>'required|min:1',
        ];
        return $rules;
    }

    public function getData()
    {
        $data = $this->only(['name','guard_name','permissions']);

        return $data;
    }
}
