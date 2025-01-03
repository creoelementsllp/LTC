<?php
// Include the autoload file from Composer (make sure it's included if you're using Composer)
require plugin_dir_path(__FILE__) . '../vendor/autoload.php';  // Adjust path if needed


use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\VAPID;

function send_push_notification($subscription, $title, $body) {
    // Your private and public VAPID keys (generate them using web-push library)
    $vapidKeys = [
        'publicKey' => 'BBKsuB-srhtR28dmb8JuLBeRpj4m32GM6QcTkcuXgv1CaFxbpwZyDwXcXOYKy-vpc3w3iX5HOxJgMpYkcWJRhII',
        'privateKey' => 'QIKIsvnTG-Py-4v3OiVcOLkrEs1bnjvSO7446vj9sOw',
    ];

    $webPush = new WebPush([
        'VAPID' => [
            'subject' => 'mailto:creoelementsllp@gmail.com',
            'publicKey' => $vapidKeys['publicKey'],
            'privateKey' => $vapidKeys['privateKey'],
        ],
    ]);

    $notification = [
        'subscription' => $subscription,
        'payload' => json_encode(['title' => $title, 'body' => $body]),
        'options' => ['TTL' => 60]
    ];

    $webPush->sendNotification($notification['subscription'], $notification['payload'], $notification['options']);
}
