<!doctype html>
<html <?php language_attributes(); ?>>
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php $options = get_option('salient'); ?>

<?php if(!empty($options['responsive']) && $options['responsive'] == 1) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />

<?php } else { ?>
	<meta name="viewport" content="width=1200" />
<?php } ?>

<!--Shortcut icon-->
<?php if(!empty($options['favicon'])) { ?>
	<link rel="shortcut icon" href="<?php echo nectar_options_img($options['favicon']); ?>" />
<?php } ?>


<title> <?php wp_title("|",true, 'right'); ?> <?php if (!defined('WPSEO_VERSION')) { bloginfo('name'); } ?></title>

<?php wp_head(); ?>

</head>

<?php
 global $post;

if(is_home() || is_archive()){
	$header_title = get_post_meta(get_option('page_for_posts'), '_nectar_header_title', true);
	$header_bg = get_post_meta(get_option('page_for_posts'), '_nectar_header_bg', true);
	$header_bg_color = get_post_meta(get_option('page_for_posts'), '_nectar_header_bg_color', true);
}  else {
	$header_title = get_post_meta($post->ID, '_nectar_header_title', true);
	$header_bg = get_post_meta($post->ID, '_nectar_header_bg', true);
	$header_bg_color = get_post_meta($post->ID, '_nectar_header_bg_color', true);
}

//header vars
$logo_class = (!empty($options['use-logo']) && $options['use-logo'] == '1') ? null : 'class="no-image"';
$headerFormat = (!empty($options['header_format'])) ? $options['header_format'] : 'default';

?>

<body <?php body_class(); ?> data-header-inherit-rc="<?php echo (!empty($options['header-inherit-row-color']) && $options['header-inherit-row-color'] == '1') ? "true" : "false"; ?>" data-header-search="<?php echo $headerSearch; ?>" data-animated-anchors="<?php echo (!empty($options['one-page-scrolling']) && $options['one-page-scrolling'] == '1') ? 'true' : 'false'; ?>" data-ajax-transitions="<?php echo (!empty($options['ajax-page-loading']) && $options['ajax-page-loading'] == '1') ? 'true' : 'false'; ?>" data-full-width-header="<?php echo $fullWidthHeader; ?>" data-slide-out-widget-area="<?php echo ($sideWidgetArea == '1') ? 'true' : 'false';  ?>" data-loading-animation="<?php echo (!empty($options['loading-image-animation'])) ? $options['loading-image-animation'] : 'none'; ?>" data-bg-header="<?php echo (!empty($header_bg) || !empty($header_bg_color) || !empty($header_title) || $parallax_nectar_slider == 1 || $force_effect == 'on') ? 'true' : 'false'; ?>" data-ext-responsive="<?php echo (!empty($options['responsive']) && $options['responsive'] == 1 && !empty($options['ext_responsive']) && $options['ext_responsive'] == '1') ? 'true' : 'false'; ?>" data-header-resize="<?php if(!empty($options['header-resize-on-scroll'])) { echo $options['header-resize-on-scroll']; } else { echo '0'; } ?>" data-header-color="<?php echo (!empty($options['header-color'])) ? $options['header-color'] : 'light' ; ?>" <?php echo (!empty($options['transparent-header']) && $options['transparent-header'] == '1') ? null : 'data-transparent-header="false"'; ?> data-smooth-scrolling="<?php echo $options['smooth-scrolling']; ?>" data-responsive="<?php echo (!empty($options['responsive']) && $options['responsive'] == 1) ? '1'  : '0' ?>" >

<!-- GOOGLE ANALYTICS -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-10662187-4', 'auto');
  ga('send', 'pageview');

</script>

<script>
/**
* Function that tracks a click on an outbound link in Analytics.
* This function takes a valid URL string as an argument, and uses that URL string
* as the event label. Setting the transport method to 'beacon' lets the hit be sent
* using 'navigator.sendBeacon' in browser that support it.
*/
var trackOutboundLink = function(url, redirect) {
   ga('send', 'event', 'outbound', 'click', url, {
     'transport': 'beacon',
     'hitCallback': function(){ return redirect ? document.location = url : false;}
   });
}
</script>


<?php if(!empty($options['boxed_layout']) && $options['boxed_layout'] == '1') { echo '<div id="boxed">'; } ?>


<div class="header-wrapper js-headerWrapper">

	<!-- Prevent JS error in parent theme that expects this element -->
	<div id="header-outer" data-header-resize="0" style="display:none;"></div>

	<header>

		<!-- Mobile menu hamburger button -->
		<nav>
			<label href="#mobilemenu" class="nav-toggle">
				<i class="fa fa-bars nav-toggle--icon--show js-navToggleIconShow"></i>
				<i class="fa fa-times nav-toggle--icon--hide js-navToggleIconHide"></i>
				<input type="checkbox" class="js-navToggle" aria-hidden="true" hidden>
					<ul class="nav-flyout js-scrollToWrapper js-navFlyout">
					<?php
						if(has_nav_menu('top_nav')) {
						    wp_nav_menu( array('theme_location' => 'top_nav', 'menu' => 'Top Navigation Menu', 'container' => '', 'items_wrap' => '%3$s' ) );
						} else {
							echo '<li><a href="">No menu assigned!</a></li>';
						}
					?>
				</ul>
			</label>
		</nav>

		<a href="/" class="header-logo__container">

			<?php if(!empty($options['use-logo'])) {

					$default_logo_class = (!empty($options['retina-logo'])) ? 'default-logo' : null;
					$dark_default_class = (empty($options['header-starting-logo-dark'])) ? ' dark-version': null;

					 if (!empty($options['retina-logo'])) {
						 echo '<img class="retina-logo '.$dark_default_class.'" alt="'. get_bloginfo('name') .'" src="' . nectar_options_img($options['retina-logo']) . '" />';
					 } else {
						 echo '<img class="'.$default_logo_class. $dark_default_class.'" alt="'. get_bloginfo('name') .'" src="' . nectar_options_img($options['logo']) . '" />';
					 }

				 } else { echo get_bloginfo('name'); } ?>
		</a>

	</header>

</div><!--/ .header-wrapper -->

<div class="content__wrapper" id="ajax-content-wrap">
