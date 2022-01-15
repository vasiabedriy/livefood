let min_step = 1;
let max_step = 3;
var lastScrollTop = 0;

function animate_image( step ) {
    let crashed_part_animate = 'animate__rotateInUpLeft animate__zoomIn';
    let animate_option = 'animate__bounceIn';
    if( jQuery( '.single_product_content[data-step="'+step+'"]' ).hasClass( 'animate' ) ) {
        jQuery( '.single_product_content[data-step="'+step+'"]' ).find( '.crashed_part' ).addClass( crashed_part_animate );
        jQuery( '.single_product_content[data-step="'+step+'"]' ).find( '.animate_option' ).addClass( animate_option );
    }
}

jQuery( document ).ready(function($) {
    $(document).on('click', '.mobile_menu_icon', function() {
        $( ".mobile-nav" ).toggleClass( "show hide" );
    });

    $(document).on('click', '.scroll_down', function() {
        var step = $( this ).parents( '.single_product_content' ).data( "step" );
        $( '.single_product_content[data-step="'+step+'"]' ).removeClass( 'active' );
        $( '.single_product_content[data-step="'+(step+1)+'"]' ).addClass( 'active' );
        animate_image( step + 1 );
    });

    $(document).on('click', '.scroll_up', function() {
        var step = $( this ).parents( '.single_product_content' ).data( "step" );
        $( '.single_product_content[data-step="'+step+'"]' ).removeClass( 'active' );
        $( '.single_product_content[data-step="'+(step-1)+'"]' ).addClass( 'active' );
        animate_image( step - 1 );
    });

    // $( window ).scroll(function() {
    //     var st = $(this).scrollTop();
    //     if (st > lastScrollTop){
    //         var step = $( '.single_product_content.active' ).data( "step" );
    //         console.log( 'downscroll code', step );
    //         if( step < max_step ) {
    //             $('.single_product_content[data-step="' + step + '"]').removeClass('active');
    //             $('.single_product_content[data-step="' + (step + 1) + '"]').addClass('active');
    //         }
    //     } else {
    //         var step = $( '.single_product_content.active' ).data( "step" );
    //         console.log( 'upscroll code', step );
    //         if( step >= min_step ) {
    //             $('.single_product_content[data-step="' + step + '"]').removeClass('active');
    //             $('.single_product_content[data-step="' + (step - 1) + '"]').addClass('active');
    //         }
    //     }
    //     lastScrollTop = st;
    // });

    // $('#fullpage').fullpage({
    //     navigation: true,
    //     navigationPosition: 'right',
    //     navigationTooltips: ['section1', 'section2','section3','section4'],
    //     showActiveTooltip: true,
    //     slidesNavigation: true,
    //     slidesNavPosition: 'bottom',
    //     controlArrows:false,
    // });
})

jQuery( document ).ready(function($) {
    $( "#header_search input[type=\"search\"]").attr( 'aria-label', $( "#header_search").attr( 'aria-label' ) );

    $( ".main_logo a").attr( 'aria-label', $( ".main_logo").attr( 'aria-label' ) );

    $( ".elementor-swiper-button-prev .elementor-screen-only").text( "העבר ימינה" );
    $( ".elementor-swiper-button-next .elementor-screen-only").text( "העברת שמאלה" );

    $( "#footer_subscribe #form-field-email").attr( 'aria-label', 'הזן אימייל להרשמה לניוזלטר' );

    $( ".elementor-grid-item .elementor-post__read-more").attr( 'aria-label',  $( ".elementor-grid-item .elementor-post__title a").text() );
});