<?php 
/*
Template Name: page-template-fullwidth
*/
get_header(); 
?>

	<div class="g_content">
		<?php echo do_shortcode('[sc_breadcrumb]'); ?>

						<?php 
						if(have_posts()) :
							while(have_posts()) : the_post();
								the_content();
							endwhile;
						endif;
						?>

	</div>

<?php get_footer(); ?>