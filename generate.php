<?php
require 'vendor/autoload.php'; // Make sure Composer is autoloading classes
use Minishlink\WebPush\VAPID;

// Generate a new set of VAPID keys
$vapid = VAPID::createVAPIDKeys();
echo "Public Key: " . $vapid['publicKey'] . "\n";
echo "Private Key: " . $vapid['privateKey'] . "\n";
