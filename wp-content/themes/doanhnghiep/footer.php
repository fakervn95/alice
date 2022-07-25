<footer class="footer">
	<div class="container">
		<?php
		if(get_locale()== 'vi'){
			$post_id = 85; 
		}else{
			$post_id = 504; 
		}
		
		
		if ( class_exists( 'SiteOrigin_Panels' ) && get_post_meta( $post_id, 'panels_data', true ) ) {
			echo SiteOrigin_Panels::renderer()->render( $post_id );
		} else {
			echo apply_filters( 'the_content', get_post( $post_id )->post_content );
		}
		?>
	</div>
	<div class="scrolltop">
		<img src="<?php echo BASE_URL; ?>/images/scrolltop_img.png ">
	</div>
</footer>

<div class="popup popup_regis ">
	<div class="content_popup">
		<div class="col-sm-6">
			<div class="wrap_svg">
				<figure><img src="<?php echo BASE_URL; ?>/images/img_envelope.jpg"></figure>
			</div>
		</div>
		<div class="col-sm-6">
			<?php if(get_locale()=='vi'){ echo do_shortcode('[contact-form-7 id="811" title="Form contact popup"]'); } else { echo do_shortcode('[contact-form-7 id="845" title="Form contact popup En"]'); } ?>
		</div>
		<div class="close_popup" data-dismiss="modal"><img src="<?php echo BASE_URL; ?>/images/icon_close_pop.png"></div>

	</div>
</div>
<div class="qr_teamkim">
	<figure><a href="https://teamkim.floify.com/r/alice-nguyen?fbclid=IwAR00TEO2X3LfxzmkazZSFPKeIHmhVHM2WKSwcBQ0iwufo-ctOPxjywCBkUE" target="_blank"><img src="<?php echo BASE_URL; ?>/images/qr.png"></a><span><?php if(get_locale() == 'vi'){ echo 'QR của tôi'; }else { echo 'Our QR'; }?></span></figure>
</div>
<div class="review_alice">
	<div class="textwidget">
		<figure><img src="<?php echo BASE_URL; ?>/images/review_us.png"></figure>
	<span><?php if(get_locale() == 'vi'){ ?> Đánh giá <em>dịch vụ</em> <?php }else { echo 'Review us'; }?> </span>
	</div>
	<div class="share_social">        
		
    </div>
</div>
<script type="text/javascript">
jQuery(document).on('click', '.review_alice .textwidget', function(event) {

   jQuery.ajax({
      url: '<?php echo admin_url('admin-ajax.php'); ?>',
      type: 'post',
      dataType: 'html',
      data: {
         action : 'get_review_home'
      },
      beforeSend: function () {
         //jQuery('#result_pj').html('<div class="loading_spinner"></div>');
      },
      success: function (response) {          
         jQuery('.share_social').html(response);
      }
   });

});

</script>
<?php if(!is_front_page() && !isMobile()){ ?>
<div id="loader" >
	<div class="content_loader"> 
		<div class="logo_load_aft">
			<?php 
			if(has_custom_logo()){
				the_custom_logo();
			}
			else { ?> 
				<h2><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h2>
			<?php } ?>
		</div>
		<div class="wrap_animation_load animation-5">
			<div class="shape shape1"></div>
			<div class="shape shape2"></div>
			<div class="shape shape3"></div>
			<div class="shape shape4"></div>
		</div>
	</div>
</div>
<?php } ?>
<style type="text/css">
.tg_language ul>li:nth-child(2) a::after{
	content: "English";
}
.tg_language ul>li:nth-child(1) a::after{
	content: "Tiếng việt";
}
</style>
<?php wp_footer(); ?>
<script src="<?php echo BASE_URL; ?>/js/wow.min.js"></script>
<script src="<?php echo BASE_URL; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_URL; ?>/js/custom.js"></script>

</body>
</html>
