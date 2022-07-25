<?php 
function tg_meta_box()
{
	add_meta_box( 'info_building_area', 'Thông tin dự án', 'building_info_ouput', 'hangmuc' );
	add_meta_box( 'gallery-metabox', 'Ảnh thư viện', 'gallery_meta_callback', 'hangmuc');
}
add_action( 'add_meta_boxes', 'tg_meta_box' );
/**
 Khai báo callback
 @param $post là đối tượng WP_Post để nhận thông tin của post
 **/
 function tg_readmore_output( $post )
 {
 	$tg_readmore = get_post_meta( $post->ID, '_tg_readmore', true );
 	wp_nonce_field( 'save_thongtin', 'thongtin_nonce' );
 // Tạo trường Link Download
 	echo ( '<label for="tg_readmore">Nhập link: </label>' );
 	echo ('<input type="text" id="tg_readmore" name="tg_readmore" value="'.esc_attr( $tg_readmore ).'" />');
 }

 
 
 // Gallery cpt
 function gallery_meta_callback($post) {
 	wp_nonce_field( basename(__FILE__), 'gallery_meta_nonce' );
 	$ids = get_post_meta($post->ID, '_tdc_gallery_id', true);
 	?>
 	<table class="form-table">
 		<tr><td>
 			<a class="gallery-add button" href="#" data-uploader-title="Thêm hình ảnh" data-uploader-button-text="Thêm nhiều hình ảnh" style="margin:0px 0px 10px 0px;">Upload Images</a>
 			<ul id="gallery-metabox-list">
 				<?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>
 					<li>
 						<input type="hidden" name="tdc_gallery_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
 						<img class="image-preview" src="<?php echo $image[0]; ?>">
 						<a class="change-image button button-small" href="#" data-uploader-title="Đổi hình khác" data-uploader-button-text="Đổi hình khác">Change Image</a><br>
 						<small><a class="remove-image" href="#">Delete</a></small>
 					</li>
 				<?php endforeach; endif; ?>
 			</ul>
 		</td></tr>
 	</table>
 <?php }
 function gallery_meta_save($post_id) {
 	if (!isset($_POST['gallery_meta_nonce']) || !wp_verify_nonce($_POST['gallery_meta_nonce'], basename(__FILE__))) return;
 	if (!current_user_can('edit_post', $post_id)) return;
 	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
 	if(isset($_POST['tdc_gallery_id'])) {
 		update_post_meta($post_id, '_tdc_gallery_id', $_POST['tdc_gallery_id']);
 	} else {
 		delete_post_meta($post_id, '_tdc_gallery_id');
 	}
 }
 add_action('save_post', 'gallery_meta_save');


 		function building_info_ouput( $post )
 		{
 			$diachi = get_post_meta( $post->ID, '_diachi', true );
 			$dientich = get_post_meta( $post->ID, '_dientich', true );
 			$chudautu = get_post_meta( $post->ID, '_chudautu', true );
 			$sopn = get_post_meta( $post->ID, '_sopn', true );
 			$noithat = get_post_meta( $post->ID, '_noithat', true );
 			$thietke = get_post_meta( $post->ID, '_thietke', true );
 			$hoanthanh = get_post_meta( $post->ID, '_hoanthanh', true );
 			?>
 			<div class="row">
 				<div class="col-sm-4">
 					<label for="diachi">Ðịa chỉ </label>
 					<div class="wrap_group_item">
 						<input type="text" id="diachi" name="diachi" value="<?php echo esc_attr( $diachi );?>" />
 					</div>
 				</div>
 				<div class="col-sm-4">
 					<label for="dientich">Diện tích </label>
 					<div class="wrap_group_item">
 						<input type="text" id="dientich" name="dientich" value="<?php echo esc_attr( $dientich );?>" />
 					</div>
 				</div>
 				<div class="col-sm-4">
 					<label for="chudautu">Chủ đầu tư </label>
 					<div class="wrap_group_item">
 						<input type="text" id="chudautu" name="chudautu" value="<?php echo esc_attr( $chudautu );?>" />
 					</div>
 				</div>
 			</div>
 			<div class="row">
 				<div class="col-sm-4">
 					<label for="sopn">Số phòng ngủ </label>
 					<div class="wrap_group_item">
 						<input type="text" id="sopn" name="sopn" value="<?php echo esc_attr( $sopn );?>" />
 					</div>
 				</div>
 				<div class="col-sm-4">
 					<label for="noithat">Nội thất </label>
 					<div class="wrap_group_item">
 						<input type="text" id="noithat" name="noithat" value="<?php echo esc_attr( $noithat );?>" />
 					</div>
 				</div>
 				<div class="col-sm-4">
 					<label for="hoanthanh">Hoàn thành </label>
 					<div class="wrap_group_item">
 						<input type="text" id="hoanthanh" name="hoanthanh" value="<?php echo esc_attr( $hoanthanh );?>" />
 					</div>
 				</div>
 			</div>
 			<div class="row">
 				<div class="col-sm-4">
 					<label for="thietke">Thiết kế </label>
 					<div class="wrap_group_item">
 						<input type="text" id="thietke" name="thietke" value="<?php echo esc_attr( $thietke );?>" />
 					</div>
 				</div>
 			</div>
 			<?php
 		}

 function tg_thongtinduan_save($post_id){
 	if(isset($_POST['dientich']) ||  isset($_POST['chudautu']) ||  isset($_POST['diachi']) ){
 		$diachi =  sanitize_text_field($_POST['diachi']) ;
 		$dientich =  sanitize_text_field($_POST['dientich']) ;
 		$chudautu =  sanitize_text_field($_POST['chudautu']) ;
 		$sopn =  sanitize_text_field($_POST['sopn']) ;
 		$noithat =  sanitize_text_field($_POST['noithat']) ;
 		$thietke =  sanitize_text_field($_POST['thietke']) ;
 		$hoanthanh =  sanitize_text_field($_POST['hoanthanh']) ;
 		

 		update_post_meta( $post_id, '_diachi', $diachi );
 		update_post_meta( $post_id, '_dientich', $dientich );
 		update_post_meta( $post_id, '_chudautu', $chudautu );
 		update_post_meta( $post_id, '_sopn', $sopn );
 		update_post_meta( $post_id, '_noithat', $noithat );
 		update_post_meta( $post_id, '_thietke', $thietke );
 		update_post_meta( $post_id, '_hoanthanh', $hoanthanh );

 	}  
 }
 add_action( 'save_post', 'tg_thongtinduan_save' );