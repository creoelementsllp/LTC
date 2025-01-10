<?php

add_action('template_redirect', 'track_recently_viewed_products');
function track_recently_viewed_products() {
    if (!is_singular('product')) {
        return;
    }

    if (!function_exists('wc_setcookie')) {
        return;
    }

    global $post;

    if (empty($_COOKIE['woocommerce_recently_viewed'])) {
        $viewed_products = array();
    } else {
        $viewed_products = explode('|', $_COOKIE['woocommerce_recently_viewed']);
    }

    // Remove current product ID if it's already in the list
    $viewed_products = array_diff($viewed_products, array($post->ID));
    
    // Add the current product ID to the beginning
    array_unshift($viewed_products, $post->ID);

    // Limit to the last 20 products viewed
    $viewed_products = array_slice($viewed_products, 0, 20);

    // Update the cookie
    wc_setcookie('woocommerce_recently_viewed', implode('|', $viewed_products));
}




function custom_recently_viewed_products_shortcode($atts)
{
    // Shortcode attributes with default values
    $atts = shortcode_atts(
        array(
            'limit' => 20, // Number of products to show
        ),
        $atts,
        'recently_viewed_products'
    );

    // Get the recently viewed product IDs from WooCommerce
    $viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? explode('|', $_COOKIE['woocommerce_recently_viewed']) : array();

    // If no recently viewed products exist, return an empty message
    if (empty($viewed_products)) {
        return '<p>No recently viewed products.</p>';
    }

    // Limit the number of displayed products
    $viewed_products = array_reverse(array_slice($viewed_products, 0, $atts['limit']));

    // Query recently viewed products
    $args = array(
        'post_type' => 'product',
        'post__in' => $viewed_products,
        'orderby' => 'post__in', // Preserve the order of the product IDs
        'posts_per_page' => $atts['limit'],
        'post_status' => 'publish',
    );

    $query = new WP_Query($args);

    // Output buffer to capture HTML
    ob_start();

    if ($query->have_posts()) {
        echo '<div class="swiper custom-recently-viewed-products">';
        echo '<div class="swiper-wrapper">';
        while ($query->have_posts()) {
            $query->the_post();

            global $product;
            $product_id = $product->get_id();
            echo '<a href="' . get_permalink() . '" class="product-card swiper-slide">'; // Start the clickable card
                // Add YITH Wishlist button
            echo '<div class="wishlist-btn yith-wcwl-add-to-wishlist add_to_wishlist" data-product-id="' . esc_attr($product_id) . '">
                    <span class="heart-icon">&#9825;</span>
                </div>';
            echo woocommerce_get_product_thumbnail();
            echo '<h3 class="product-title">' . get_the_title() . '</h3>';
            echo '<div class="product-price">' . $product->get_price_html() . '</div>';
            echo '</a>'; // Close card
        }
        echo '</div>'; // Close swiper-wrapper
        echo '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div>';
        echo '</div>'; // Close swiper
    } else {
        echo '<p>No recently viewed products.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}

// Add the shortcode
add_shortcode('recently_viewed_products', 'custom_recently_viewed_products_shortcode');
