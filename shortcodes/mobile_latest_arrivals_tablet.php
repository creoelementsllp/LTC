<?php
function mobile_latest_arrivals_tablet_shortcode($atts)
{
    // Shortcode attributes with default values
    $atts = shortcode_atts(
        array(
            'category' => '',  // Category slug (optional)
            'limit' => 10,     // Number of products to show
            'columns' => 4,    // Number of products per row for desktop
        ),
        $atts,
        'product_cards'
    );

    // Query WooCommerce products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $atts['limit'],
        'post_status' => 'publish',
    );

    if (!empty($atts['category'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $atts['category'],
            ),
        );
    }

    $query = new WP_Query($args);

    // Output buffer to capture HTML
    ob_start();

    if ($query->have_posts()) {
        $count = 0;
        $columns = intval($atts['columns']); // Default to 4 columns for desktop

        // Open the table
        echo '<table class="latest-arrivals-table">';

        // Open the first row
        echo '<tr>';

        while ($query->have_posts()) {
            $query->the_post();

            global $product;

            $product_id = $product->get_id();

            // Render a product cell
            echo '<td class="product-card">';
            echo '<a href="' . get_permalink() . '" class="product-link">';
            
            echo '<div class="wishlist-btn yith-wcwl-add-to-wishlist add_to_wishlist" data-product-id="' . esc_attr($product_id) . '">
                    <span class="heart-icon">&#9825;</span>
                </div>';

            echo woocommerce_get_product_thumbnail();
            echo '<h2 class="product-title">' . get_the_title() . '</h2>';
            echo '<div class="product-price">' . $product->get_price_html() . '</div>';
            echo '</a>';
            echo '</td>';

            $count++;

            // Close the current row and start a new one after every $columns products
            if ($count % $columns === 0 && $count < $atts['limit']) {
                echo '</tr>'; // Close the current row
                echo '<tr>';  // Start a new row
            }
        }

        // Close any unclosed row
        if ($count % $columns !== 0) {
            // Add empty cells to complete the last row
            $remaining = $columns - ($count % $columns);
            for ($i = 0; $i < $remaining; $i++) {
                echo '<td class="empty-cell"></td>';
            }
            echo '</tr>';
        }

        // Close the table
        echo '</table>';

        // Add the "See All Products" button
        echo '<div class="see-more-row">';
        echo '<a href="' . get_permalink(woocommerce_get_page_id('shop')) . '" class="see-more-btn">See All Products</a>';
        echo '</div>';
    } else {
        echo '<p>No products found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}

// Add the shortcode
add_shortcode('mobile_latest_arrivals_tablet', 'mobile_latest_arrivals_tablet_shortcode');
?>
