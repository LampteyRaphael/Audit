<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisteredRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //admins registration
            'local_id'=>'required|integer',
            'district_id'=>'required|integer',
            'area_id'=>'required|integer',
            'name'=>'required|string|max:255',
            'gender'=>'required',
            'region_id'=>'required|integer',
            'nationality'=>'required|string|max:255',
            'maritalStatus'=>'required',
//            'email'=>'unique:users',
            'is_active'=>'required',
//            'password'=>'min:6',
            'role_id'=>'required|string',
        ];
    }
}
