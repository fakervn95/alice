<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
	<meta name="description" content="<?php if(get_option('meta_des')){echo get_option('meta_des');} ?>" /> 
	<meta name="keywords" content="<?php if(get_option('meta_key')){echo get_option('meta_key');} ?> ">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php if(is_front_page()){echo bloginfo('name');}else{ wp_title('',true,''); } ?></title>
	<!-- css -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/slick.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/animate.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/b-style.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
	<!-- js -->
	<script src="<?php echo BASE_URL; ?>/js/jquery.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/js/masonry.pkgd.min.js"></script>
	<script src="<?php echo BASE_URL; ?>/js/slick.js"></script>
	<?php wp_head(); ?>

</head>


<body <?php body_class() ?>>

	<div class="bg_opacity"></div>

	<div id="menu_mobile_full">
		<nav class="mobile-menu">
			<p class="close_menu"><span><i class="fa fa-times" aria-hidden="true"></i></span></p>
			<?php 
			$args = array('theme_location' => 'menu_mobile');
			?>
			<?php wp_nav_menu($args);?>
		</nav>
	</div>
	
	<header class="header">

		<div class="middle_header">
			<div class="container">
				<span class="icon_mobile_click"><i class="fa fa-bars" aria-hidden="true"></i></span>
				<div class="logo_site">
					<?php 
					if(has_custom_logo()){
						the_custom_logo();
					}
					else { ?> 
						<h2><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h2>
					<?php } ?>
				</div>
				<div class="wrap_menu_hd">
					<div class="top_wrap_menuhd">
						<?php if(get_option('phone')){ ?>
							<div class="phone_hd_mdhd">		
								<div class="textwidget">
									<a href="#"><?php echo get_option('phone'); ?></a>
								</div>	
							</div>
						<?php }?>
						<?php echo do_shortcode('[sc_social]'); ?>
						<div class="tg_language">
						<ul>
							<?php pll_the_languages(array('show_flags'=>1,'show_names'=>0)); ?>
						</ul>

						</div>
					</div>
					<nav class="nav nav_primary">
						<?php 
						$args = array('theme_location' => 'primary');
						?>
						<?php wp_nav_menu($args); ?>
					</nav>

				</div>
			</div>

		</div>
		<?php if(!is_home() && is_front_page()){ ?>
			<?php  
			$arg_slide = array(
				'post_type'=>'slider',
				'post_status'=>'publish',
				'posts_per_page'=> 20,
				'orderby'=>'date',
			);
			$loop_slide = new WP_Query($arg_slide);
			?>
			<div class="tg_banner">
				<ul class="list_banner">	
					<?php 
					while ( $loop_slide->have_posts() ) : $loop_slide->the_post(); 
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($loop_slide->post->ID),$size = 'full');
					?> <li style="background:url('<?php echo $image[0]; ?>')"> 
						<div class="wrap_banner">
							<div class="container">
								<div class="row">
									<div class="col-sm-4">
										<figure><img src="<?php echo BASE_URL; ?>/images/img_alice_vannguyen.png"></figure>
										
									</div>
									<div class="col-sm-8">
										<div class="textwidget">
											<?php the_content(); ?>
											<div class="btns_twg">
												<?php if(get_locale()=='vi'){ ?>	
													<a href="<?php echo get_page_link(48); ?>" class="btn_contact">Liên hệ</a>
													<a href="<?php echo get_page_link(463); ?>">Xem thêm</a>
												<?php } else {?>
													<a href="<?php echo get_page_link(850); ?>" class="btn_contact">Contact me</a>
													<a href="<?php echo get_page_link(833); ?>">Read more</a>
												<?php } ?>
												
											</div>
										</div>
										
									</div>
								</div>
							</div>
							<div class="wrap_figure_banner">
								<span><img src="<?php echo BASE_URL; ?>/images/light1.png"></span>
								<em><img src="<?php echo BASE_URL; ?>/images/light2.png"></em>
								<b><img src="<?php echo BASE_URL; ?>/images/light3.png"></b>
								<cite><img src="<?php echo BASE_URL; ?>/images/shape_dots.png"></cite>
								<ins><img src="<?php echo BASE_URL; ?>/images/shape_dots.png"></ins>
								<del><img src="<?php echo BASE_URL; ?>/images/shape_dots_yellow.png"></del>
							</div>
						</div>
					</li> 

					<?php
				endwhile;
				wp_reset_postdata(); 
				?>
			</ul>	
		</div>
	</div>
<?php } ?>	
</header>