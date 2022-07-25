<li class="col-sm-4">
	<div class="wrap_inner">
		<div class="wrap_figure">
			<div class="wrap_figure_inner">
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large'); ?>
			<figure class="bg_f" style="background:url('<?php echo $image[0]; ?>')"><a href="<?php the_permalink(); ?>"></a></figure>
			</div>
		</div>
		<div class="info_post">
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo excerpt(20);?></p>
			<a href="#" class="read_m">Xem thêm</a>
		</div>
	</div>
</li>