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

<style>
	<?php if($span_num == 'elastic-portfolio-item') { ?>
		.container-wrap { padding-bottom: 0px!important; }
		#call-to-action .triangle { display: none; }
	<?php } ?>

	<?php if($span_num == 'elastic-portfolio-item' && !empty($bg)) { ?>
		.container-wrap { padding-top: 0px!important; }
	<?php } ?>

	<?php if($inline_filters == '1' && empty($bg)) { ?>
		.page-header-no-bg { display: none; }
		.container-wrap { padding-top: 0px!important; }
		body #portfolio-filters-inline { margin-top: -50px!important; padding-top: 5.8em!important; }
	<?php } ?>

	<?php if($inline_filters == '1' && empty($bg) && $span_num != 'elastic-portfolio-item') { ?>
		#portfolio-filters-inline.non-fw { margin-top: -37px!important; padding-top: 6.5em!important;}
	<?php } ?>

	<?php if($inline_filters == '1' && !empty($bg) && $span_num != 'elastic-portfolio-item') { ?>
		.container-wrap { padding-top: 3px!important; }
	<?php } ?>
</style>



<!-- Uncomment to enable header slider content on home page -->
<?php //echo nectar_page_header($post->ID); ?>

<div class="home-page">
    <!-- Work -->
    <?php
        $the_slug = 'work';
        $args = array(
          'pagename'    => $the_slug,
          'post_type'   => 'page',
          'post_status' => 'publish',
          'numberposts' => 1
        );
        $post = get_posts($args)[0];
        $header_subtitle = get_post_meta($post->ID, '_nectar_header_subtitle', true);
        $header_title = get_post_meta($post->ID, '_nectar_header_title', true);
    ?>
	<div class="container-fluid no-gutter section-content">

		<div class="site-tagline__container">
            <h2 class="site-tagline"><?php echo get_bloginfo('description') ?></h2>
			<section class="site-leadin"><?php echo get_theme_mod('site_leadin') ?></section>
        </div>

		<div class="more-link__container js-scrollToWrapper js-homeMoreLinkWrapper">
			<div class="more-link__wrapper">
				<a href="#pagetwo" class="more-link">More<br><span>&#8595;</span></a>
			</div>
		</div>

		<?php
            // Get the portfolio posts
			$portfolio = array(
                'post_type' => 'portfolio',
                'project-type'=> ['home page grid'],
                'posts_per_page' => -1,
                'meta_key'=>'grid_order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC'
			);

			$wp_query = new WP_Query($portfolio);
        ?>

		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

			<?php $grid_index = $wp_query->current_post+1; ?>

			<?php if (1 == $grid_index): ?>
				<a href="<?php echo get_page_link(); ?>"
	                class="portfolio-grid-item portfolio-grid-item--1"
	                style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>
			<?php elseif (2 == $grid_index): ?>
				<div class="portfolio-grid-row-2" id="pagetwo">
					<a href="<?php echo get_page_link(); ?>"
		                class="portfolio-grid-item portfolio-grid-item--2"
		                style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>

			<?php elseif (3 == $grid_index): ?>
			        <div class="portfolio-grid-items--3-4-5__container">
						<div class="portfolio-grid-items--3-4__container">
							<a href="<?php echo get_page_link(); ?>"
			                	class="portfolio-grid-item portfolio-grid-item--3"
				                style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>
			<?php elseif (4 == $grid_index): ?>
							<a href="<?php echo get_page_link(); ?>"
				                class="portfolio-grid-item portfolio-grid-item--4"
				                style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>
						</div>
			<?php elseif (5 == $grid_index): ?>
						<a href="<?php echo get_page_link(); ?>"
							class="portfolio-grid-item portfolio-grid-item--5"
							style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>
					</div>
				</div>
			<?php elseif (6 == $grid_index): ?>
				<div class="portfolio-grid-items--6-7__container">
					<a href="<?php echo get_page_link(); ?>"
		                class="portfolio-grid-item portfolio-grid-item--6"
		                style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>
			<?php elseif (7 == $grid_index): ?>
					<a href="<?php echo get_page_link(); ?>"
		                class="portfolio-grid-item portfolio-grid-item--7"
		                style="background-image: url('<?php the_post_thumbnail_url(); ?>')"></a>
				</div>
			<?php endif; ?>

		<?php endwhile; endif; ?>

   </div><!-- /container (portfolio-wrap) -->





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
       <div class="row home--section-lead-in">
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
       <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
           <div class="homepage--client-logo fixed-ratio col-xs-4 col-sm-3 col-md-3 col-lg-2 no-gutter"
		   	style="background-image: url('<?php the_post_thumbnail_url(); ?>')">
		</div><!-- / client logo -->
       <?php endwhile; endif; wp_reset_postdata(); ?>
   </div><!-- /Clients content -->



   <!-- About -->
   <?php
       $the_slug = 'about';
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
   <!-- About content -->
   <div class="container-fluid about-container section-content">

       <div id="about" ></div>

       <!-- About Lead in -->
       <div class="row home--section-lead-in">
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
       </div>

       <!-- About title -->
       <div class="row home--section-header">
           <div class="col-md-5"></div>
           <div class="col-md-2">
               <h2><?php echo $header_title ?></h2>
           </div>
           <div class="col-md-5"></div>
       </div>

       <!-- About content / excerpt -->
      <div class="row">
          <div class="col-md-2 col-xs-3">
          </div>
          <div class="col-md-2 hidden-sm hidden-xs">
              <img src="<?php the_post_thumbnail_url(); ?>" width="50%">
          </div>
          <div class="col-md-6 home--section-excerpt">
              <?php the_excerpt(); ?>
              <a href="#" class="collapsible-more-link">More</a>
          </div>
          <div class="col-md-2">
          </div>
      </div>

       <?php wp_reset_postdata(); ?>

       <!-- Capabilities -->
       <div class="collapsible-container collapse container-fluid">
           <div class="row home--section-hr">
               <div class="col-xs-4 col-md-5"></div>
               <div class="col-xs-4 col-md-2">
                   <hr>
               </div>
               <div class="col-xs-4 col-md-5"></div>
           </div>

           <!-- Capabilities title -->
           <div class="row home--section-header">
               <div class="col-md-4">&nbsp;</div>
               <div class="col-md-4">
                   <h2>Capabilities</h2>
               </div>
               <div class="col-md-4">&nbsp;</div>
           </div>

           <!-- Capabilities content / excerpt -->
          <div class="row u-padding--bottom--none">
              <div class="col-xs-12 col-md-1"></div>
              <div class="col-xs-12 col-sm-6 col-md-5">
                  <h4 class="capabilities-header u-uppercase u-spaced-out">Strategy</h4>
                  <p class="capabilities-text">Walden Hyde formed from the merger of research firm Kickstand and creative house Sustineo. Research and strategy are core to who we are and how we work. We have conducted consumer field research, market analysis, and strategic planning for Unilever, Nestlé Purina, Klean Kanteen, and others. We also released the largest syndicated study to date on sustainability in mainstream America. All agencies say they do strategy. Some actually do. Walden Hyde has a dedicated strategy team of made up of researchers, anthropologists, and brand analysts.</p>
              </div>
			  <div class="col-xs-12 col-sm-6 col-md-5">
                  <h4 class="capabilities-header u-uppercase u-spaced-out">Network</h4>
                  <p class="capabilities-text">The way brands and consumers relate is constantly evolving. We can help you stay relevant in the ways you engage your audience. Our network capabilities include influencers, social media, and partnerships. For example: tailoring your influencer strategy begins with knowing your goals and connecting with the right influencers in the right way. By establishing long-lasting relationships with influencers and managing every step of the process, Walden Hyde makes influencer collaboration as effective and seamless for your team as possible, while requiring minimal effort on your part to maintain.</p>
              </div>
			  <div class="col-xs-12 col-md-1"></div>
		  </div>

		  <div class="row">
			  <div class="col-xs-12 col-md-1"></div>
			  <div class="col-xs-12 col-sm-6 col-md-5">
                  <h4 class="capabilities-header u-uppercase u-spaced-out">Creative</h4>
                  <p class="capabilities-text">We believe great design changes the world. Walden Hyde is a full-service creative agency, delivering award-winning visual experiences that connect brands and consumers. All of our creative work is driven by insights and strategy. Our capabilities include digital, web, print, packaging, and space design.</p>
              </div>
			  <div class="col-xs-12 col-sm-6 col-md-5">
                  <h4 class="capabilities-header u-uppercase u-spaced-out">Media</h4>
                  <p class="capabilities-text">Predictive marketing, social media, and the rise of influencers are changing the landscape of media buying. We work with clients through every step of the media process from building comprehensive, agile media plans to launching, monitoring, tracking, and adjusting ad buys and creative.</p>
              </div>
             <div class="col-xs-12 col-md-1"></div>
          </div>
      </div>
      <script type="text/javascript">
          jQuery('.collapsible-more-link').click(function($event){
              $event.preventDefault();
              jQuery('.collapsible-container').slideToggle('slow');
              jQuery('.collapsible-more-link').slideToggle('slow');
          });
      </script>

   </div><!-- /About content -->





   <!-- Articles -->
   <?php
       $the_slug = 'Articles';
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
       <div class="row home--section-lead-in">
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

			 <div class="row articles-grid">

       <?php foreach ($posts as $post) {
		   // Use Link URL value if set. Otherwise use post link
	       $external_link = get_post_meta($post->ID, '_nectar_link', true);
		   $link = strlen($external_link) > 1 ? $external_link : get_permalink($post->ID);
	   ?>
           <div class="article-grid-item col-xs-12 col-sm-4">
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
