<?php

// /www/wwwroot/apiprs.my.id/public/deploy.php

$secret = 'f9e972a8-6333-4518-bd2c-d8076bf8917c';
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$payload = file_get_contents('php://input');

if (! hash_equals('sha256='.hash_hmac('sha256', $payload, $secret), $signature)) {
    http_response_code(403);
    exit('Forbidden');
}

$dir = '/www/wwwroot/apiprs.my.id';
$php = '/usr/bin/php';
$composer = '/usr/bin/composer';
$node = '/usr/bin/node';
$npm = '/usr/bin/npm';

$output = shell_exec("cd $dir && git pull 2>&1");
$output .= shell_exec("cd $dir && $composer install --no-dev --optimize-autoloader 2>&1");
$output .= shell_exec("cd $dir && $npm install 2>&1");
$output .= shell_exec("cd $dir && $npm run build 2>&1");
$output .= shell_exec("cd $dir && $php artisan migrate --force 2>&1");
$output .= shell_exec("cd $dir && $php artisan optimize 2>&1");

file_put_contents('/tmp/deploy.log', date('Y-m-d H:i:s')."\n".$output."\n", FILE_APPEND);

echo 'OK';
