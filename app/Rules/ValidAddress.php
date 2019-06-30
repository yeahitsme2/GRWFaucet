<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAddress implements Rule
{

    /**
     * Holds the error message depening on context.
     * Initialized with default message.
     *
     * @var string
     */
    protected $message = 'The address is not valid.';

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
        try {
            $result = bitcoind()->validateaddress($value)->get();
            return $result['isvalid'];

        } catch( \Exception $e )
        {
            // set message for this context
            $this->message = 'Cannot verify address.';
            return false;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
