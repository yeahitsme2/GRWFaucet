<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAddress implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $result = bitcoind()->validateaddress($value)->get();
        return $result['isvalid'];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The address is not valid.';
    }
}
