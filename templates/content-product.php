<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $product; // Access the product object
?>

<div class="custom-product-card">
    <div class="product-image">
        <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
            <?php echo $product->get_image('woocommerce_thumbnail'); ?>
        </a>
    </div>
    <div class="product-details">
        <h2 class="product-title">
            <a href="<?php echo esc_url(get_permalink($product->get_id())); ?>">
                <?php echo esc_html($product->get_name()); ?>
            </a>
        </h2>
        <div class="product-price">
            <?php echo $product->get_price_html(); ?>
        </div>
    </div>
</div>
