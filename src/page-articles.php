<?php
/*template name: Articles */
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


<!-- Uncomment to enable header slider content -->
<?php //echo nectar_page_header($post->ID); ?>

<div class="home-page">

    <!-- Articles page -->
	<div class="container-fluid section-content">

        <?php if (have_posts()) : while(have_posts()) : the_post(); ?>

        <!-- Lead in -->
        <div class="row home--section-lead-in">
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

        <?php endwhile; endif; wp_reset_query(); ?>

		<?php
            // Get the articles posts
            $page = get_query_var('paged', 1);
            $args = array(
                'post_type' => 'post',
                'category_name'=> 'homepage article',
                'paged'=> $page,
                'posts_per_page'=> 3
            );
            $query = new WP_Query($args);
        ?>

        <div class="articles-grid">
            <div class="row">
            <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    $link = get_permalink($post->ID);
                    $index = $query->current_post+1;
                ?>
                <div class="article-grid-item col-xs-12 col-sm-4">
     			   <div class="article-image" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
     			   </div>
                    <h2 class="article-title">
     							   <a class="read-link" href="<?php echo $link ?>">
                        <?php echo the_title() ?>
     								 </a>
                    </h2>
                    <p class="article-excerpt">
                        <?php echo $post->post_excerpt ?>
                    </p>
                    <div class="article-source">
                        <?php echo get_post_custom_values('source', $post->ID)[0];?>
                    </div>
                    <a class="read-link" href="<?php echo $link ?>"><strong>READ</strong></a>
                    <br >
     			   <hr>
                </div>
                <?php if ($index%3 == 0) echo '</div><div class="row">'; ?>
    		<?php endwhile; endif; ?>
            </div>
        </div>

        <div class="row wh-pagination">
            <div class="col-xs-6 previous-link">
                <?php echo get_previous_posts_link('<i class="fa fa-long-arrow-left"></i> Newer articles', $query->max_num_pages); ?>
            </div>
            <div class="col-xs-6 next-link">
                <?php echo get_next_posts_link('Older articles <i class="fa fa-long-arrow-right"></i>', $query->max_num_pages); ?>
            </div>
        </div>

   </div><!-- /container-fluid -->


</div><!-- /home-page -->

<?php get_footer(); ?>
