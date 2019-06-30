<?php
return [
    'ticker' => 'GRW',
    'coinName' => 'Growthcoin',
    'minReward' => 1000000, // in smallest denomination (satoshis)
    'maxReward' => 11000000, // in smallest denomination (satoshis)
    'coinDecimals' => 6,
    'payoutCooldownSeconds' => 60,
    'recaptchaSiteKey' => env( 'RECAPTCHA_SITE_KEY', '' ),
    'recaptchaPrivateKey' => env( 'RECAPTCHA_PRIVATE_KEY', '' ),

];
