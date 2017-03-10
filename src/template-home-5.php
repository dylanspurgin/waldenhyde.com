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

        <!-- Work Lead in -->
        <div class="row home--section-lead-in">
            <div class="col-xs-1 col-sm-2 col-md-3"></div>
            <div class="col-xs-10 col-sm-8 col-md-6">
                <?php echo $header_subtitle ?>
            </div>
            <div class="col-xs-1 col-sm-2 col-md-3"></div>
        </div>

        <div class="row home--section-hr">
            <div class="col-xs-4 col-md-5"></div>
            <div class="col-xs-4 col-md-2">
                <hr>
            </div>
            <div class="col-xs-4 col-md-5"></div>
        </div>

        <div class="row home--section-header">
            <div class="col-md-5"></div>
            <div class="col-md-2">
                <h2><?php echo $header_title ?></h2>
            </div>
            <div class="col-md-5"></div>
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

            <!-- Portfolio grid item -->
            <div class="portfolio-grid-thumbnail fixed-ratio col-xs-6 col-sm-6 col-md-4 col-lg-4 no-gutter">
				<a href="<?php echo get_page_link(); ?>"
                    class="portfolio-grid-thumbnail"
                    style="background-image: url('<?php the_post_thumbnail_url(); ?>')">

                    <!-- <div class="work-meta">
						<span class="title"><?php //the_title(); ?></span>
					</div> -->

				</a>
            </div><!--work-item-->

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
   <div class="container-fluid no-gutter section-content">

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
   <div class="container-fluid about-container no-gutter section-content">

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
       <div class="row col collapsible-container collapse">
           <div class="row home--section-hr">
               <div class="col-xs-4 col-md-5"></div>
               <div class="col-xs-4 col-md-2">
                   <hr>
               </div>
               <div class="col-xs-4 col-md-5"></div>
           </div>

           <!-- Capabilities title -->
           <div class="row home--section-header">
               <div class="col-md-5">&nbsp;</div>
               <div class="col-md-2">
                   <h2>Capabilities</h2>
               </div>
               <div class="col-md-5">&nbsp;</div>
           </div>

           <!-- Capabilities content / excerpt -->
          <div class="row">
              <div class="col-xs-12 col-sm-2 col-md-2"></div>
              <div class="col-xs-12 col-sm-3 col-md-3">
                  <ul class="capabilities-list">
                      <li class="capabilities-header">Research</li>
                      <li>Consumer Insights<li>
                      <li>Internal Insights<li>
                      <li>Trends &amp; Culture<li>
                      <li>Planning<li>
                      <li>Story Gathering<li>
                      <li>Segmentation<li>
                      <li>Psychographics<li>
                      <li>Brand Audit<li>
                      <li>Market Testing<li>
                  </ul>
              </div>
              <div class="col-xs-12 col-sm-3 col-md-3">
                  <ul class="capabilities-list">
                      <li class="capabilities-header">Strategy</li>
                      <li>Brand Implications<li>
                      <li>Territory ID<li>
                      <li>Brand Innovation<li>
                      <li>Naming<li>
                      <li>Messaging &amp; Copy<li>
                      <li>Campaign Planning<li>
                      <li>Creative Concepting<li>
                      <li>Bid &amp; Grant Writing<li>
                      <li>Workshops<li>
                  </ul>
              </div>
              <div class="col-xs-12 col-sm-3 col-md-3">
                  <ul class="capabilities-list">
                      <li class="capabilities-header">Creative</li>
                      <li>Branding & Identity<li>
                      <li>Advertising<li>
                      <li>Infographics<li>
                      <li>Packaging<li>
                      <li>Film & Photography<li>
                      <li>Web & Digital<li>
                      <li>Environmental Graphics<li>
                      <li>Exhibits<li>
                      <li>Reports & Proposals<li>
                  </ul>
              </div>
             <div class="col-xs-12 col-sm-1 col-md-1"></div>
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
   <div class="container-fluid no-gutter section-content">

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
				 		     $link = get_post_meta($post->ID, '_nectar_link', true); ?>
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
