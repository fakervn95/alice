<?php 
get_header(); 
?>	
<?php echo do_shortcode('[sc_breadcrumb]'); ?>
<div class="g_content">
	<div class="container">
		<div class="row">
			<?php  if(have_posts()) :
				while(have_posts()) : the_post(); ?>
					<div class="col-sm-9 ">
						<article class="content_single_post">
							<div class="single_post_info">
								<h1><?php the_title(); ?></h1>
							</div>
							<div class="text_content">
								<?php  the_content(); ?>
							</div>
						</article>
						<?php $related = get_posts( array( 'post_type'=>'dichvu', 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 6, 'post__not_in' => array($post->ID) ) ); ?>
						<?php if($related){ ?>
							<div class="related_posts">
								<h2><?php if(get_locale() == 'vi'){ echo 'Tin cùng chuyên m?c'; }else { echo 'Related post';} ?></h2>
								<ul class="row"> 
									<?php

									if( $related ) foreach( $related as $post ) {
										?>
										<?php  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $size='large' );  ?>
										<li class="col-sm-4">
											<div class="list_item_rltp pw">
												<figure class="bg_f" style="background:url('<?php echo $image[0]; ?>');"><a href="<?php the_permalink(); ?>"></a></figure>
												<h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
											</div>

										</li>

									<?php }
									wp_reset_postdata(); ?>
								</ul>   
							</div>
						<?php } ?> 
					</div>
					<?php if(!wp_is_mobile()){ ?>
					<div class="col-sm-3 tg_sidebar">
						<?php echo do_shortcode('[sc_sbpost]'); ?>
					</div>
					<?php } ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					<?php else: echo 'No data'; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>



		<?php get_footer(); ?>


