<?php


define('VAPID_PUBLIC_KEY', 'BPs19Tjb5Jc065s3CSHsy1v4aaKPLtrEyOzFZDEgb-SKwMbmA2cck3mWxljXrlWwKjYELLTc8aeYY7QwpHcxLdU');
define('VAPID_PRIVATE_KEY', 'LSjm8GzKwiPsZhF8Y0syEQZeTBYn5aQXoXhtl4YC7B8');



// Save push subscriptions
function save_push_subscription() {
    $body = json_decode(file_get_contents('php://input'), true);
    if (!isset($body['endpoint'])) {
        wp_send_json_error(['message' => 'Invalid subscription']);
        return;
    }

    // Save to database (or file for testing)
    $subscriptions = get_option('creo_push_subscriptions', []);
    $subscriptions[$body['endpoint']] = $body;
    update_option('creo_push_subscriptions', $subscriptions);

    wp_send_json_success(['message' => 'Subscription saved']);
}
add_action('wp_ajax_save_push_subscription', 'save_push_subscription');
add_action('wp_ajax_nopriv_save_push_subscription', 'save_push_subscription');

// Send push notification
function send_push_notification($title, $body, $icon, $url) {
    require 'vendor/autoload.php';

    $auth = [
        'VAPID' => [
            'subject' => 'mailto:your-email@example.com',
            'publicKey' => VAPID_PUBLIC_KEY,
            'privateKey' => VAPID_PRIVATE_KEY,
        ],
    ];

    $webPush = new \Minishlink\WebPush\WebPush($auth);

    $subscriptions = get_option('push_subscriptions', []);
    foreach ($subscriptions as $subscription) {
        $webPush->sendNotification(
            $subscription['endpoint'],
            json_encode([
                'title' => $title,
                'body' => $body,
                'icon' => $icon,
                'url' => $url,
            ]),
            isset($subscription['keys']) ? $subscription['keys'] : []
        );
    }

    foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();
        if ($report->isSuccess()) {
            error_log("Push notification sent successfully to {$endpoint}");
        } else {
            error_log("Push notification failed for {$endpoint}: {$report->getReason()}");
        }
    }
}


// Hook for product publication
function notify_on_product_publish($ID, $post) {
    if ($post->post_type === 'product' && $post->post_status === 'publish') {
        send_push_notification(
            'New Product Published',
            $post->post_title,
            plugin_dir_url(__FILE__) . 'icon-192x192.png',
            get_permalink($ID)
        );
    }
}
add_action('publish_post', 'notify_on_product_publish', 10, 2);



add_action('rest_api_init', function () {
    register_rest_route('myplugin/v1', '/subscribe', [
        'methods' => 'POST',
        'callback' => 'handle_subscription',
        'permission_callback' => '__return_true',
    ]);
});

function handle_subscription($request) {
    $body = json_decode($request->get_body(), true);

    if (!isset($body['endpoint'])) {
        return new WP_Error('invalid_request', 'Missing endpoint', ['status' => 400]);
    }

    $subscriptions = get_option('push_subscriptions', []);
    $subscriptions[] = $body;
    update_option('push_subscriptions', $subscriptions);

    return rest_ensure_response(['success' => true]);
}


?>