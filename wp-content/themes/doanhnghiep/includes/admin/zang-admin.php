<div class="zang_sidebar_option  tg_ct_right_admin">
	<?php settings_errors(); ?>
	<?php 
	$phone = esc_attr(get_option('phone'));
	$address_header = esc_attr(get_option('address_header'));
	$footer_fb = esc_attr(get_option('footer_fb'));
	$footer_twitter = esc_attr(get_option('footer_twitter'));
	$footer_ggplus = esc_attr(get_option('footer_ggplus'));
	$footer_insta = esc_attr(get_option('footer_insta'));
	?>
	<form method="post" action="options.php" class="zang-general-form"> 
		<?php settings_fields('zang-settings-groups'); ?>
		<?php do_settings_sections('template_admin_zang');  ?>
		<?php submit_button('Save Changes','primary','btnSubmit'); ?>
	</form>

</div>

