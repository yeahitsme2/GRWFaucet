<?php

namespace App\Http\Controllers;

use App\Address;
use App\Rules\CoolDown;
use App\Rules\ValidAddress;
use App\Rules\ValidRecaptcha;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function ask(Request $request)
    {

        $validatedData = $request->validate([
            'grwaddress' => ['required', new ValidAddress, new CoolDown],
            'g-recaptcha-response' => [new ValidRecaptcha]
        ]);

        // Prevent abuse from same IP
        $ip = Address::where(['ip' => $request->ip() ] )->first();
        if( ! is_null($ip) )
        {
            if( $ip->updated_at->addSeconds(config('faucet.payoutCooldownSeconds')) > \Carbon\Carbon::now() )
            {
                return back()->with('error', "Hey Captain, hold on for a minute, you just claimed some ". config('faucet.ticker')."!<br />To be fair, you can ask only once every " . \Carbon\CarbonInterval::seconds(config('faucet.payoutCooldownSeconds'))->cascade()->forHumans());
            }
        }

        $amount = (rand(config('faucet.minReward'), config('faucet.maxReward'))) / pow(10, config('faucet.coinDecimals'));

        $address = Address::FirstOrNew(['address' => $request->grwaddress]);

        if( is_null(bitcoind()->sendtoaddress( $request->grwaddress, $amount )['error']) )
        {
            $address->count += 1;
            $address->amount += $amount;
            $address->ip = $request->ip();
            $address->save();
            return back()->with('success', 'Sent '.$amount.' ' . config('faucet.ticker') . ' to <strong>'. $request->grwaddress .'</strong>' );
        } else {
            return back()->with('error', 'Something went wrong, please try again in a few minutes.');
        }

    }
}
