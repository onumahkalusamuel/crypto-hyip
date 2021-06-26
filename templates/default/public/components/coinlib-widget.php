<?php

$defaults = [
    'type' => 'full_v2',
    'theme' => 'light',
    'count' => '10',
    'pref_coin_id' => '1505',
    'graph' => 'yes',
    'width' => '100%',
    'height' => '409'
];

[
    'type' => $type,
    'theme' => $theme,
    'count' => $cnt,
    'pref_coin_id' => $pref_coin_id,
    'graph' => $graph,
    'width' => $width,
    'height' => $height
] = ($widgetConfig ?? []) + $defaults;

// create url
$url = sprintf(
    "https://widget.coinlib.io/widget?type=%s&theme=%s&cnt=%s&pref_coin_id=%s&graph=%s",
    $type,
    $theme,
    $cnt,
    $pref_coin_id,
    $graph
);
?>

<iframe src="<?= $url; ?>" scrolling="auto" marginwidth="0" marginheight="0" border="0" style="border:0;margin:0;padding:0;" width="<?=$width;?>" height="<?=$height;?>" frameborder="0" loading="lazy"></iframe>