<?php

foreach ($assets ?? [] as $asset) {
    echo sprintf('<script type="text/javascript" src="%s"></script>', $asset);
}
