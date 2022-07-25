<?php 
get_header(); 
?>	



<div id="content">
	<div class="container">
		<div class="list_post">
			<?php 
			if(have_posts()): ?>
				<h2 class="title_header">Kết quả tìm kiếm : <strong><?php the_search_query(); ?></strong></h2>
				<div class="row">
					<div class="col-sm-12">
						<div class="wrap_loop_search">
							<ul>
							<?php	while(have_posts()): the_post(); ?>

							<?php get_template_part('includes/frontend/loop/loop_search');

						endwhile;
						get_template_part('includes/frontend/pagination/pagination');
					else:
						echo '<h2 class="nofound_title"> No found content</h2>';
					endif;
					wp_reset_postdata();
					?>
					</ul>
						</div>
						
				</div>
				<div class="col-sm-3 sidebar">
			</div>


		</div>

	</div>
</div>


<?php get_footer(); ?>


