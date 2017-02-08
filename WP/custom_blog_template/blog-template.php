<?php
  /*
   * Template Name: Blog Template
   */
get_header(); ?>

	<div id="primary" class="site-content">
		<div class="wrap grid" id="content" role="main">
			<div class="unit w-2-3 page-content-grid">

      <?php

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type'      => 'post', // You can add a custom post type if you like
			'paged'          => $paged,
			'posts_per_page' => 10
		);
		query_posts($args);  
				
		while (have_posts() ) {
		the_post();
		?>

		<div class="wrap grid blog-page">
			<div class="unit p30 ">
			<?php if ( has_post_thumbnail() ) {?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
					<?php echo '<img title="'.get_the_title().'" alt="'.get_the_title().'" class="wp-post-image" src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'" width="100%" height="auto" />';?>
				</a>
			<?php } ?>		
			</div>
			<div class="unit p70 ">
				<div class="blog-post">
					<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<!--<p class="blog-post-meta">
						<i class="fa fa-pencil" aria-hidden="true"></i>
							<a href="#">
								<?php the_author(); ?>
							</a>
						&nbsp;&nbsp;<i class="fa fa-calendar" aria-hidden="true"></i>
						<?php echo get_the_date(); ?>
					</p>-->

					<article class="blog-content"><?php the_excerpt(); ?></article>

					<div class="btn-read-more">
						<a class="btn btn-green" href="<?php the_permalink(); ?>">Read More</a>
					</div>
				</div>
			<!-- /.blog-post -->
			</div>
		<!-- /.columns -->
		</div>
		<!-- /.row -->

		<?php 
		}
			my_pagination(); 
			wp_reset_postdata();
		?>			
			
			</div>
			<div class="unit w-1-3 sidebar-grid">
				<?php get_sidebar(); ?>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>





