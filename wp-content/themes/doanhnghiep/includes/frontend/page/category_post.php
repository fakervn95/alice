<?php 
if(have_posts()) :
	while (have_posts()) : the_post() ; ?>
		<div class="container">
			<article class="post page">
				<?php if(has_children() OR $post->post_parent>0) { ?>


				<nav class="short_nav">
					<span class="parent-link"><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?></a></span>
					<ul>
						<?php $args = array(
							'child_of' => get_top_ancestor_id(),
							'title_li' => ''
						)
						?>
						<?php wp_list_pages($args);?>
				
					</ul>
				</nav>
			<?php } ?> 
			<div class="list_post">
			
			<?php 
			$loop_post = new WP_Query('post_per_page=3');
			if($loop_post->have_posts()):
				while($loop_post->have_posts()):
					$loop_post -> the_post();?>
					<div class="list_post_item" >
						<figure class="thumbnail"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a> </figure>
						<div class="post_wrapper">
							<h2><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="post_meta">
								<p><?php the_time('d/m/y');?><span>  <?php the_time('g:i a') ?></span> | by <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>"><?php the_author(); ?></a>
									| Posted in
									<?php 
									$categories = get_the_category();
									$seperator = ", ";
									$output = '';
									if($categories){
										foreach ($categories as $category){
											$output .= '<a href="' . get_category_link($category->term_id) . '"> '. $category-> cat_name . ' </a>' .  $seperator;

										}
										echo trim($output , $seperator);
									}
									?>
								</p>
							</div>
							<div class="excerpt">
								<?php 
								if($post->post_excerpt){ ?>
									<p><?php echo get_the_excerpt(); ?></p>
									<a href="<?php echo the_permalink(); ?>">Read more&raquo; </a>
								<?php } else{
									the_content();
								} 
								?>	
							</div>
						</div>


				


				<?php endwhile;
			else:
			endif;
			wp_reset_postdata();
			?>
				</div>
			</article>
		</div>  <!-- container -->
	<?php endwhile;
else : 
	echo '<h2> No content found</h2>';
endif;	