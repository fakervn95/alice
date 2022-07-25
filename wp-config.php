<?php
/**
 * Cấu hình c bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được to dựa trên nội dung 
 * mu của file này. Bạn khng bắt buộc phải sử dng giao diện web để cài ặt, 
 * chỉ cần lưu file này li vi tên "wp-config.php" v điền các thông tin cần thiết.
 *
 * File này chứa các thit lập sau:
 *
 * * Thit lp MySQL
 * * Cc khóa bí mt
 * * Tiền tố cho các bng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
// ** Thiết lập MySQL - Bạn có th lấy các thông tin này t host/server ** //
/** Tên database MySQL */
define('DB_NAME', 'alice_db');
/** Username của database */
define('DB_USER', 'alice_db');
/** Mật khẩu của database */
//define('DB_PASSWORD', '');
define('DB_PASSWORD', 'vLi@jhDGpE9ac!8t');
/** Hostname của database */
define('DB_HOST', '127.0.0.1');
/** Database charset sử dng để tạo bảng database. */
define('DB_CHARSET', 'utf8mb4');
/** Kiểu database collate. Đừng thay đổi nu không hiểu rõ. */
define('DB_COLLATE', '');
/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưi đây thành các khóa khng trùng nhau!
 * Bn có th tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn c thể thay đổi chúng bất c lúc nào để vô hiu ha tất c
 * các cookie hiện có. Điều này sẽ buc tất c người dùng phải đăng nhập li.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'F)%wadCs&otNPb4+Z(wuYd8oW/5tQY2&mi0FB!C+-2m%IR-yq}A+F|IRr3tn[/h4');
define('SECURE_AUTH_KEY',  ':`V4_*Pc;It5}kIuK;uWqTxNT>`lb51/ 3*D(2#6w(#8F7u6r+%a`yHK[fjB+4f}');
define('LOGGED_IN_KEY',    'r`McfVc7VU~d:CjeXl/!Ut|/92&xS78>r+?~JpV`n/Ui77FOG5Odp@[Sv!i36<zS');
define('NONCE_KEY',        'Md7v+l4S@+M:ko[.{fL~F{|CDX6^?0>nX-FXk-8L_bJN13^Ru!iUDQ/;@W-[|y4n');
define('AUTH_SALT',        'NUu7rl,fk#5w9Yd`tUH;3_JS#k$1y%&`3y#q;B5Q=9a[th)0.uLf&{z|Pz=WgN6h');
define('SECURE_AUTH_SALT', '-1=[:Rb~1Q=7xr9JpKd<2 w@.M+`w}z#X0CFs2tY~x6B&$$X9ZiT)b]L$dtR|33h');
define('LOGGED_IN_SALT',   ')yL1]FKCEKw?@LU+]nR+04nknvB=7&$n8B+~m=vuEIhg36CPzEi+|js|t#eDsgY=');
define('NONCE_SALT',       'enxVzgfrcsD))2)O[|KF@m*X)AZ7&QWXt2Sf)$%X*v06JVmOY3!t9kSC:Rf4>_@l');
/**#@-*/
/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bn có th cài nhiều site WordPress vo cng một database.
 * Ch s dng số, ký tự và dấu gch dưi!
 */
$table_prefix  = 'wp_';
/**
 * Dành cho developer: Chế đ debug.
 *
 * Thay đổi hng số ny thành true sẽ lm hiện lên các thông báo trong qu trình pht trin.
 * Chúng tôi khuyến cáo các developer sử dng WP_DEBUG trong quá trình phát trin plugin và theme.
 *
 * Đ có thông tin v các hằng số khác có th sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);
//define('FS_METHOD', 'direct');
define( 'WP_AUTO_UPDATE_CORE', false );
/* Đó là tất c thit lp, ngưng sửa từ phần này trở xuống. Chúc bạn vit blog vui vẻ. */
/** Đưng dn tuyệt đối đến thư mc cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Thiết lp bin và include file. */
require_once(ABSPATH . 'wp-settings.php');
