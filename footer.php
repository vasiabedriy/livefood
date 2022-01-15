<?php wp_footer();

if (get_locale() == 'ua') {
	$comment_title = "Ваші відгуки - це наше натхнення до вдосконалення!";
	$live_comment = "Залишити відгук";
} else {
	$comment_title = "Ваши отзывы - это наше вдохновение к совершенствованию!";
	$live_comment = "Оставить отзыв";
}
?>

<div class="comment">
    <div class="title"><?php echo $comment_title;?></div>
    <div class="live_comment"><?php echo $live_comment;?></div>
</div>
<footer>

    <div class="site_logo">
        <a href="/">
            <img src="<?php echo get_template_directory_uri(); ?>/library/images/logo_white.png">
        </a>
        <div class="rights">LiveFood © 2021<br>All rights reserved</div>
    </div>
    <div class="footer_menu">
		<?php $menuParameters = [
			'menu'            => 'primary',
			'container'       => false,
			'echo'            => false,
			'items_wrap'      => '%3$s',
			'depth'           => 0,
		];
		echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );?>
    </div>
    <div class="actions">
        <div class="phones">
            <a href="#">+38 095 5709 955</a>
        </div>
        <div class="socials">
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/inst_white.svg">
            </a>
            <a href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/fb_white.svg">
            </a>
        </div>
        <div class="payments">
            <img src="<?php echo get_template_directory_uri(); ?>/library/images/payments_info.png">
        </div>
    </div>
</footer>
</body>
</html>