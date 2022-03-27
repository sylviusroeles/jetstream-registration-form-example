<?php

namespace App\Rules;

use App\Services\PostCodeApi;
use Cache;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Validation\Rule;

class ValidPostalCode implements Rule
{
    /**
     * @var PostCodeApi
     */
    public PostCodeApi $postCodeApi;
    /**
     * @var string
     */
    public string $houseNumber;

    /**
     * Create a new rule instance.
     *
     * @param string $houseNumber
     */
    public function __construct(string $houseNumber)
    {
        $this->postCodeApi = app(PostCodeApi::class);
        $this->houseNumber = $houseNumber;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $postalCode
     * @return bool
     * @throws GuzzleException
     */
    public function passes($attribute, $postalCode): bool
    {
        if($this->postCodeApi->getAddress($postalCode, $this->houseNumber)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.postalCodeInvalid');
    }
}
