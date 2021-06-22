<?php

namespace App\Helpers;

use App\Helpers\Coinify\CoinifyAPI;
use App\Helpers\Coinify\CoinifyCallback;

class Coinify
{
    private $api_key = "P8Tl0tZldv8lxSMSUKwLRi2PEncy4X2LMUuNcQjV7L5KDFdeudqYIrb7t/48/Fzx";
    private $api_secret = "kSsb7VN6LvC6Nm4zFB4SwbpXwxkWwIoD+RUKXvtX4XLg0qJbMuMalBK8mAkBhNhh";
    private $callback_url = "http://bexfinance.ltd/api/verifybitcoindeposits";
    private $callback_email = "payments@bexfinance.ltd";
    private $input_currency = "BTC";
    public $api;

    public function __construct()
    {
        $this->api = new CoinifyAPI($this->api_key, $this->api_secret);
    }

    public function createInvoice($amount, $reference)
    {
        $currency = 'USD';
        $plugin_name = 'BexFinance LTD';
        $plugin_version = '1';
        $description = "Deposit Invoice";
        $custom = ['payment_reference' => $reference];

        return $this->api->invoiceCreate(
            $amount,
            $currency,
            $plugin_name,
            $plugin_version,
            $description,
            $custom,
            $this->callback_url,
            $this->callback_email,
            $return_url = null,
            $cancel_url = null,
            $this->input_currency,
            $input_return_address = null
        );
    }

    public function invoiceGet($invoice_id)
    {
        return $this->api->invoiceGet($invoice_id);
    }
}
