<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckCompanySettings extends FormRequest
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
            'name'          
            => 'required|max:255|unique:companies'
            'email'         
            =>  'required|max:255|unique:companies'
            'phone'         
            =>  'required|max:255|unique:companies'
        ];
    }

    public function messages()
    {
    return [
            'name.required|unique.companies'          
                =>  'Şirket adı kayıtlı farklı ad giriniz!',

            'email.required|unique.companies'         
                =>  'Email kayıtlı farklı email giriniz!',

            'phone.required|unique.companies'         
                =>  'Telefen kayıtlı farklı telefon numarası girinizé!',

            'cargo_letter.required|unique.companies'  
                =>  'Kargo baş harfları kayıtlı farklı harf giriniz!'
        ];
    }
}
