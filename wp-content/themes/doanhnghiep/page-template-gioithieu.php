<?php 
/*
Template Name: page-template-gioithieu
*/
get_header(); 
?>	

<div class="page-wrapper">
	<div class="g_content">
		<div class="breadcrumb">
			<div class="container">
				<?php the_breadcrumb(); ?>
			</div>
		</div>
		
			<?php 
			if(have_posts()) :
				while(have_posts()) : the_post();
					the_content();
				endwhile;
			endif;
			?>
			
		
	</div>
</div>
<?php get_footer(); ?>