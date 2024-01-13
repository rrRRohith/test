<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request as httpRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest{

    public function __construct(ValidationFactory $validationFactory)
    {     
        $validationFactory->extend(
            'verify',
            function($attribute, $value, $parameters){
                $user = User::where('email', $this->email)->first();
                return (!isset($user->id) || Hash::check($value, $user->password)) ? true : false;
            },
            'Entered password is invalid.'
        );
    }
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
     * Throw custom failed validation error.
     *
     * @return Illuminate\Http\Exceptions\HttpResponseException
     */
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => __('Validation errors'),
            'data'      => $validator->errors()
        ], 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'bail|required|email|exists:users,email',
            'password' => 'bail|required|string|verify'
        ];
    }
}
