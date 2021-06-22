<?php

use Slim\App;

return function (App $app) {
    // get public
    (require __DIR__ . '/public.php')($app);
    // get user
    (require __DIR__ . '/user.php')($app);
    // get admin
    (require __DIR__ . '/admin.php')($app);
    // get api
    (require __DIR__ . '/api.php')($app);
};
