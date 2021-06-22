<?php

foreach ($assets ?? [] as $asset) {
    echo sprintf('<link rel="stylesheet" type="text/css" href="%s">', $asset);
}
