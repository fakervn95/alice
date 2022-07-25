<?php
add_action('admin_menu', 'ch_essentials_admin');
function ch_essentials_admin() {
    // Header Option
	register_setting('zang-settings-header', 'phone');
	register_setting('zang-settings-header', 'phone_second');
	register_setting('zang-settings-header', 'mail_hd');
	register_setting('zang-settings-header', 'address_hd');
	register_setting('zang-settings-header', 'meta_des');
	register_setting('zang-settings-header', 'meta_key');
	// Social Option
	register_setting('zang-settings-socials', 'fb_link');
	register_setting('zang-settings-socials', 'insta_link');
	register_setting('zang-settings-socials', 'google_link');
	register_setting('zang-settings-socials', 'ytb_link');
	/* Base Menu */
	add_menu_page('Theme Option','Dona Framework','manage_options','template_admin_zang','zang_theme_create_page',get_template_directory_uri() . '/images/dona-icon.png',110);
}
add_action('admin_init', 'zang_custom_settings');
function zang_custom_settings() { 
	/* Header Options Section */
	add_settings_section('zang-header-options', 'Chỉnh sửa header','zang_header_options_callback','zang-settings-header' );
	add_settings_field('phone-hd','Số điện thoại', 'zang_phone_header','zang-settings-header', 'zang-header-options');
	add_settings_field('phone-second','Số điện thoại 2', 'zang_phone_second','zang-settings-header', 'zang-header-options');
	add_settings_field('email-hd','Email', 'zang_mail_hd','zang-settings-header', 'zang-header-options');
	add_settings_field('address_hd','Địa chỉ', 'zang_address_first','zang-settings-header', 'zang-header-options');
	add_settings_field('meta-des','Meta Description', 'zang_meta_des','zang-settings-header', 'zang-header-options');
	add_settings_field('meta-key','Meta Keyword', 'zang_meta_key','zang-settings-header', 'zang-header-options');
	/* Social Options Section */
	add_settings_section('zang-social-options','Chỉnh sửa social','zang_social_options_callback','zang-settings-socials' );
	add_settings_field('facebook','Facebook Link ', 'zang_fb_link','zang-settings-socials', 'zang-social-options');
	add_settings_field('insta','insta Link', 'zang_insta_link','zang-settings-socials', 'zang-social-options');
	add_settings_field('google','Google Link', 'zang_google_link','zang-settings-socials', 'zang-social-options');
	add_settings_field('youtube','Youtube Link', 'zang_ytb_link','zang-settings-socials', 'zang-social-options');
}
function zang_header_options_callback(){
	echo '';
}
function zang_social_options_callback(){
	echo '';
}
function zang_commit_options_callback(){
	echo '';
}
function zang_phone_header(){
	$phone = esc_attr(get_option('phone'));
	echo '<input type="text" class="iptext_adm" name="phone" value="'.$phone.'" >';
}
function zang_phone_second(){
	$phone_second = esc_attr(get_option('phone_second'));
	echo '<input type="text" class="iptext_adm" name="phone_second" value="'.$phone_second.'" >';
}
function zang_mail_hd(){
	$mail_hd = esc_attr(get_option('mail_hd'));
	echo '<input type="text" class="iptext_adm" name="mail_hd" value="'.$mail_hd.'" placeholder="" ';
}
function zang_hotline(){
	$hotline = esc_attr(get_option('hotline'));
	echo '<input type="text" class="iptext_adm" name="hotline" value="'.$hotline.'" placeholder="" ';
}
function zang_address_first(){
	$address_hd = esc_attr(get_option('address_hd'));
	echo '<input type="text" class="iptext_adm" name="address_hd" value="'.$address_hd.'" placeholder="" ';
}
function zang_meta_des(){
	$meta_des = esc_attr(get_option('meta_des'));
	echo '<textarea  class="iptext_adm" name="meta_des" value="'.$meta_des.'" > '.$meta_des.' </textarea> ';
}
function zang_meta_key(){
	$meta_key = esc_attr(get_option('meta_key'));
	echo '<textarea  class="iptext_adm" name="meta_key" value="'.$meta_key.'" >'.$meta_key.'</textarea> ';
}
function zang_fb_link(){
	$fb_link = esc_attr(get_option('fb_link'));
	echo '<input type="text" class="iptext_adm" name="fb_link" value="'.$fb_link.'" placeholder="" ';
}
function zang_insta_link(){
	$insta_link = esc_attr(get_option('insta_link'));
	echo '<input type="text" class="iptext_adm" name="insta_link" value="'.$insta_link.'" placeholder="" ';
}
function zang_google_link(){
	$google_link = esc_attr(get_option('google_link'));
	echo '<input type="text" class="iptext_adm" name="google_link" value="'.$google_link.'" placeholder="" ';
}
function zang_ytb_link(){
	$ytb_link = esc_attr(get_option('ytb_link'));
	echo '<input type="text" class="iptext_adm" name="ytb_link" value="'.$ytb_link.'" placeholder="" ';
}
function myshortcode(){
	ob_start();
	if(get_option('fb_link')  || get_option('footer_fb_jp') || get_option('footer_ytb') ){
		?>
		<ul class="social_ft">
			<?php if(get_option('fb_link') || get_option('footer_fb_jp') ){ ?>
				<li><a href="<?php if(get_locale()=='vi'){ echo get_option('fb_link');}else{ echo get_option('footer_fb_jp'); } ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/icon_facebook_hd.png"></a></li> 
			<?php } ?>
			<?php if(get_option('footer_ytb')){ ?>
				<li><a href="<?php echo get_option('fb_link'); ?>" target="_blank"><img src="<?php echo BASE_URL; ?>/images/icon_ytb_hd.png"></a></li> 
			<?php } ?>
		</ul>	
		<?php
	}
	return ob_get_clean();
}
add_shortcode('social_ft','myshortcode');
function shortcode_news(){
	ob_start();
	$arg = array(
		'post_type' => 'post',
		'orderby' => 'date',
		'posts_per_page' => 6
	);
	$query = new WP_Query($arg);
	if($query->have_posts()) : ?>
		<ul class="row">
			<?php while($query->have_posts()) : $query->the_post(); ?>
				<?php 
				global $post;
				$categories = get_the_category(); 
				$cat_name = $categories[0]->cat_name;
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$size = 'large')
				?>
				<li class="pw col-sm-4">
					<div class="wrap_figure">
						<figure class="tg_figure" style="background:url('<?php echo $image[0]; ?>')"><a href="<?php the_permalink(); ?>"></a></figure>
						<strong><?php the_time('d'); ?></strong>
						<span><?php the_time('m/Y'); ?></span>
					</div>
					
					<div class="textwidget">
						<span class="tg_cat_post"><?php echo $cat_name; ?></span>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php if(has_excerpt()) {  ?>
							<div class="tg_excerpt">
								<p><?php echo excerpt(24); ?></p>
							</div>
						<?php }else { echo 'Not have excerpt'; }?>
						<div class="post_rm">
							<a href="<?php the_permalink(); ?>">Xem tiếp > </a>
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
add_shortcode('sc_news','shortcode_news');
function shortcode_duan(){
	ob_start();
	$arg = array(
		'post_type' => 'duan',
		'orderby' => 'date',
		'posts_per_page' => 9
	);
	$query = new WP_Query($arg);
	if($query->have_posts()) : ?>
		<ul class="row list_pj">
			<?php while($query->have_posts()) : $query->the_post(); ?>
				<?php 
				global $post;
				$diachi = get_post_meta( $post->ID, '_diachi', true );
				$dientich = get_post_meta( $post->ID, '_dientich', true );
				$giaban = get_post_meta( $post->ID, '_giaban', true );
				$sopn = get_post_meta( $post->ID, '_sopn', true );
				$sowc = get_post_meta( $post->ID, '_sowc', true );
				$trangthai = get_post_meta( $post->ID, '_trangthai', true );
				?>
				<li class="col-sm-4 pw">
					<?php 
					global $post;
					$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large');
					?>
					<div class="wrap_figure">
						<figure class="tg_figure" style="background:url('<?php echo $image[0]; ?>')"><a href="<?php the_permalink(); ?>"></a></figure>
						<span class="status_pj"><?php echo $trangthai; ?></span>
						<strong class="logo_mini"><img src="<?php echo BASE_URL; ?>/images/icon_logo_project.png"></strong>
						<div class="title_adr">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<p><?php echo $diachi; ?></p>
						</div>
					</div>
					<div class="wrap_project_meta">
						<div class="project_meta">
							<div class="excerpt_pj">
								<?php echo excerpt(15); ?>
							</div>
							<ul>
								<li><?php echo $dientich; ?> m2</li>
								<li><?php echo $sopn; ?></li>
								<li><?php echo $sowc; ?></li>
							</ul>
						</div>
						<div class="price_detail_pj">
							<em><?php echo $giaban; ?></em>
							<em><a href="<?php the_permalink(); ?>">Xem chi tiết</a></em>
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
add_shortcode('sc_project','shortcode_duan');


function shortcode_doitac(){
	ob_start();
	$arg = array(
		'post_type' => 'doitac',
		'orderby' => 'date',
		'posts_per_page' => -1
	);
	$query = new WP_Query($arg);
	if($query->have_posts()) : ?>
		<ul class="list_doitac">
			<?php while($query->have_posts()) : $query->the_post(); ?>
				<li class="pw">
					<?php 
					global $post;
					$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large');
					?>
					<div class="wrap_figure">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
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
add_shortcode('sc_doitac','shortcode_doitac');

function shortcode_linhvuchd(){
	ob_start();
	$arg = array(
		'post_type' => 'linhvuchd',
		'orderby' => 'date',
		'posts_per_page' => -1
	);
	$query = new WP_Query($arg);
	if($query->have_posts()) : ?>
		<ul class="list_linhvuchd">
			<?php while($query->have_posts()) : $query->the_post(); ?>
				<li class="pw">
					<?php 
					global $post;
					$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large');
					?>
					<div class="wrap_figure">
						<figure class="thumbnail" style="background:url('<?php echo $image[0]; ?>')"></figure>
					</div>
					<h2><?php the_title(); ?></h2>
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
add_shortcode('sc_linhvuchd','shortcode_linhvuchd');

function shortcode_gallery_singlepost(){
	ob_start();
	$arg = array(
		'post_type' => 'duan',
		'orderby' => 'date',
		'posts_per_page' => 30
	);
	$query_gallery = new WP_Query($arg);
	if($query_gallery->have_posts()) : ?>
		<ul class="project_gallery">
			<?php while($query_gallery->have_posts()) : $query_gallery->the_post(); ?>
				<?php 
				global $post;
				$images = get_post_meta($post->ID, '_tdc_gallery_id', true);
				if($images){
					?>

					<?php foreach ($images as $image) {
						?>
						<li>
							<figure class="thumbnail" style="background:url('<?php echo wp_get_attachment_url($image, 'large'); ?>')">
								<a href="<?php echo wp_get_attachment_url($image, 'large'); ?>" data-fancybox="images" class="fancybox" >
									<img src="<?php echo wp_get_attachment_url($image, 'large'); ?>">
									<div class="border-wrap"></div>
									<div class="img_plus"><img src="<?php echo BASE_URL; ?>/images/icon_plus_thin.png" alt="icon"></div>
								</a>
							</figure>
							</li> <?php
						} ?>
					<?php } ?>
				<?php endwhile; ?>
			</ul>
			<?php wp_reset_postdata();?>	
		<?php else: 
			echo 'Sorry, no posts matched your criteria.';
		endif;	
		return ob_get_clean();
	}
	add_shortcode('sc_gallery_singlepost','shortcode_gallery_singlepost');

	function shortcode_hangmuc_menu(){
		ob_start(); ?>
		<div class="hangmuc_list">
			<div class="wrap_hangmuclist">
				<h4>Hạng mục</h4>
				<ul class="tg_tab_project">
					<?php 
					$wcatTerms = get_terms('category_hangmuc', 
						array('hide_empty' => 0, 'number' => 20, 'order' =>'asc', 'parent' =>0,'orderby'=>'menu_order')
					);
					?>
					<?php foreach($wcatTerms as $wcatTerm) : 
						?>
						<li>
							<div class="textwidget">
								<figure></figure>
								<p><?php echo $wcatTerm->name; ?></p>
							</div>
							<a href="<?php echo get_term_link( $wcatTerm->slug, $wcatTerm->taxonomy ) ?>" ></a>
						</li>
						<?php wp_reset_postdata(); ?> 
					<?php endforeach;  ?>
				</ul>
			</div>

		</div>
		<?php return ob_get_clean();
	}
	add_shortcode('sc_hangmuc_menu','shortcode_hangmuc_menu');

	function shortcode_duan_sb(){
		ob_start(); ?>
		<?php 
		$arg = array(
			'post_type'=>'hangmuc',
			'orderby' => 'date',
			'posts_per_page' => 5
		);
		$query_hangmuc = new WP_Query($arg);
		if($query_hangmuc->have_posts()) : ?>
			<div class="wrap_ct_sb">
				<h3>Các dự án khác</h3>
				<ul class="list_pj">
					<?php while($query_hangmuc->have_posts()) : $query_hangmuc->the_post(); ?>
						<?php 
						global $post;
						$dientich = get_post_meta( $post->ID, '_dientich', true );
						$sopn = get_post_meta( $post->ID, '_sopn', true );
						$cityname = get_post_meta( $post->ID, 'cityname',true );
						?>
						<li>
							<?php 
							global $post;
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'thumbnail');
							?>
							<div class="wrap_figure">
								<figure class="bg_f" style="background:url('<?php echo $image[0]; ?>')"><a href="<?php the_permalink(); ?>"></a></figure>
							</div>
							<div class="wrap_project_meta">
								<div class="project_meta">
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
									<ul>
										<li><?php if($cityname){echo $cityname;}else{ echo 'No data';} ?></li>
										<li><?php if($dientich){echo $dientich;}else{ echo 'No data';} ?></li>
										<li><?php if($sopn){echo $sopn;}else{ echo 'No data';}?></li>
									</ul>
								</div>
							</div>

						</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php wp_reset_postdata(); ?>
			<?php else: echo 'No data';  ?>
			<?php endif; ?>
			<?php return ob_get_clean();
		}
		add_shortcode('sc_duan_sb','shortcode_duan_sb');

		function shortcode_newpost_sb(){
			ob_start(); ?>
			<?php 
			$arg = array(
				'post_type'=>'post',
				'orderby' => 'date',
				'posts_per_page' => 5
			);
			$query_new_post = new WP_Query($arg);
			if($query_new_post->have_posts()) : ?>
				<div class="wrap_ct_sb">
					<h3>Tin tức mới nhất</h3>
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
				<?php return ob_get_clean();
			}
			add_shortcode('sc_news_sb','shortcode_newpost_sb');
/* Display Page
-----------------------------------------------------------------*/
function zang_theme_create_page() {
	?>
	<div class="wrap">  
		<?php settings_errors(); ?>  
		<?php  
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'header_page_options';  
		?>  
		<ul class="nav-tab-wrapper"> 
			<li><a href="?page=template_admin_zang&tab=header_page_options" class="nav-tab <?php echo $active_tab == 'header_page_options' ? 'nav-tab-active' : ''; ?>">Header</a> </li>
			<li><a href="?page=template_admin_zang&tab=social_page_options" class="nav-tab <?php echo $active_tab == 'social_page_options' ? 'nav-tab-active' : ''; ?>">Social</a></li>	 
		</ul>  
		<form method="post" action="options.php">  
			<?php 
			if( $active_tab == 'header_page_options' ) {  
				settings_fields( 'zang-settings-header' );
				do_settings_sections( 'zang-settings-header' ); 
			} else if( $active_tab == 'social_page_options' ) {
				settings_fields( 'zang-settings-socials' );
				do_settings_sections( 'zang-settings-socials' ); 
			}
			?>             
			<?php submit_button(); ?>  
		</form> 
	</div> 
	<?php
}
