<?php 

namespace App\Helpers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class BTCValidate {

    public $validator;

    public function __construct() {
        $this->validator = Validation::make('BTC');
    }

    public function validate(string $btc):bool {
        return (bool) $this->validator->validate($btc);
    }
}