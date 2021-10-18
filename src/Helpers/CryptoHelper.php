<?php

namespace App\Helpers;

use Merkeleon\PhpCryptocurrencyAddressValidation\Validation;

class CryptoHelper
{

    public $validator;
    private $usdToBtcUrl = "https://blockchain.info/tobtc?currency=USD&value=%s";
    private $btcPaymentQrCodeUrl = "https://www.bitcoinqrcodemaker.com/api/?style=%s&amount=%s&address=%s";
    private $convertEndpoint = "https://min-api.cryptocompare.com/data/price?fsym=USD&tsyms=%s";

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

    public function usdToCrypto($amount, $cryptoCurrency)
    {

        $coin = strtolower($cryptoCurrency);

        if (in_array($coin, ['btc', 'eth', 'doge', 'ltc', 'trx', 'bnb', 'bch'])) {
            $fetch = json_decode(file_get_contents(sprintf($this->convertEndpoint, $coin)), true);

            $amount = $fetch[strtoupper($coin)] * $amount;
        }

        return $amount;
    }

    public function btcPaymentQrCode($amount, $address)
    {
        return sprintf($this->btcPaymentQrCodeUrl, "bitcoin", $amount, $address);
    }
}
