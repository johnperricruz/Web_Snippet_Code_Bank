<?php
/*
* Pull Blogpost
*/
	function pull_blog_posts($atts, $content = null){
	   extract(shortcode_atts(array(
		  'posts' => 1,
	   ), $atts));
	   //query_posts(array('orderby' => 'date', 'order' => 'DESC' , 'showposts' => $posts, 'cat' => '5'));
			//if (have_posts()){
				//while (have_posts()) {
					//the_post();
					 //$return_string .= ' '.get_the_post_thumbnail().'<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
					 //$return_string .= '<li>'.get_the_post_thumbnail().'<span>'.get_the_excerpt().'</span></li>';
					//get_permalink()
					//get_the_post_thumbnail( $post_id, 'full' )
					//get_the_title()
					//get_the_time('F j Y')	
				//}
			//}

	   $return_string .= '';

	   wp_reset_query();
	   return $return_string;
	}
	
	add_shortcode('recent-posts', 'pull_blog_posts'); //recent posts