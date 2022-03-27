<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidInitial implements Rule
{

    /**
     * @var string
     */
    public string $firstName;

    /**
     * @param string $firstName
     */
    public function __construct(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strtolower(substr($this->firstName, 0,1)) === strtolower($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.initialInvalid');
    }
}
