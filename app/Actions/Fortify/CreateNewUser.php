<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\ValidInitial;
use App\Rules\ValidPostalCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $validated = Validator::make($input, [

            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'initial' => ['required', 'string', new ValidInitial($input['first_name'] ?? null)],

            'zip_code' => ['required', new ValidPostalCode($input['house_number'] ?? null)],
            'house_number' => ['required'],

            'phone_number' => ['required', Rule::phone()->country(['NL', 'DE'])],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create($validated);
    }
}
