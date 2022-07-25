<?php get_header(); ?>

	<div class="g_content">
		<?php echo do_shortcode('[sc_breadcrumb]'); ?>
		<div class="container">
						<?php 
						if(have_posts()) :
							while(have_posts()) : the_post();
								the_content();
							endwhile;
						endif;
						?>
		</div><!-- container -->
	</div>

<?php get_footer(); ?>