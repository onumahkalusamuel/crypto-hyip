<?php

// Error reporting for production
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Europe/Berlin');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['upload_dir'] = $settings['public'] . '/uploads';
$settings['view']['path'] = __DIR__ . '/../templates/default/';

// Error Handling Middleware settings
$settings['error'] = [
    // Should be set to false in production
    'display_error_details' => true,
    'log_errors' => true,
    'log_error_details' => true,
];

// database connection
if ($myhost !== 'localhost') {
    $database = '';
    $username = '';
    $password = 'iLoveAfrica@1';
} else {
    $database = 'btc';
    $username = 'root';
    $password = '';
}

// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'username' => $username,
    'database' => $database,
    'password' => $password,
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'options' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];

//jwt
$settings['jwt_key'] = "emmaNUEL";


$settings['mail'] = [
    'email' => 'admin@site',
    'password' => 'l',
    'name' => 'Admin'
];

$primary_menu = ['about-us', 'investment-plans', 'faqs', 'contact-us'];
$secondary_menu = ['login', 'register', 'about-us', 'terms', 'latest-news', 'contact-us'];
$external_menu = [
    ['title' => 'Bitcoin News', 'url' => 'https://news.bitcoin.com'],
    ['title' => 'Coinbase Wallet', 'url' => 'https://wallet.coinbase.com'],
    ['title' => 'Paxful', 'url' => 'https://paxful.com'],
    ['title' => 'CoinBureau', 'url' => 'https://www.coinbureau.com/'],
    ['title' => 'Coin Gecko', 'url' => 'https://www.coingecko.com/en'],
];

$faqs = [
    [
        'question' => 'How high is my risk? ',
        'answer' => 'We use unique algorithms and a conservative trading strategy to greatly minimize the risk to our users. In the worst-case scenario, trading can be immediately halted at any time by stopping the software.'
    ],
    [
        'question' => 'Who controls the Investment portfolio?  ',
        'answer' => 'The investment portfolio is managed by a team of experienced financial specialists, experienced/professional financial experts and traders who possess considerable expertise in all aspects of investment and trading including: risk management, investment technology, and trading regulations.'
    ],
    [
        'question' => 'How do I get started? ',
        'answer' => "Simply click one of the <strong>Get Started Now!</strong> buttons on this page and register for FREE! Once you're registered, we'll take you to your dashboard and walk you through the quick steps of getting your account ready!"
    ],
    [
        'question' => 'How do I put money in or take money out of my account? ',
        'answer' => 'You can make withdrawals every 24hrs. Deposits and disbursement of possibly earned profits can be done via a Bitcoin transfer.'
    ],
    [
        'question' => 'What tax am I subjected to? ',
        'answer' => 'BitRiveTrading Inc does not give tax advice. Please consult your tax or legal advisor.'
    ],
    [
        'question' => 'How can I withdraw my funds? ',
        'answer' => 'By simply clicking the withdrawal link on your account dashboard. You then specify the amount you want to withdraw which must not be more than your earnings'
    ],
    [
        'question' => 'Do I need to make a deposit to refer new members? ',
        'answer' => 'Yes, you need to have an active investment to take part in our referral program.'
    ],
    [
        'question' => 'How safe is it to use the company website while making investments? ',
        'answer' => 'The company provides its investors with a website equipped with the latest and most effective means of data protection, antivirus software, EV SSL encryption protocol, protection from DDoS attacks, and located the website on powerful and reliable servers.'
    ],
    [
        'question' => 'What are the objectives of BitRiveTrading Inc? ',
        'answer' => "To help unsuccessful traders recoup losses and become successful in forex trading, to assist low income earners offset bills and reduce multiple work load by providing a side earning venture from the forex market, to help retire annually over 2 million individuals across the 5 continents we've installed our structure already."
    ],
    [
        'question' => "What's the long-term goal of BitRiveTrading Inc?",
        'answer' => 'BitRiveTrading Inc has made available a provision for investors to alter their respective Bitcoin wallet addresses on the fly. This can only be done 2 times in a month.'
    ],

    [
        'question' => 'Is there any form of security covering investors funds? ',
        'answer' => 'Yes, there is. Investors with over $20,000 stakes get BitRiveTrading Inc insurance cover documents.'
    ],


    [
        'question' => 'Is BitRiveTrading Inc regulated? ',
        'answer' => 'Yes, BitRiveTrading Inc is franchised by AAA Trade Limited,which is directly under the regulations of European Security and Markets Authority (ESMA) under the jurisdiction of the European Union with head office in Paris, France. For more information on our licensing, please contact support, live chat, or any of our online agents.'
    ],


    [
        'question' => "What's your achievement overview since BitRiveTrading Inc went public in 2017? ",
        'answer' => 'It has come to our notice that some envious and unsuccessful platforms that failed to keep it real with their investors have decided to adopt the negative review measure to promote their platforms by paying bloggers to give false review about us. We advise you not to look elsewhere as BitRiveTrading Inc has got a great future than we see today.'
    ],
    [
        'question' => 'Can I Change My Bitcoin Address? ',
        'answer' => 'BitRiveTrading Inc has made available a provision for investors to alter their respective Bitcoin wallet addresses on the fly. This can only be done 2 times in a month.'
    ],
    [
        'question' => 'Where do you see BitRiveTrading Inc in coming years? ',
        'answer' => "We've got SPRICOIN in view, with the potential of coming first in the coin market and generally accepted by most business ventures as an online medium of payment. It's a great opportunity for you to be part of this project; if you are, then you are a potential millionaire, that's if you aren't one already. BitRiveTrading Inc platform you see today is one big tool we are using to install our great structure across the globe."
    ],

];

$settings['display_settings'] = [
    'about_youtube_video_link'=> 'https://www.youtube.com/watch?v=F3QpgXBtDeo',
    'site_name' => 'BitRiveTrading Inc',
    'site_description' => 'BitRiveTrading Inc stands firmly in support of financial freedom and the liberty that Bitcoin provides globally for anyone to voluntarily participate in a permissionless and decentralized network.', // to appear at the footer
    'contact_email' => 'admin@bitrivetrading.com',
    'contact_phone' => '+1 (412) 343 566 90',
    'whatsapp_number' => '+1 (412) 343 566 90',
    'contact_address' => '203, Behind Alis Street, MB, Australia.',
    'company_about' => 'BitRiveTrading Inc was founded in 2017 as a UK based fund management company regulated by the European Security and Markets Authority (ESMA) under the jurisdiction of the European Union with head office in Paris, France.',
    'company_mission' => 'We are a trading and investment management company aimed at providing clients the best possible services in today’s markets. Now, almost three years later, BitRiveTrading Inc options can proudly say it has achieved this goal.',
    'company_vision' => 'BitRiveTrading Inc is committed to give an opportunity to as many traders as possible to invest their money in crypto currency trading. Our main task is to simplify both the trading and the process of getting a profit.',
    'primary_menu' => $primary_menu,
    'secondary_menu' => $secondary_menu,
    'external_menu' => $external_menu,
    'faqs' => $faqs
];

return $settings;
