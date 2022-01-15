<?php
get_header();

//include __DIR__ . '\single-product\add-to-cart\variable.php';

$minerals_count = 5;
$vitamins_count = 5;

if (get_locale() == 'ua') {
	$to_shop = "До магазину";
	$add_to_cart = "До кошику";
	$composition = "КБЖВ на 100 г";
	$daily_norm = "% від денної норми";
	$kilocalorie = "К";
	$proteins = "Б";
	$fat = "Ж";
	$carbohydrates= "В";
	$recommendations_title = "Рекомендації зі зберігання та вживання";
} else {
	$to_shop = "В магазин";
	$add_to_cart = "В корзину";
	$composition = "КБЖУ на 100 г";
	$daily_norm = "% от дневной нормы";
	$kilocalorie = "К";
	$proteins = "Б";
	$fat = "Ж";
	$carbohydrates= "У";
	$recommendations_title = "Рекомендации по хранению и употреблению";
}

$product_id = get_the_ID();
$product = wc_get_product($product_id);
$product_name = $product->get_name();
$product_description = $product->get_description();
$product_image = $product->get_image( "full" );
$product_weight = $product->get_weight();
$product_price= $product->get_price();
$permalink = $product->get_permalink();
$variations = $product->get_available_variations();
$attributes = $product->get_attributes();

//echo '<pre>'; print_r($attributes); echo '</pre>';
//
//$new = array_filter($variations, function ($var) {
//	return ($var['attributes']['attribute_pa_size'] == '%d0%bc%d0%b0%d0%bb%d0%b5%d0%bd%d1%8c%d0%ba%d0%b8%d0%b9-50%d0%b3');
//});
//echo '<pre>'; print_r($new); echo '</pre>';

$variations_data = [];
foreach ( $variations as $variation ):
    $temp = [];
	$temp["attributes"] = $variation["attributes"];
	$temp["display_price"] = $variation["display_price"];
	$temp["weight"] = $variation["weight"];
	$temp["length"] = $variation["dimensions"]["length"];
	$temp["variation_id"] = $variation["variation_id"];
	$variations_data[] = $temp;
	unset( $temp );
endforeach;

$attributes_list = [];
foreach ( $attributes as $attribute ):
    $temp = [];
	$attribute_name = $attribute->get_taxonomy();
	$attribute_terms = $attribute->get_terms();

	foreach ( $attribute_terms as $term ):
		$temp[] = $term->slug;
	endforeach;
	$attributes_list[str_replace( "pa_", "", $attribute_name )] = $temp;
	unset( $term );
endforeach;
//echo '<pre>'; print_r($attributes_list); echo '</pre>';

$variation_image = $variations[0]['variation_gallery_images'][0]['srcset'];
?>
	<section class="products_content single_product">
        <div class="breadcrumbs">
            <a href="/shop"><?php echo $to_shop;?></a>
        </div>
        <div class="title">
            <h1 class="h1"><?php echo $product_name;?></h1>
        </div>

        <div class="single_product_content active" data-step="1">
            <div class="description_block">
                <p class="description"><?php echo $product_description;?></p>
                <div class="variations">
                    <?php
                    $get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
                    wc_get_template(
	                    'single-product/add-to-cart/variable.php',
	                    array(
		                    'available_variations' => $get_variations ? $product->get_available_variations() : false,
		                    'attributes'           => $product->get_variation_attributes(),
		                    'selected_attributes'  => $product->get_default_attributes(),
	                    )
                    );
                    ?>
                </div>
            </div>
            <div class="image_block">
                <img class="image" srcset="<?php echo $variation_image;?>">
            </div>
            <div class="characteristic_block">
                <div class="characteristic">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/price-tag.svg">
                    <div class="numbers"><div><span id="product_price"><?php echo $product_weight;?></span><span class="units">грн</span></div></div>
                </div>
                <div class="characteristic">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/weight-tag.svg">
                    <div class="numbers"><div><span id="product_weight"><?php echo $product_weight;?></span><span class="units">г</span></div></div>
                </div>
                <div class="characteristic">
                    <img src="<?php echo get_template_directory_uri(); ?>/library/images/diameter-tag.svg">
                    <div class="numbers"><div><span id="product_length"><?php echo $product_weight;?></span><span class="units">см</span></div></div>
                </div>
            </div>

            <img class="scroll_down" srcset="<?php echo get_template_directory_uri(); ?>/library/images/arrow_scroll.svg">

        </div>

        <?php
//        $variation_image = $variations[0]['variation_gallery_images'][1]['srcset'];
        $variation_image_2_1 = get_template_directory_uri() . "/library/images/choco_almond_2.png";
        $variation_image_2_2 = get_template_directory_uri() . "/library/images/choco_almond_3.png";
        ?>
        <div class="single_product_content second animate" data-step="2">
            <div class="description_block">
                <p class="description_title"><?php echo $composition;?></p>
                <div class="composition">
                    <div class="item">
                        <span class="name"><?php echo $kilocalorie;?></span>
                        <span class="value"><?php the_field( 'kilocalorie' );?> кКал</span>
                    </div>
                    <div class="item">
                        <span class="name"><?php echo $proteins;?></span>
                        <span class="value"><?php the_field( 'proteins' );?> г</span>
                    </div>
                    <div class="item">
                        <span class="name"><?php echo $fat;?></span>
                        <span class="value"><?php the_field( 'fat' );?> г</span>
                    </div>
                    <div class="item">
                        <span class="name"><?php echo $carbohydrates;?></span>
                        <span class="value"><?php the_field( 'carbohydrates' );?> г</span>
                    </div>
                </div>
                <p class="description_title"><?php echo $daily_norm;?></p>
                <div class="minerals">
                    <?php for( $i =0; $i <= $minerals_count; $i++ ){
                        if( get_field( 'minerals_name_' . $i ) != '' && get_field( 'minerals_percent_' . $i ) != '' && get_field( 'minerals_weight_' . $i ) != '' ){
                            $percent = (int)get_field( 'minerals_percent_' . $i );
                            ?>
                            <div class="item">
                                <div class="bubble" style="background: linear-gradient( 0deg, rgba(100, 219, 197, 0.3) <?php echo $percent;?>%, white 0% );">
                                    <span class="name"><?php the_field( 'minerals_name_' . $i );?></span>
                                    <span class="percent"><?php the_field( 'minerals_percent_' . $i );?> %</span>
                                </div>
                                <span class="value"><?php the_field( 'minerals_weight_' . $i );?> мг</span>
                            </div>
                       <?php }
                    }?>
                </div>
                <div class="vitamins">
	                <?php for( $i =0; $i <= $vitamins_count; $i++ ){
		                if( get_field( 'vitamins_name_' . $i ) != '' && get_field( 'vitamins_percent_' . $i ) != '' && get_field( 'vitamins_weight_' . $i ) != '' ){
			                $percent = (int)get_field( 'vitamins_percent_' . $i );
			                ?>
                            <div class="item">
                                <div class="bubble" style="background: linear-gradient( 0deg, #D6F6C4 <?php echo $percent;?>%, white 0% );">
                                    <span class="name"><?php the_field( 'vitamins_name_' . $i );?></span>
                                    <span class="percent"><?php the_field( 'vitamins_percent_' . $i );?> %</span>
                                </div>
                                <span class="value"><?php the_field( 'vitamins_weight_' . $i );?> мг</span>
                            </div>
		                <?php }
	                }?>
                </div>
                <div class="variations">
                    <?php
                    $get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
                    wc_get_template(
	                    'single-product/add-to-cart/variable.php',
	                    array(
		                    'available_variations' => $get_variations ? $product->get_available_variations() : false,
		                    'attributes'           => $product->get_variation_attributes(),
		                    'selected_attributes'  => $product->get_default_attributes(),
	                    )
                    );
                    ?>
                </div>
            </div>
            <div class="image_block">
                <img class="image main_part animate__animated" srcset="<?php echo $variation_image_2_1;?>">
                <img class="image crashed_part animate__animated" srcset="<?php echo $variation_image_2_2;?>">
                <?php
                for ( $i = 1; $i <= 4; $i++ ){
                if( get_field( 'option_' . $i ) != '' ){?>
                    <div class="option option_<?php echo $i;?> animate_option animate__animated animate__delay-1s">
                        <span class="mark"><?php echo $i;?></span>
                        <span class="h4"><?php the_field( 'option_' . $i );?></span>
                        <img class="option_mask" srcset="<?php echo get_template_directory_uri(); ?>/library/images/option_mask_<?php echo $i;?>.svg">
                    </div>
	            <?php } } ?>

            </div>

            <img class="scroll_down" srcset="<?php echo get_template_directory_uri(); ?>/library/images/arrow_scroll.svg">
            <img class="scroll_up" srcset="<?php echo get_template_directory_uri(); ?>/library/images/arrow_scroll.svg">

        </div>

		<?php
		//        $variation_image = $variations[0]['variation_gallery_images'][1]['srcset'];
		$variation_image_3_1 = get_template_directory_uri() . "/library/images/choco_almond_2.png";
		$variation_image_3_2 = get_template_directory_uri() . "/library/images/choco_almond_3.png";
		?>
        <div class="single_product_content third animate" data-step="3">
            <div class="main_content">
                <div class="image_block">
                    <img class="image main_part animate__animated" srcset="<?php echo $variation_image_3_1;?>">
                    <img class="image crashed_part animate__animated" srcset="<?php echo $variation_image_3_2;?>">
                </div>
                <div class="recommendations">
                    <p class="title"><?php echo $recommendations_title;?></p>
                    <div class="recommendation">
	                    <?php
	                    for ( $i = 1; $i <= 4; $i++ ){
		                    if( get_field( 'recomendation_icon_' . $i ) != '' && get_field( 'recomendation_' . $i ) != '' ){?>
                                <div class="item">
                                    <img class="logo" srcset="<?php the_field( 'recomendation_icon_' . $i );?>">
                                    <span class="value"><?php the_field( 'recomendation_' . $i );?></span>
                                </div>
		                <?php } } ?>
                    </div>
                </div>
            </div>
            <div class="description_block">
                <div class="variations">
			        <?php
			        $get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
			        wc_get_template(
				        'single-product/add-to-cart/variable.php',
				        array(
					        'available_variations' => $get_variations ? $product->get_available_variations() : false,
					        'attributes'           => $product->get_variation_attributes(),
					        'selected_attributes'  => $product->get_default_attributes(),
				        )
			        );
			        ?>
                </div>
            </div>

            <img class="scroll_up" srcset="<?php echo get_template_directory_uri(); ?>/library/images/arrow_scroll.svg">

        </div>
	</section>

<script>
    function arrayEquals(a, b) {
        return Array.isArray(a) &&
            Array.isArray(b) &&
            a.length === b.length &&
            a.every((val, index) => val === b[index]);
    }
    function get_variation( variations ){
        var variations_data = '<?php echo json_encode( $variations_data );?>';
        variations_data = JSON.parse( variations_data );
        // console.log( variations_data );

        variations_data.forEach(function(element) {
            // console.log(element["attributes"]);
                if( JSON.stringify( element["attributes"] ) === JSON.stringify( variations ) ){
                    console.log("yes");
                    console.log(element);
                    jQuery("#product_price").text( element['display_price'] );
                    jQuery("#product_weight").text( element['weight'] );
                    jQuery("#product_length").text( element['length'] );
                }
            // for (const [key, value] of Object.entries(element["attributes"])) {
            //     console.log(`${key}: ${value}`);
            //     // if( variations[${key}] == ${value} ){
            //     //     console.log("yes");
            //     // }
            // }
            // if (JSON.stringify( element["attributes"] ) == JSON.stringify( variations ) ) {
            //     console.log("yes");
            // }
        });
    }
    jQuery(document).ready(function($) {
        $(document).on('change', '.variations select', function() {
            console.log("changed");
            var variations = {};
            $( this ).parents( '.variations' ).find("select").each(function (index) {
                console.log($(this).val());
                var variation = $(this).attr( "data-attribute_name");
                variations[variation] = $(this).val();
            });
            console.log( variations );

            get_variation( variations );
        });
    });
</script>
<?php
get_footer();