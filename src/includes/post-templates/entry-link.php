<?php
$options = get_option('salient');
global $post;

$masonry_size_pm = get_post_meta($post->ID, '_post_item_masonry_sizing', true);
$masonry_item_sizing = (!empty($masonry_size_pm)) ? $masonry_size_pm : 'regular';
$using_masonry = null;
$masonry_type = (!empty($options['blog_masonry_type'])) ? $options['blog_masonry_type'] : 'classic';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($masonry_item_sizing.' link'); ?>>

	<div class="post-content">

		<?php if( !is_single() ) { ?>

			<div class="post-meta">

				<?php
				global $layout;
				$blog_type = $options['blog_type'];
				?>

				<div class="date">
					<?php
					if(
					$blog_type == 'masonry-blog-sidebar' && substr( $layout, 0, 3 ) != 'std' ||
					$blog_type == 'masonry-blog-fullwidth' && substr( $layout, 0, 3 ) != 'std' ||
					$blog_type == 'masonry-blog-full-screen-width' && substr( $layout, 0, 3 ) != 'std' ||
					$layout == 'masonry-blog-sidebar' || $layout == 'masonry-blog-fullwidth' || $layout == 'masonry-blog-full-screen-width') {
						$using_masonry = true;
						echo get_the_date();
					}
					else { ?>

						<span class="month"><?php the_time('M'); ?></span>
						<span class="day"><?php the_time('d'); ?></span>
						<?php $options = get_option('salient');
						if(!empty($options['display_full_date']) && $options['display_full_date'] == 1) {
							echo '<span class="year">'. get_the_time('Y') .'</span>';
						}
					} ?>
				</div><!--/date-->

				<?php if($using_masonry == true && $masonry_type == 'meta_overlaid') { } else { ?>
					<div class="nectar-love-wrap">
						<?php if( function_exists('nectar_love') ) nectar_love(); ?>
					</div><!--/nectar-love-wrap-->
				<?php } ?>

			</div><!--/post-meta-->

		<?php } ?>

		<div class="content-inner">

            <?php the_content(); ?>

		</div><!--/content-inner-->

	</div><!--/post-content-->

</article><!--/article-->
