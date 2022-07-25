<?php 
function shortcode_cnkh(){
	ob_start();
	$arg = array(
		'post_type' => 'review',
		'orderby' => 'date',
		'posts_per_page' => 12
	);
	$query = new WP_Query($arg);
	if($query->have_posts()) : ?>
		<ul class="slide_ctm">
			<?php while($query->have_posts()) : $query->the_post(); ?>
				<li>
					<div class="wrap_cus">
						<?php 
						global $post;
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large');
						?>
						<div class="wrap_figure">
							<figure><img src="<?php echo $image[0]; ?>"></figure>
						</div>
						<div class='star_rate'>
							<figure><img src="<?php echo BASE_URL; ?>/images/five_star.png"></figure>
						</div>
						<h3><?php the_title(); ?></h3>
						<div class="wrap_cus_meta">
							<p><?php echo excerpt(40); ?></p>
						</div>
					</div>
				</li>
			<?php endwhile; 
			wp_reset_postdata();
			?>	
		</ul>
	<?php else: 
		echo 'Sorry, no posts matched your criteria.';
	endif;	
	return ob_get_clean();
}
add_shortcode('sc_cnkh','shortcode_cnkh');
function shortcode_dichvu(){
	ob_start();
	$args = array(
		'taxonomy' => 'chuyen-muc-dichvu',
		'orderby' => 'name',
		'order'   => 'ASC'
	);
	$cats = get_categories($args);
	?>
	<ul class="slide_service">
		<?php foreach($cats as $cat) {
			$args = array(
				'post_type' => 'dichvu',
				'tax_query' => array(
					array(
						'taxonomy' => 'chuyen-muc-dichvu',
						'field' => 'term_id',
						'terms' => $cat->term_id
					)
				)
			);
			$query = new WP_Query( $args );;
			if($query->have_posts()) : ?>
				<?php while($query->have_posts()) : $query->the_post(); ?>
					<li>
						<div class="wrap_cus">
							<?php 
							global $post;
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large');
							?>
							<div class="wrap_figure">
								<figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>"></a></figure>
							</div>
							<div class="textwidget">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<em><?php if(get_locale() == 'vi'){ echo 'Dịch vụ'; }else{ echo ''; }?>  <?php echo $cat->name; ?> <?php if(get_locale() == 'en_US'){ echo 'services';} else { echo '';} ?></em>
								<div class="wrap_cus_meta">
									<?php the_excerpt(25); ?>
								</div>
								<div class="btn_pop_lichhen">
									<a href="#"><?php if(get_locale() == 'vi'){ echo 'Đặt lịch hẹn'; }else{ echo 'Appointment'; } ?></a>
								</div>
							</div>
						</div>
					</li>
				<?php endwhile; 
				wp_reset_postdata();
				?>	
				<?php else: echo 'Sorry, no posts matched your criteria.';
				endif;	
			} ?>
		</ul>
		<?php
		return ob_get_clean();
	}
	add_shortcode('sc_dvu','shortcode_dichvu');
	function shortcode_social(){
		ob_start();
		?>
		<?php if(get_option('fb_link') || get_option('insta_link')  || get_option('google_link') || get_option('ytb_link') ){ ?>	
			<div class="social_hd">
				<ul>
					<?php if(get_option('fb_link')){ ?>
						<li><a href="<?php  echo get_option('fb_link'); ?>" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li> 
					<?php } ?>
					<?php if(get_option('insta_link')){ ?>
						<li><a href="<?php echo get_option('insta_link');  ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li> 
					<?php } ?>
					<?php if(get_option('ytb_link') ){ ?>
						<li><a href="<?php  echo get_option('ytb_link');  ?>" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li> 
					<?php } ?>
					<?php if(get_option('google_link') ){ ?>
						<li><a href="<?php  echo get_option('google_link');  ?>" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li> 
					<?php } ?>
				</ul>
			</div>
		<?php }?>	
		<?php
		return ob_get_clean();
	}
	add_shortcode('sc_social','shortcode_social');
	function shortcode_bc(){
		ob_start();
		?>
		<div class="bg_breadcrumb" style="background:url(<?php echo BASE_URL;  ?>/images/bg_breadcrumb.jpg)">
			<div class="container">
				<div class="breadcrumb">
					<h2><?php echo "ALICE VAN NGUYEN"; ?></h2>
					<ul>
						<?php echo the_breadcrumb(); ?>
					</ul>
				</div>
			</div>
		</div>	
		<?php
		return ob_get_clean();
	}
	add_shortcode('sc_breadcrumb','shortcode_bc');
	function shortcode_sbpost(){
		ob_start();
		?>
		<?php 
		$arg = array(
			'post_type'=>'post',
			'orderby' => 'date',
			'posts_per_page' => 6
		);
		$query_new_post = new WP_Query($arg);
		if($query_new_post->have_posts()) : ?>
			<div class="wrap_ct_sb">
				<h3>Tin tức nổi bật</h3>
				<ul class="list_post_sb">
					<?php while($query_new_post->have_posts()) : $query_new_post->the_post(); ?>
						<li>
							<?php 
							global $post;
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'thumbnail');
							?>
							<div class="wrap_figure">
								<figure class="bg_f" style="background:url('<?php echo $image[0]; ?>')"><a href="<?php the_permalink(); ?>"></a></figure>
							</div>
							<div class="textwidget">
								<span><?php the_time('d/m/Y'); ?></span>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php wp_reset_postdata(); ?>
			<?php else: echo 'No data';  ?>
			<?php endif; ?>
			<?php
			return ob_get_clean();
		}
		add_shortcode('sc_sbpost','shortcode_sbpost');
		function shortcode_phone_social(){
			ob_start();
			?>
			<div class="sc_phone_social">
				<?php if(get_option('phone')){ ?>
					<div class="phone_global">		
						<a href="#"><?php echo get_option('phone'); ?></a>
					</div>
				<?php }?>
				<div class="social_hd">
					<ul>
						<?php if(get_option('fb_link')){ ?>
							<li><a href="<?php  echo get_option('fb_link'); ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/icon-fb-gtpage.png"></a></li> 
						<?php } ?>

						<?php if(get_option('ytb_link') ){ ?>
							<li><a href="<?php  echo get_option('ytb_link');  ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/icon-ytb-gtpage.png"></a></li> 
						<?php } ?>

					</ul>
				</div>
			</div>
			
			<?php
			return ob_get_clean();
		}
		add_shortcode('sc_p_social','shortcode_phone_social');
		function shortcode_phone_btnct(){
			ob_start();
			?>
			<div class="phone_global">
				<?php if(get_option('phone')){ ?>
					<a href="#" class="about_btn about_sdt_btn"><?php echo get_option('phone'); ?></a>
				<?php }?>
				<a href="#" class="about_btn about_lh_btn"><?php if(get_locale() == 'vi'){ echo 'Liên hệ ngay'; }else { echo 'Appointment'; } ?></a>
			</div>
			
			<?php
			return ob_get_clean();
		}
		add_shortcode('sc_p_btn','shortcode_phone_btnct');
		function shortcode_houses(){
			ob_start();
			?>
			<div class="grid">
				<?php  if(!wp_is_mobile()){ ?>
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>
					<?php } ?>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project8.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project2.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project3.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project4.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project5.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project6.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project7.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project1.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project9.jpg"></figure></div>
						</div>
					</div>
				</div>
					<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project10.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project11.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project12.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project13.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project14.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project15.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project16.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project17.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project18.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project19.jpg"></figure></div>
						</div>
					</div>
				</div>
				<div class="grid-item">
					<div class="inner_cnkh">
						<div class="pd_inner_cnkh">
							<div class="wrap_figure"><figure><img src="<?php echo BASE_URL; ?>/images/home-project20.jpg"></figure></div>
						</div>
					</div>
				</div>
			</div>
			
			<?php
			return ob_get_clean();
		}
		add_shortcode('sc_houses','shortcode_houses');
