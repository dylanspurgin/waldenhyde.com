<?php get_header(); ?>

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

		<div class="row">
            <div class="col-xs-12">
                <?php the_content(); ?>
            </div>
		</div><!--/row-->

	</div><!--/container-->

</div>
<?php get_footer(); ?>
