<?php

/**
 * Use this file to define all the general and display settings.
 */

$settings = [];
// basic info

// The name of the website
$settings['site_name'] = 'BitriveTrading Inc';

// contact email
$settings['contact_email'] = 'admin@bitrivetrading.com';

// contact phone number. to be shown whereever contact is needed
$settings['contact_phone'] = '+1 (412) 343 566 90';

// whatsapp number of site
$settings['whatsapp_number'] = '+1 (412) 343 566 90';

// the address of company
$settings['contact_address'] = '203, Behind Alis Street, MB, Australia.';

// short description of site. Will show at the footer area
$settings['site_description'] = $settings['site_name'] . ' stands firmly in support of financial freedom and the liberty that Bitcoin provides globally for anyone to voluntarily participate in a permissionless and decentralized network.';

// about company. to be used in [template]/public/components/section-about.php
// this shows in homepage and about us page
$settings['company_about'] = $settings['site_name'] . ' was founded in 2017 as a UK based fund management company regulated by the European Security and Markets Authority (ESMA) under the jurisdiction of the European Union with head office in Paris, France.';

$settings['company_mission'] = 'We are a trading and investment management company aimed at providing clients the best possible services in today’s markets. Now, almost three years later, ' . $settings['site_name'] . ' options can proudly say it has achieved this goal.';

// link for video on about section
$settings['about_youtube_video_link'] = 'https://www.youtube.com/watch?v=F3QpgXBtDeo';

// add vision for the company
$settings['company_vision'] = $settings['site_name'] . ' is committed to give an opportunity to as many traders as possible to invest their money in crypto currency trading. Our main task is to simplify both the trading and the process of getting a profit.';

// define the menu and order in which they appear. This menu is used at the top navigation.
// here you can also specify any extra pages you create
// Check the instructions on how to create a page
// By default, the items in this array are picked, exploded, and capitalized
// all of them also appear as [root]/page/[page-title] e.g. [root]/page/about-us
$settings['primary_menu'] = ['about-us', 'investment-plans', 'faqs', 'contact-us', 'login'];

// set the items and order for secondary menu. These will be used at the useful links section
$settings['secondary_menu'] = ['login', 'register', 'about-us', 'terms', 'latest-news', 'contact-us', 'faqs'];

// set an external links navigation for the "useful links" section
// you must specify the title and url. 
// you can remove or add to the array, but make sure you follow the pattern
$settings['external_menu'] = [
    ['title' => 'Bitcoin News', 'url' => 'https://news.bitcoin.com'],
    ['title' => 'Coinbase Wallet', 'url' => 'https://wallet.coinbase.com'],
    ['title' => 'Paxful', 'url' => 'https://paxful.com'],
    ['title' => 'CoinBureau', 'url' => 'https://www.coinbureau.com/'],
    ['title' => 'Coin Gecko', 'url' => 'https://www.coingecko.com/en'],
];

// this is an array of frequently asked questions
// this might be transferred to a database later.
// modify as needed. also, delete irrelevant ones.
// add new items to the array in the given format
// e.g. ['question'=>'your quuestion', 'answer' -> 'your answer']
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
        'answer' => ''. $settings['site_name']. ' does not give tax advice. Please consult your tax or legal advisor.'
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
        'question' => 'What are the objectives of '. $settings['site_name']. '? ',
        'answer' => "To help unsuccessful traders recoup losses and become successful in forex trading, to assist low income earners offset bills and reduce multiple work load by providing a side earning venture from the forex market, to help retire annually over 2 million individuals across the 5 continents we've installed our structure already."
    ],
    [
        'question' => "What's the long-term goal of ". $settings['site_name']. "?",
        'answer' => ''. $settings['site_name']. ' has made available a provision for investors to alter their respective Bitcoin wallet addresses on the fly. This can only be done 2 times in a month.'
    ],

    [
        'question' => 'Is there any form of security covering investors funds? ',
        'answer' => 'Yes, there is. Investors with over $20,000 stakes get '. $settings['site_name']. ' insurance cover documents.'
    ],
    [
        'question' => 'Is '. $settings['site_name']. ' regulated? ',
        'answer' => 'Yes, '. $settings['site_name']. ' is franchised by AAA Trade Limited,which is directly under the regulations of European Security and Markets Authority (ESMA) under the jurisdiction of the European Union with head office in Paris, France. For more information on our licensing, please contact support, live chat, or any of our online agents.'
    ],
    [
        'question' => "What's your achievement overview since ". $settings['site_name']. " went public in 2017? ",
        'answer' => 'It has come to our notice that some envious and unsuccessful platforms that failed to keep it real with their investors have decided to adopt the negative review measure to promote their platforms by paying bloggers to give false review about us. We advise you not to look elsewhere as '. $settings['site_name']. ' has got a great future than we see today.'
    ],
    [
        'question' => 'Can I Change My Bitcoin Address? ',
        'answer' => ''. $settings['site_name']. ' has made available a provision for investors to alter their respective Bitcoin wallet addresses on the fly. This can only be done 2 times in a month.'
    ],
    [
        'question' => 'Where do you see '. $settings['site_name']. ' in coming years? ',
        'answer' => "We've got our coin in view, with the potential of coming first in the coin market and generally accepted by most business ventures as an online medium of payment. It's a great opportunity for you to be part of this project; if you are, then you are a potential millionaire, that's if you aren't one already. ". $settings['site_name']. " platform you see today is one big tool we are using to install our great structure across the globe."
    ],

];

$settings['faqs'] = $faqs;


return $settings;
