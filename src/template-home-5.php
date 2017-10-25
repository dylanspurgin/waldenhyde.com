<?php
/*template name: Home - New */
get_header();

$options = get_option('salient');

//calculate cols
if(!empty($options['main_portfolio_layout'])) {

	switch($options['main_portfolio_layout']){
		case '3':
			$cols = 'cols-3';
			break;
		case '4':
			$cols = 'cols-4';
			break;
		case 'fullwidth':
			$cols = 'elastic';
			break;
	}

} else {
	$cols = 'cols-3';
}

if(!empty($cols)) {

	switch($cols){
		case 'cols-3':
			$span_num = 'span_4';
			break;
		case 'cols-4':
			$span_num = 'span_3';
			break;
		case 'elastic':
			$span_num = 'elastic-portfolio-item';
			break;

	}

}

$project_style = (!empty($options['main_portfolio_project_style'])) ? $options['main_portfolio_project_style'] : '1' ;
$masonry_layout = (!empty($options['portfolio_use_masonry']) && $options['portfolio_use_masonry'] == '1') ? 'true' : 'false';
$infinite_scroll_class = (!empty($options['portfolio_pagination_type']) && $options['portfolio_pagination_type'] == 'infinite_scroll') ? ' infinite_scroll' : null;

//disable masonry for default project style fullwidtrh
if($project_style == '1' && $cols == 'elastic') $masonry_layout = 'false';

$display_sortable = get_post_meta($post->ID, 'nectar-metabox-portfolio-display-sortable', true);
$inline_filters = (!empty($options['portfolio_inline_filters']) && $options['portfolio_inline_filters'] == '1') ? '1' : '0';
$filters_id = (!empty($options['portfolio_inline_filters']) && $options['portfolio_inline_filters'] == '1') ? 'portfolio-filters-inline' : 'portfolio-filters';
$bg = get_post_meta($post->ID, '_nectar_header_bg', true);

?>


<div class="home-page">

	<div class="container-fluid no-gutter">

		<!-- <div class="site-tagline__container">
            <h2 class="site-tagline"><?php echo get_bloginfo('description') ?></h2>
        </div> -->

		<div class="more-link__wrapper js-scrollToWrapper js-homeMoreLinkWrapper">
			<a href="#pagetwo" class="more-link">More<br><span>&#8595;</span></a>
		</div>

		<?php
			$hero_mp4 = get_post_meta($post->ID, '_wh_hero_video_mp4', true);
			$hero_webm = get_post_meta($post->ID, '_wh_hero_video_webm', true);
			$hero_image = get_post_meta($post->ID, '_wh_hero_video_poster', true);

			if ($hero_mp4 && $hero_webm && $hero_image) :
		?>
			<video poster="<?php echo $hero_image ?>"
				class="home--hero-video js-homeHero" playsinline autoplay muted loop>
				<source src="<?php echo $hero_webm ?>" type="video/webm">
				<source src="<?php echo $hero_mp4 ?>" type="video/mp4">
			</video>
		<?php elseif ($hero_image): ?>
			<img class="home--hero-video js-homeHero" src="<?php echo $hero_image ?>" >
		<?php endif; ?>
	</div>

	<div class="container-fluid no-gutter section-content" id="pagetwo">
		<div class="site-leadin__wrapper">
			<p class="site-leadin"><?php echo get_theme_mod('site_leadin') ?></p>
		</div>
	</div>

	<div class="container-fluid no-gutter">
		<?php
            // Get the portfolio posts
			$portfolio = array(
                'post_type' => 'portfolio',
                'project-type'=> ['home page grid'],
                'posts_per_page' => 7,
                'meta_key'=>'grid_order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC'
			);

			$wp_query = new WP_Query($portfolio);
        ?>

		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

			<?php $grid_index = $wp_query->current_post+1; ?>

			<?php if (1 == $grid_index): ?>
				<div class="portfolio-grid-items--1-2-3-4__container">
			<?php elseif (2 == $grid_index): ?>
					<div class="portfolio-grid-items--2-3-4__container">
			<?php elseif (5 == $grid_index): ?>
				<div class="portfolio-grid-items--5-6-7__container">
			<?php endif; ?>

			<a href="<?php echo get_page_link(); ?>"
				class="portfolio-grid-item
					portfolio-grid-item--<?php echo $grid_index ?>
					js-portfolioItemWaypoint"
				style="background-image: url('<?php the_post_thumbnail_url(); ?>')">
				<span class="portfolio-grid-item__copy__wrapper <?php if (get_post_meta($post->ID, '_nectar_portfolio_item_leadin_visible', true)) { echo 'portfolio-grid-item__copy__always-on'; } ?>">
					<span class="portfolio-grid-item__title u-spaced-out"><?php the_title(); ?></span>
					<span class="portfolio-grid-item__leadin"><?php echo get_post_meta($post->ID, '_nectar_portfolio_item_leadin', true); ?></span>
				</span>
			</a>


			<?php if (4 == $grid_index): ?>
					</div>
				</div>
			<?php elseif (7 == $grid_index): ?>
				</div>
			<?php endif; ?>

		<?php endwhile; endif; ?>

   </div><!-- /container (portfolio-wrap) -->



   <!-- About -->
   <?php
       $the_slug = 'about';
       $args = array(
         'pagename'    => $the_slug,
         'post_type'   => 'page',
         'post_status' => 'publish',
         'numberposts' => 1
       );
       $post = get_posts($args)[0];
       $header_title = get_post_meta($post->ID, '_nectar_header_title', true);
       $header_subtitle = get_post_meta($post->ID, '_nectar_header_subtitle', true);
   ?>
   <!-- About content -->
   <div class="container-fluid section-content" id="about">

       <!-- About Lead in -->
       <!-- <div class="row home--section-lead-in">
           <div class="col-md-2"></div>
           <div class="col-md-8">
               <?php echo $header_subtitle ?>
           </div>
           <div class="col-md-2"></div>
       </div>

       <div class="row home--section-hr">
           <div class="col-xs-4 col-md-5"></div>
           <div class="col-xs-4 col-md-2">
               <hr>
           </div>
           <div class="col-xs-4 col-md-5"></div>
       </div> -->

       <!-- About title -->
       <!-- <div class="row home--section-header">
           <div class="col-md-5"></div>
           <div class="col-md-2">
               <h2><?php echo $header_title ?></h2>
           </div>
           <div class="col-md-5"></div>
       </div> -->

       <!-- About content / excerpt -->
      <div class="row no-gutter about-container">
          <div class="col-sm-12 col-md-2">
          </div>
          <div class="col-sm-12 col-md-2 about-featured-image__wrapper">
          	  <img src="<?php the_post_thumbnail_url(); ?>" class="about-featured-image">
          </div>
          <div class="col-sm-12 col-md-6 home--about-excerpt">
              <?php the_excerpt(); ?>
              <a href="#" class="collapsible-more-link">More</a>
          </div>
          <div class="col-sm-12 col-md-2">
          </div>
      </div>

       <!-- Capabilities -->
       <div class="collapsible-container collapse container-fluid home--about-more__wrapper">
           <?php echo get_page( $post->ID )->post_content; ?>
      </div>

	  <?php wp_reset_postdata(); ?>

      <script type="text/javascript">
          jQuery('.collapsible-more-link').click(function($event){
              $event.preventDefault();
              jQuery('.collapsible-container').slideToggle('slow');
              jQuery('.collapsible-more-link').slideToggle('slow');
          });
      </script>

   </div><!-- /About content -->


   <!-- Clients -->
   <?php
   	$the_slug = 'clients';
   	$args = array(
   	  'pagename'        => $the_slug,
   	  'post_type'   => 'page',
   	  'post_status' => 'publish',
   	  'numberposts' => 1
   	);
   	$post = get_posts($args)[0];
   	$header_title = get_post_meta($post->ID, '_nectar_header_title', true);
   	$header_subtitle = get_post_meta($post->ID, '_nectar_header_subtitle', true);
   ?>
   <div class="container-fluid section-content">

		<!-- Clients Lead in -->
		<!-- <div class="row home--section-lead-in">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<?php echo $header_subtitle ?>
			</div>
			<div class="col-md-2"></div>
		</div> -->

		<div class="row home--section-hr">
			<div class="col-xs-4 col-md-5"></div>
			<div class="col-xs-4 col-md-2">
				<hr>
			</div>
			<div class="col-xs-4 col-md-5"></div>
		</div>

		<!-- Clients title -->
		<div class="row home--section-header">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				<h2><?php echo $header_title ?></h2>
			</div>
			<div class="col-md-5"></div>
		</div>

		<!-- Clients grid items -->
		<?php
			// Get the Client posts
			$portfolio = array(
				'posts_per_page' => '-1',
				'post_type' => 'portfolio',
				'project-type'=> ['Clients'],
				'paged'=> $paged
			);
			$wp_query = new WP_Query($portfolio);
		?>
		<div class="homepage--clients__container">
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
				<div class="homepage--client-logo fixed-ratio"
				 style="background-image: url('<?php the_post_thumbnail_url(); ?>')">
			 </div><!-- / client logo -->
			<?php endwhile; endif; wp_reset_postdata(); ?>
		</div>

   </div><!-- /Clients content -->



   <!-- Articles -->
   <?php
       $the_slug = 'Insights';
       $args = array(
         'pagename'        => $the_slug,
         'post_type'   => 'page',
         'post_status' => 'publish',
         'numberposts' => 1
       );
       $post = get_posts($args)[0];
       $header_title = get_post_meta($post->ID, '_nectar_header_title', true);
       $header_subtitle = get_post_meta($post->ID, '_nectar_header_subtitle', true);
   ?>
   <!-- Articles content -->
   <div class="container-fluid section-content">

       <!-- Articles Lead in -->
       <!-- <div class="row home--section-lead-in">
           <div class="col-md-2"></div>
           <div class="col-md-8">
               <?php echo $header_subtitle ?>
           </div>
           <div class="col-md-2"></div>
       </div> -->

       <div class="row home--section-hr">
           <div class="col-xs-4 col-md-5"></div>
           <div class="col-xs-4 col-md-2">
               <hr>
           </div>
           <div class="col-xs-4 col-md-5"></div>
       </div>

       <!-- Articles title -->
       <div class="row home--section-header">
           <div class="col-md-5"></div>
           <div class="col-md-2">
               <h2><?php echo $header_title ?></h2>
           </div>
           <div class="col-md-5"></div>
       </div>

       <!-- Articles grid items -->
       <?php
           // Get the Articles posts
           $args = array(
               'numberposts' => 3,
               'post_type' => 'post',
               'category_name'=> 'homepage article',
               'paged'=> false
           );
           $posts = get_posts($args);
       ?>

	   <div class="article-grid__container">

	       <?php foreach ($posts as $post) {
			   // Use Link URL value if set. Otherwise use post link
		       $external_link = get_post_meta($post->ID, '_nectar_link', true);
			   $link = strlen($external_link) > 1 ? $external_link : get_permalink($post->ID);
		   ?>

           <div class="article-grid-item">
			   <div class="article-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
			   </div>
               <h2 class="article-title">
							   <a class="read-link" href="<?php echo $link ?>" target="_blank">
                   <?php echo $post->post_title ?>
								 </a>
               </h2>
               <p class="article-excerpt">
                   <?php echo $post->post_excerpt ?>
               </p>
               <div class="article-source">
                   <?php echo get_post_custom_values('source', $post->ID)[0];?>
               </div>
               <a class="read-link" href="<?php echo $link ?>" target="_blank"><strong>READ</strong></a>
               <br >
			   <hr>
           </div>
       	   <?php } wp_reset_postdata(); ?>
		</div>
   </div><!-- /Articles content -->



</div><!-- /home-page -->

<?php get_footer(); ?>
