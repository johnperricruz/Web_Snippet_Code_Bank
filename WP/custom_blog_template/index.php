<?php
/**
 * Template Name: Page with Sidebar
 *
 * Description: Twenty Twelve loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 * Tip: to remove the sidebar from all posts and pages simply remove
 * any active widgets from the Main Sidebar area, and the sidebar will
 * disappear everywhere.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
		<div class="banner-page"></div>
		<div id="primary" class="wrap grid">
			<div class="unit w-2-3">	
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="blog-container">
						<div class="wrap grid">
							<div class="unit p30">
								<?php echo '<img title="'.get_the_title().'" alt="'.get_the_title().'" class="wp-post-image" src="'.wp_get_attachment_url( get_post_thumbnail_id() ).'" width="100%" height="auto" />';?>
							</div>
							<div class="unit p70">
								<h2><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
								<p><?php echo substr(get_the_excerpt(), 0,200) ;?>...</p>
									<table>
										<tr>
											<td><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></td>
											<td><a href="<?php echo get_the_permalink(); ?>">Read more</a></td>
										</tr>
									</table>
							</div>
						</div>
					</div>
					<?php comments_template( '', true ); ?>
				<?php endwhile; // end of the loop. ?>			
			</div>
			<div class="sidebar unit w-1-3">	
				<?php get_sidebar(); ?>
			</div>
		</div>
<?php get_footer(); ?>  