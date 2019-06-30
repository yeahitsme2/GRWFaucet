<?php

namespace App\Rules;

use App\Address;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class CoolDown implements Rule
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
        $address = Address::where('address', $value)->first();

        // If address doesn't exist, return true;
        if( is_null($address) )
            return true;

        // returns TRUE when cooldown period has passed
        return $address->updated_at->addSeconds(config('faucet.payoutCooldownSeconds')) < Carbon::now();



    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Hey Captain, hold on for a minute, your asking too much too quick!<br />You can ask once every " . \Carbon\CarbonInterval::seconds(config('faucet.payoutCooldownSeconds'))->cascade()->forHumans();
    }
}
