<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class offerrequest extends FormRequest
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
                'phone'         => 'required|min:11|numeric',
                'title_offer'   => 'required|min:3|max:255',
                'buyorsell'     => 'required',
                'lat'           => 'required',
                'lng'           => 'required',
                'description'   => 'required|min:3',
                'address'       => 'required|min:3',
                'image1'        => 'mimes:jpeg,jpg,png|required|max:10000',
            ];
        }else {
            return [
                'phone'         => 'required|min:11|numeric',
                'title_offer'   => 'required|min:3|max:255',
                'buyorsell'     => 'required',
                'lat'           => 'required',
                'lng'           => 'required',
                'description'   => 'required|min:3',
                'address'       => 'required|min:3',
                'image1'        => 'mimes:jpeg,jpg,png|required|max:10000',
            ];
        }
    }
}
