<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GithubGistPostRequest extends FormRequest
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

    public function messages()
    {
        return [
            'filename.required' => 'File name is required',
            'g-recaptcha-response.required'  => 'Captcha is required',
        ];
    }
    public function rules()
    {
        return [
            'filename'=>'required|min:3','g-recaptcha-response'=>'required'
        ];
    }
}
