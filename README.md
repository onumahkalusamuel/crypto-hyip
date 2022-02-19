# Crypto HYIP Script (crypto-hyip)

Crypto HYIP Script is a crypto investment script build for **educational purposes.** It shows how to implement Slim4 PHP framework and Smarty Templating Engine. There are two versions of the script. Full Version (main branch) and API-centric version (api-first branch). You can use any frontend technology when using the API-centric version.

## Requirements

1. Apache Server
2. PHP >= 7.3
3. MySQL DB
4. Composer (for installing dependencies)

## Installation

The best way to install this script is by cloning this repository.

```bash
git clone https://github.com/onumahkalusamuel/crypto-hyip.git
```

Then install composer dependencies

```bash
composer install
```

Create a database (in PHPMyAdmin) and import `/db/crypto_hyip.sql`.

Edit `/settings.php` with the right information.

Make a copy of `env.example` to `.env` and update values as necessary. The listed crypto currencies are the ones available on the script. Only fill the ones you want to use and leave the rest blank. For instance, to use only Bitcoin and Ethereum as payment methods, this is how that section should look.

```bash
...
BCH_ADDRESS=
BNB_ADDRESS=
BTC_ADDRESS=your_btc_address
ETH_ADDRESS=your_eth_address
DOGE_ADDRESS=
LTC_ADDRESS=
PM_ADDRESS=
TRX_ADDRESS=
...
```

You can start a local server for testing by running the `serve` script.

```bash
./serve
```

Then visit [http://localhost:8000](http://localhost:8000) to see the landing page.

## Administration

The first account created via the sign up page will be assigned as the admin of your site. The site can only have one admin. The email used will receive all critical notifications.

A link to how the administration panel works can be found ~here~ **coming soon**

## Contribution

The script is far from being completed. Firstly, the payments are all done manually. The admin approves everything by himself. It can be made automatic by adding some crypto payment processors. Themes need to be created. You can create themes to be used, following the one in the example folder at `/tmpl/theme/`.
Therefore, contributions are welcomed. Create an issue with what you want to fix or add.

## Licensing

You are free to use the script for **educational purposes.** If you want to use this script in production, kindly contact me for proper permissions and licensing.
