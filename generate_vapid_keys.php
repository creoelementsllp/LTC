<?php
require 'vendor/autoload.php'; // Ensure the web-push library is installed

use Minishlink\WebPush\VAPID;

$keys = VAPID::createVapidKeys();

echo "Public Key: " . $keys['publicKey'] . PHP_EOL;
echo "Private Key: " . $keys['privateKey'] . PHP_EOL;
?>
