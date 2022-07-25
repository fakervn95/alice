<?php 
/*
Template Name: page-template-lienhe
*/
get_header(); 
?>	

<div class="page-wrapper">
	<div class="g_content">
		<?php 
		global $post;
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
		//print_r($image);
		?>
		<div class="breadcrumb">
			<div class="container">
				<?php the_breadcrumb(); ?>
			</div>
		</div>
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
</div>
<?php get_footer(); ?>