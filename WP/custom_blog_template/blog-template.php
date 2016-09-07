<?php
  /*
   * Template Name: Blog Template
   */
get_header(); ?>
<div class="page-title-wrapper"><h1 class="entry-title"><?php the_title(); ?></h1></div>
<div id="primary" class="site-content">
	<div class="wrap grid" id="content" role="main">
		<div class="unit w-2-3 page-content-grid">
			<?php
			$args = array( 
				'posts_per_page' => 5, 
				'category' => 3 
			);
		$posts = get_posts( $args );
		foreach($posts as $post){
		  setup_postdata($post); ?>
			<div class="wrap grid blog-page">
				<div class="unit p100 ">
					<div class="blog-post">
						<?php if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php echo '<img title="'.get_the_title().'" alt="'.get_the_title().'" class="wp-post-image" src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'" width="100%" height="auto" />';?>
							</a>
							<?php } ?>
							<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<p class="blog-post-meta">
									<i class="fa fa-pencil" aria-hidden="true"></i>
									<a href="#">
										<?php the_author(); ?>
									</a>
									&nbsp;&nbsp;<i class="fa fa-calendar" aria-hidden="true"></i>
									<?php echo get_the_date(); ?>
								</p>
								<article class="blog-content"><?php the_excerpt(); ?></article>
								<div class="btn-read-more">
									<a class="btn btn-primary" href="<?php the_permalink(); ?>">Read More</a>
								</div>
								</div>
								<!-- /.news-post -->
							</div>
							<!-- /.columns -->
						</div>
						<!-- /.row -->

						<?php }
		the_posts_navigation();
		wp_reset_postdata();
		my_pagination(); 
?>			
		</div>
		<div class="unit w-1-3 sidebar-grid">
			<?php get_sidebar(); ?>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>





			