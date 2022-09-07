<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class supplierrequest extends FormRequest
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
        if($this->method() == 'POST') {
            return [
                'title' => 'required|max:250',
                'manager' => 'required|max:250',
                'image1'        => 'mimes:jpeg,jpg,png|required|max:10000',

            ];
        }else {
            return [
                'title' => 'required|max:250',

            ];
        }
    }
}
