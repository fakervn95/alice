<?php  get_header(); ?>	
<?php echo do_shortcode('[sc_breadcrumb]'); ?>
<div class="g_content">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 content_left">
				<?php if(have_posts()) : ?>
					<ul class="list_post_arc row">
						<?php 
						while(have_posts()): the_post();
							get_template_part('includes/frontend/loop/loop_post');
						endwhile;
						wp_reset_postdata();
						get_template_part('includes/frontend/pagination/pagination');
						?>
					</ul>
					<?php
					else: echo 'No data';
					endif;
					wp_reset_postdata();
					?>
				</div>

			
			</div>
		</div>
	</div>


	<?php get_footer(); ?>


