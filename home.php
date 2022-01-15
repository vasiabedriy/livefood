<?php
/* Template Name: Home page */

get_header();

$product_id = get_field( "special_offer_product" );

$product = wc_get_product($product_id);
//$product->wc_get_product();

$product_name = $product->get_name();
$product_description = $product->get_description();
$product_image = $product->get_image( "full" );
$product_weight = $product->get_weight();
$product_price= $product->get_price();
$permalink = $product->get_permalink();

if (get_locale() == 'ua') {
	$add_to_cart = "Додати до кошику";
	$go_to_shop = "До магазину";
} else {
	$add_to_cart = "Добавить в корзину";
	$go_to_shop = "В магазин";
}
?>

<iframe width="560" height="315" src="http://www.youtube.com/embed/FFEuaU22wh4?autoplay=1&loop=1&playlist=GRonxog5mbw" frameborder="0" allowfullscreen></iframe>


<?php if( get_field("show_special_offer_product") ){?>
    <section class="special_offer">
        <div class="product_image">
    <!--        <img src="--><?php //echo get_template_directory_uri(); ?><!--/library/images/lavanda_tart.png">-->
            <?php echo $product_image; ?>
        </div>
        <div class="product_details">
            <h2 class="offer_title"><?php the_field("special_offer_title");?></h2>
	        <?php echo $product_image; ?>
            <h3 class="product_name"><?php echo $product_name;?></h3>
            <p class="product_description"><?php echo $product_description;?></p>
            <div class="product_characteristics">
                <div class="product_weight"><div><?php echo $product_weight;?><span class="units">г</span></div></div>
                <div class="product_price"><div><?php echo $product_price;?><span class="units">грн</span></div></div>
            </div>
            <a href="/shop/?add-to-cart=<?php echo $product_id;?>" class="add_to_cart"><?php echo $add_to_cart;?></a>
        </div>
    </section>
<?php }?>
<section class="benefits">
    <?php for ( $i = 1; $i <= 4; $i++ ) {
        if( get_field("benefit_icon_" . $i) && get_field("benefit_title_" . $i ) ){
        ?>
        <div class="benefit">
            <img class="icon" src="<?php the_field("benefit_icon_" . $i);?>">
            <h2 class="title"><?php the_field("benefit_title_" . $i );?></h2>
            <span class="divider"></span>
            <p class="description"><?php the_field("benefit_description_" . $i );?></p>
        </div>
    <?php }
    }?>
</section>

<section class="what_is">
    <div class="content">
        <h2 class="title"><?php the_field("what_is_title");?></h2>
        <p class="description"><?php the_field("what_is_description");?></p>
        <a href="/shop" class="add_to_cart"><?php echo $go_to_shop;?></a>
    </div>
    <img class="tart" src="<?php echo get_template_directory_uri(); ?>/library/images/what_is_tart.png">
</section>

<section class="fresh_deserts">
    <img class="tart" src="<?php echo get_template_directory_uri(); ?>/library/images/fresh_deserts_tart.png">
    <div class="content">
        <h2 class="title"><?php the_field("fresh_deserts_title");?></h2>
        <p class="description"><?php the_field("fresh_deserts_description");?></p>
        <a href="/shop" class="add_to_cart"><?php echo $go_to_shop;?></a>
    </div>
</section>


<?php
get_footer();
?>
