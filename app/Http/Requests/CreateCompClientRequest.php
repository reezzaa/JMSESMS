<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompClientRequest extends FormRequest
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
            'strCompClientImage' => 'image|mimes:png,jpg,jpeg,gif|max:10000',
            'strCompClientName' => 'required|max:45',
            'strCompClientRepresentative' => 'required|max:100',
            'strCompClientPosition' => 'required|max:50',
            'strCompClientTIN' => 'required',
            'strCompClientContactNo' => 'required|min:11|max:13',
            'strCompClientEmail' => 'required|email|max:45',
            'strCompClientAddress' => 'required|max:100',
            'strCompClientCity' => 'required|max:30',
            'strCompClientProv' => 'required|max:30',
        ];
    }
     public function messages()
    {
        return [
            'strCompClientImage.image' => 'Select Valid Image',
            'strCompClientName.unique' => 'Client Name has already been taken',
            'strCompClientName.required' => 'Client Name field is required',
            'strCompClientName.max' => 'Client Name may not be greater than 40 characters',
            'strCompClientRepresentative.required' => 'Representative Name field is required',
            'strCompClientRepresentative.max' => 'Representative Name may not be greater than 40 characters',
            'strCompClientPosition.required' => 'Position field is required',
            'strCompClientTIN.required' => 'TIN field is required',
            'strCompClientTIN.unique' => 'TIN has already been taken',
            'strCompClientContactNo.required' => 'Contact # field is required',
            'strCompClientEmail.required' => 'Email field is required',
            'strCompClientEmail.unique' => 'Email has already been taken',
            'strCompClientAddress.required' => 'Address field is required',
            'strCompClientAddress.max' => 'Address may not be greater than 40 characters',
            'strCompClientCity.required' => 'City field is required',
            'strCompClientCity.max' => 'City may not be greater than 40 characters',
            'strCompClientProv.required' => 'Province field is required',
            'strCompClientProv.max' => 'Province may not be greater than 40 characters',
        ];
    }
}
