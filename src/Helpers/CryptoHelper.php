<?php

namespace App\Helpers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class CryptoHelper
{

    public $validator;
    private $usdToBtcUrl = "https://blockchain.info/tobtc?currency=USD&value=%s";
    private $btcPaymentQrCodeUrl = "https://www.bitcoinqrcodemaker.com/api/?style=%s&amount=%s&address=%s";

    public function __construct()
    {
    }
    public function validate(string $currency, string $address): bool
    {
        return (bool) Validation::make($currency)->validate($address);
    }

    public function usdToBtc($usd)
    {
        $btc = 0;
        try {
            $btc = file_get_contents(sprintf($this->usdToBtcUrl, $usd));
        } catch (\Exception $e) {
        }
        return $btc;
    }

    public function btcPaymentQrCode($amount, $address)
    {
        return sprintf($this->btcPaymentQrCodeUrl, "bitcoin", $amount, $address);
    }
}
