<?php
/*template name: Work */
get_header();

$options = get_option('salient');

?>

<!-- Uncomment to enable header slider content on work page -->
<?php //echo nectar_page_header($post->ID); ?>

<div class="home-page">

	<div class="container-fluid section-content">

        <?php if (have_posts()) : while(have_posts()) : the_post(); ?>

        <!-- Lead in -->
        <div class="row page-leadin">
            <div class="col-xs-1 col-sm-2 col-md-3"></div>
            <div class="col-xs-10 col-sm-8 col-md-6">
                <?php echo get_post_meta($post->ID, '_nectar_header_subtitle', true); ?>
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
                <h2>
                    <?php echo get_post_meta($post->ID, '_nectar_header_title', true); ?>
                </h2>
            </div>
            <div class="col-md-5"></div>
        </div>

        <?php endwhile; endif; wp_reset_postdata(); ?>

		<?php
            // Get the portfolio posts
            $portfolio = array(
                'post_type' => 'portfolio',
                'project-type'=> ['team'],
                'posts_per_page' => -1,
                'meta_key'=>'grid_order',
                'orderby' => 'meta_value_num',
                'order' => 'ASC'
			);

			$wp_query = new WP_Query($portfolio);
        ?>

		<div class="team-grid-item__container">
		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <!-- Portfolio grid item -->
            <div class="team-grid-item">


				<?php $attachments = new Attachments( 'wh_team_headshots' ); ?>
				<?php if( $attachments->exist() ) : ?>
					<?php while( $attachments->get() ) : ?>
						<img class="team-grid-thumbnail" src="<?php echo $attachments->src('full'); ?>">
					<?php endwhile; ?>
				<?php endif; ?>

				<!-- <img class="team-grid-thumbnail" src="<?php the_post_thumbnail_url(); ?>"> -->
				<div class="team-meta__container">
					<h3 class="title"><?php the_title(); ?></h3>
					<h4 class="team-position"><?php echo get_post_meta($post->ID, '_nectar_portfolio_item_subtitle', true); ?></h4>
					<p class=""><?php the_content(); ?></p>
				</div>
            </div><!--work-item-->
		<?php endwhile; endif; ?>
		</div>

   </div><!-- /container (portfolio-wrap) -->


</div><!-- /home-page -->

<?php get_footer(); ?>
