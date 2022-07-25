<?php  get_header(); ?>	
<div class="arc_review_page">
	<?php echo do_shortcode('[sc_breadcrumb]'); ?>
	<div class="g_content">
		<?php 
		$arg= array(
			'post_type' => 'review',
			'post_status' => 'publish',
			'posts_per_page' => 20,
			'orderby' => 'date'
		); 
		$query_cnkh = new WP_Query($arg);
		?>
		<?php if($query_cnkh->have_posts()):?>
			<div class="success_story">
				<div class="container">
					<h3 class="widget-title"><?php if(get_locale() == 'vi'){ echo 'Những câu chuyện thành công';} else { echo 'Successful stories'; } ?></h3>
					<div class="grid tgcol-4 ">
						<?php  if(!wp_is_mobile()){ ?>
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>
					<?php } ?>
							<?php while($query_cnkh->have_posts()) : $query_cnkh->the_post(); ?>
								<?php 
								$ft_post_ex[] = $post->ID; // add post id to array 
								?>  
								<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail');?>
								<div class="grid-item">
									<div class="inner_cnkh">
										<div class="pd_inner_cnkh">
											<div class="wrap_figure">
												<figure>
													<img src="<?php echo $image[0]; ?>">
												</figure>
											</div>
											<div class="textwidget">
												<h4><?php the_title(); ?></h4>
												<figure><img src="<?php echo BASE_URL; ?>/images/five_star.png"></figure>
											</div>
											<div class="tg_excerpt">
												<?php the_content(); ?>
											</div>
										</div>

									</div>
								</div>
							<?php endwhile;?>
					</div>
				</div>
				<div class="tg_loading"></div>
			
				<button id="more_posts">Load More</button>
			
			</div>

		<?php endif; ?>	

	</div>
</div>
<script type="text/javascript">
var ppp = 20; // Post per page
var pageNumber = 1;

function load_posts(){
    pageNumber++;

    $.ajax({
        type: "POST",
        dataType: "html",
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
         data: {
         action : 'more_post_ajax',
         pageNumber: pageNumber,
         ppp : ppp
      },
         beforeSend: function () {
         jQuery('.tg_loading').append('<div class="loading_spinner"></div>');
      	},
        success: function(data){
            var $data = $(data);
            if($data.length){
            	jQuery('.loading_spinner').remove();
                 $('.success_story .grid').masonry().append( $data ).masonry( 'appended', $data ).masonry();
                 $(".success_story .grid").masonry( 'reloadItems' );
                $("#more_posts").attr("disabled",false);
            } else{
            	jQuery('.loading_spinner').remove();
                $("#more_posts").remove();
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

$("#more_posts").on("click",function(){ // When btn is pressed.
    $("#more_posts").attr("disabled",true); // Disable the button, temp.
    load_posts();
});
</script>

<?php get_footer(); ?>


