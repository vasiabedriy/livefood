<?php
get_header();

//echo do_shortcode ('[products limit="6" columns="2"]');

if (get_locale() == 'ua') {
	$details = "Детальніше";
	$add_to_cart = "До кошику";
} else {
	$details = "Подробнее";
	$add_to_cart = "В корзину";
}

$args = array(
	'post_type'      => 'product',
	'posts_per_page' => -1,
);

$products = get_posts( $args );
?>
<section class="products_content">
    <div class="products">
        <?php
        foreach ( $products as $product ) {
            $wc_product = wc_get_product($product->ID);
            $product_name = $wc_product->get_name();
            $product_price= $wc_product->get_price();
	        $permalink = $wc_product->get_permalink();
	    ?>
            <div class="product">
                <img class="image" src="<?php echo get_the_post_thumbnail_url( $product->ID, 'full' );?>">
                <div class="price"><div><?php echo $product_price;?><span class="units">грн</span></div></div>
                <h2 class="title"><a href="<?php echo $permalink;?>"><?php echo $product->post_title;?></a></h2>
                <div class="controls">
                    <a class="details" href="<?php echo get_post_permalink($product->ID);?>"><?php echo $details;?></a>
                    <a class="add_to_cart" href="/shop/?add-to-cart=<?php echo$product->ID;?>"><?php echo $add_to_cart;?></a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<?php
get_footer();