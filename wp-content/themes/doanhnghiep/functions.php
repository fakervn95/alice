<?php
define("BASE_URL", get_template_directory_uri());
include get_template_directory().'/includes/admin/function-admin.php';
include get_template_directory().'/includes/admin/custom-post-type.php';
include get_template_directory().'/includes/admin/add_meta_box.php';
include get_template_directory().'/includes/frontend/shortcode/shortcode.php';
include get_template_directory().'/includes/frontend/sidebar/sidebar-post.php';
function add_resource() {
  wp_register_script( 'admin_js', get_template_directory_uri() . '/js/admin.js', false, '1.0.0' );
  wp_enqueue_script('bootstrap', get_template_directory_uri() .'/js/bootstrap.min.js', array('jquery') );
  wp_enqueue_script('adminjs', get_template_directory_uri() . '/js/admin.js', array( 'jquery') ); 
  wp_enqueue_style('admincss', get_template_directory_uri() . '/css/admin.css');
}
add_action( 'admin_enqueue_scripts', 'add_resource' );
// Navigation menus 
register_nav_menus(array(
  'primary' => __('Primary Menu'),
  'menu_mobile' => __('Mobile Menu')
));
  // Get top ancestor id
function get_top_ancestor_id(){
  global $post;
  if($post->post_parent){
    $ancestors= array_reverse(get_post_ancestors($post->ID));
    return $ancestors[0];
  } 
  return $post->ID;
}
  // Does page have children ? 
function has_children(){
  global $post;
  $pages = get_pages('child_of=' . $post->ID);
  return count($pages);
}
  // Customize excerpt word count length
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function the_content_exceprt($limit) {
  $excerpt = explode(' ', the_content(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

function trim_the_content($limit) {
  $trim_content = explode(' ', get_the_content(), $limit);
  if (count($trim_content)>=$limit) {
    array_pop($trim_content);
    $trim_content = implode(" ",$trim_content).'...';
  } else {
    $trim_content = implode(" ",$trim_content);
  } 
  $trim_content = preg_replace('`\[[^\]]*\]`','',$trim_content);
  return $trim_content;
}
  // ADD FEATURED IMAGE SUPPORT
function featured_images_setup(){
  add_theme_support('post-thumbnails');
}
add_action('after_setup_theme','featured_images_setup');
  // ADD POST FORMAT SUPPORT
//add_theme_support('post-formats',array('aside','gallery','link'));
  // ADD OUR WIDGETS LOCATION
function our_widget_inits(){
  register_sidebar(array(
    'name' => 'Sidebar Archive',
    'id' => 'sidebar_archive',
    'before_widget' => '<div id="%1$s" class="widget %2$s widget_area">',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => 'Sidebar Single Hạng Mục',
    'id' => 'sidebar_hangmuc',
    'before_widget' => '<div id="%1$s" class="widget %2$s widget_area">',
    'after_widget' => "</div>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}
add_action('widgets_init','our_widget_inits');
/** Filter & Hook In Widget Before Post Content .*/
function before_post_widget() {
  if ( is_home() && is_active_sidebar( 'sidebar1' ) ) { 
    dynamic_sidebar('sidebar1', array(
      'before' => '<div class="before-post">',
      'after' => '</div>',
    ) );      
  }
}
add_action( 'woo_loop_before', 'before_post_widget' );
add_theme_support( 'custom-logo' );
// BREADCRUMB
function the_breadcrumb()
{
    // Set variables for later use
    $home_link        = home_url('/');
    $home_text        = __( 'Home' );
    $link_before      = '<li typeof="v:Breadcrumb">';
    $link_after       = '</li>';
    $link_attr        = ' rel="v:url" property="v:title"';
    $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
    $delimiter        = ' ';              // Delimiter between crumbs
    $before           = '<li class="current">'; // Tag before the current crumb
    $after            = '</li>';                // Tag after the current crumb
    $page_addon       = '';                       // Adds the page number if the query is paged
    $breadcrumb_trail = '';
    $category_links   = '';
    /** 
     * Set our own $wp_the_query variable. Do not use the global variable version due to 
     * reliability
     */
    $wp_the_query   = $GLOBALS['wp_the_query'];
    $queried_object = $wp_the_query->get_queried_object();
    ?>
    <?php
    // Handle single post requests which includes single pages, posts and attatchments
    if ( is_singular() ) 
    {
        /** 
         * Set our own $post variable. Do not use the global variable version due to 
         * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
         */
        $post_object = sanitize_post( $queried_object );
        // Set variables 
        $title          = apply_filters( 'the_title', $post_object->post_title );
        $parent         = $post_object->post_parent;
        $post_type      = $post_object->post_type;
        $post_id        = $post_object->ID;
        $post_link      = $before . $title . $after;
        $parent_string  = '';
        $post_type_link = '';
        if ( 'post' === $post_type ) 
        {
            // Get the post categories
            $categories = get_the_category( $post_id );
            if ( $categories ) {
                // Lets grab the first category
                $category  = $categories[0];
                $category_links = get_category_parents( $category, true, $delimiter );
                $category_links = str_replace( '<a',   $link_before . '<a' . $link_attr, $category_links );
                $category_links = str_replace( '</a>', '</a>' . $link_after,             $category_links );
            }
        }
        if ( !in_array( $post_type, ['post', 'page', 'attachment'] ) )
        {
            $post_type_object = get_post_type_object( $post_type );
            $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );
            $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
        }
        // Get post parents if $parent !== 0
        if ( 0 !== $parent ) 
        {
            $parent_links = [];
            while ( $parent ) {
                $post_parent = get_post( $parent );
                $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );
                $parent = $post_parent->post_parent;
            }
            $parent_links = array_reverse( $parent_links );
            $parent_string = implode( $delimiter, $parent_links );
        }
        // Lets build the breadcrumb trail
        if ( $parent_string ) {
            $breadcrumb_trail = $parent_string . $delimiter . $post_link;
        } else {
            $breadcrumb_trail = $post_link;
        }
        if ( $post_type_link )
            $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;
        if ( $category_links )
            $breadcrumb_trail = $category_links . $breadcrumb_trail;
    }
    // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
    if( is_archive() )
    {
        if (    is_category()
             || is_tag()
             || is_tax()
        ) {
            // Set the variables for this section
            $term_object        = get_term( $queried_object );
            $taxonomy           = $term_object->taxonomy;
            $term_id            = $term_object->term_id;
            $term_name          = $term_object->name;
            $term_parent        = $term_object->parent;
            $taxonomy_object    = get_taxonomy( $taxonomy );
            $current_term_link  = $before . $term_name . $after;
            $parent_term_string = '';
            if ( 0 !== $term_parent )
            {
                // Get all the current term ancestors
                $parent_term_links = [];
                while ( $term_parent ) {
                    $term = get_term( $term_parent, $taxonomy );
                    $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );
                    $term_parent = $term->parent;
                }
                $parent_term_links  = array_reverse( $parent_term_links );
                $parent_term_string = implode( $delimiter, $parent_term_links );
            }
            if ( $parent_term_string ) {
                $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
            } else {
                $breadcrumb_trail = $current_term_link;
            }
        } elseif ( is_author() ) {
            $breadcrumb_trail = __( 'Author archive for ') .  $before . $queried_object->data->display_name . $after;
        } elseif ( is_date() ) {
            // Set default variables
            $year     = $wp_the_query->query_vars['year'];
            $monthnum = $wp_the_query->query_vars['monthnum'];
            $day      = $wp_the_query->query_vars['day'];
            // Get the month name if $monthnum has a value
            if ( $monthnum ) {
                $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                $month_name = $date_time->format( 'F' );
            }
            if ( is_year() ) {
                $breadcrumb_trail = $before . $year . $after;
            } elseif( is_month() ) {
                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );
                $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;
            } elseif( is_day() ) {
                $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ),             $year       );
                $month_link       = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );
                $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
            }
        } elseif ( is_post_type_archive() ) {
            $post_type        = $wp_the_query->query_vars['post_type'];
            $post_type_object = get_post_type_object( $post_type );
            
  
            if(get_locale() == 'ja'){
                 if('recruitment' == $post_type_object->rewrite['slug']){
                    $breadcrumb_trail = $before . '採用情報' . $after; 
                 }
            }else{
              $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;  
            }
        }
    }   
    // Handle the search page
    if ( is_search() ) {
        $breadcrumb_trail = __( 'Search query for: ' ) . $before . get_search_query() . $after;
    }
    // Handle 404's
    if ( is_404() ) {
        $breadcrumb_trail = $before . __( 'Error 404' ) . $after;
    }
    // Handle paged pages
    if ( is_paged() ) {
        $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
    }
    $breadcrumb_output_link  = '';
    if (    is_home()
         || is_front_page()
    ) {
        // Do not show breadcrumbs on page one of home and frontpage
        if ( is_paged() ) {
            $breadcrumb_output_link .= '<a href="' . $home_link . '">' . $home_text . '</a>';
            $breadcrumb_output_link .= $page_addon;
        }
    } else {
        $breadcrumb_output_link .= '<li><a href="' . $home_link . '" rel="v:url" property="v:title">' . $home_text . '</a></li>';
        $breadcrumb_output_link .= $delimiter;
        $breadcrumb_output_link .= $breadcrumb_trail;
        $breadcrumb_output_link .= $page_addon;
    }
    return $breadcrumb_output_link;
}
 // END BREADCRUM
/*
 *  DUPLICATE POST IN  ADMIN. Dups appear as drafts. User is redirected to the edit screen
 */
function rd_duplicate_post_as_draft(){
  global $wpdb;
  if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
    wp_die('No post to duplicate has been supplied!');
  }
  /*
   * Nonce verification
   */
  if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
    return;
  /*
   * get the original post id
   */
  $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
  /*
   * and all the original post data then
   */
  $post = get_post( $post_id );
  /*
   * if you don't want current user to be the new post author,
   * then change next couple of lines to this: $new_post_author = $post->post_author;
   */
  $current_user = wp_get_current_user();
  $new_post_author = $current_user->ID;
  /*
   * if post data exists, create the post duplicate
   */
  if (isset( $post ) && $post != null) {
    /*
     * new post data array
     */
    $args = array(
      'comment_status' => $post->comment_status,
      'ping_status'    => $post->ping_status,
      'post_author'    => $new_post_author,
      'post_content'   => $post->post_content,
      'post_excerpt'   => $post->post_excerpt,
      'post_name'      => $post->post_name,
      'post_parent'    => $post->post_parent,
      'post_password'  => $post->post_password,
      'post_status'    => 'draft',
      'post_title'     => $post->post_title,
      'post_type'      => $post->post_type,
      'to_ping'        => $post->to_ping,
      'menu_order'     => $post->menu_order
    );
    /*
     * insert the post by wp_insert_post() function
     */
    $new_post_id = wp_insert_post( $args );
    /*
     * get all current post terms ad set them to the new post draft
     */
    $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
    foreach ($taxonomies as $taxonomy) {
      $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
      wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
    }
    /*
     * duplicate all post meta just in two SQL queries
     */
    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
    if (count($post_meta_infos)!=0) {
      $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
      foreach ($post_meta_infos as $meta_info) {
        $meta_key = $meta_info->meta_key;
        if( $meta_key == '_wp_old_slug' ) continue;
        $meta_value = addslashes($meta_info->meta_value);
        $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
      }
      $sql_query.= implode(" UNION ALL ", $sql_query_sel);
      $wpdb->query($sql_query);
    }
    /*
     * finally, redirect to the edit post screen for the new draft
     */
    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
    exit;
  } else {
    wp_die('Post creation failed, could not find original post: ' . $post_id);
  }
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
/*
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
  if (current_user_can('edit_posts')) {
    $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Nhân bản</a>';
  }
  return $actions;
}
//add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );
// duplicate page
//add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);

// REMOVE CSS WP_HEAD
//xoa header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action('wp_head', 'feed_links_extra', 3 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
// Keep old Editor
add_filter('use_block_editor_for_post', '__return_false');
// Email ctm
add_filter( 'woocommerce_email_recipient_new_order', 'custom_new_order_email_recipient', 10, 2 );
function custom_new_order_email_recipient( $recipient, $order ) {
    // Avoiding backend displayed error in Woocommerce email settings for undefined $order
  if ( ! is_a( $order, 'WC_Order' ) ) 
    return $recipient;
    // Check order items for a shipped product is in the order   
  foreach ( $order->get_items() as $item ) {
        $product = $item->get_product(); // Get WC_Product instance Object
        // When a product needs shipping we add the customer email to email recipients
        if ( $product->needs_shipping() ) {
          return $recipient . ',' . $order->get_billing_email();
        }
      }
      return $recipient;
    }
    /* WRAP IMAGE POST CONTENT WITH FIGURE*/
    function filter_images($content){
      return preg_replace('/<img (.*) \/>\s*/iU', '<figure><img \1 /></figure>', $content);
    }
    add_filter('the_content', 'filter_images');
    /* END WRAP IMAGE POST CONTENT WITH FIGURE*/
/**
 * Plugin class
 **/
if ( ! class_exists( 'CT_TAX_META' ) ) {
  class CT_TAX_META {
    public function __construct() {
    //
    }
 /*
  * Initialize the class and start calling our hooks and filters
  * @since 1.0.0
 */
 public function init() {
   add_action( 'category_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
   add_action( 'created_category', array ( $this, 'save_category_image' ), 10, 2 );
   add_action( 'category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
   add_action( 'edited_category', array ( $this, 'updated_category_image' ), 10, 2 );
   add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
   add_action( 'admin_footer', array ( $this, 'add_script' ) );
 }
 public function load_media() {
   wp_enqueue_media();
 }
 
 /*
  * Add a form field in the new category page
  * @since 1.0.0
 */
 public function add_category_image ( $taxonomy ) { ?>
   <div class="form-field term-group">
     <label for="category-image-id"><?php _e('Image', 'hero-theme'); ?></label>
     <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
     <div id="category-image-wrapper"></div>
     <p>
       <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
       <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
     </p>
   </div>
   <?php
 }
 
 /*
  * Save the form field
  * @since 1.0.0
 */
 public function save_category_image ( $term_id, $tt_id ) {
   if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
     $image = $_POST['category-image-id'];
     add_term_meta( $term_id, 'category-image-id', $image, true );
   }
 }
 
 /*
  * Edit the form field
  * @since 1.0.0
 */
 public function update_category_image ( $term, $taxonomy ) { ?>
   <tr class="form-field term-group-wrap">
     <th scope="row">
       <label for="category-image-id"><?php _e( 'Image', 'hero-theme' ); ?></label>
     </th>
     <td>
       <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
       <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
       <div id="category-image-wrapper">
         <?php if ( $image_id ) { ?>
           <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
         <?php } ?>
       </div>
       <p>
         <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e( 'Add Image', 'hero-theme' ); ?>" />
         <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'hero-theme' ); ?>" />
       </p>
     </td>
   </tr>
   <?php
 }
/*
 * Update the form field value
 * @since 1.0.0
 */
public function updated_category_image ( $term_id, $tt_id ) {
 if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
   $image = $_POST['category-image-id'];
   update_term_meta ( $term_id, 'category-image-id', $image );
 } else {
   update_term_meta ( $term_id, 'category-image-id', '' );
 }
}
/*
 * Add script
 * @since 1.0.0
 */
public function add_script() { ?>
 <script>
   jQuery(document).ready( function($) {
     function ct_media_upload(button_class) {
       var _custom_media = true,
       _orig_send_attachment = wp.media.editor.send.attachment;
       $('body').on('click', button_class, function(e) {
         var button_id = '#'+$(this).attr('id');
         var send_attachment_bkp = wp.media.editor.send.attachment;
         var button = $(button_id);
         _custom_media = true;
         wp.media.editor.send.attachment = function(props, attachment){
           if ( _custom_media ) {
             $('#category-image-id').val(attachment.id);
             $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
             $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
           } else {
             return _orig_send_attachment.apply( button_id, [props, attachment] );
           }
         }
         wp.media.editor.open(button);
         return false;
       });
     }
     ct_media_upload('.ct_tax_media_button.button'); 
     $('body').on('click','.ct_tax_media_remove',function(){
       $('#category-image-id').val('');
       $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
     });
     // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
     $(document).ajaxComplete(function(event, xhr, settings) {
       var queryStringArr = settings.data.split('&');
       if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
         var xml = xhr.responseXML;
         $response = $(xml).find('term_id').text();
         if($response!=""){
           // Clear the thumb image
           $('#category-image-wrapper').html('');
         }
       }
     });
   });
 </script>
<?php }
}
$CT_TAX_META = new CT_TAX_META();
$CT_TAX_META -> init();
}
function get_term_top_most_parent( $term, $taxonomy ) {
    // Start from the current term
  $parent  = get_term( $term, $taxonomy );
    // Climb up the hierarchy until we reach a term with parent = '0'
  while ( $parent->parent != '0' ) {
    $term_id = $parent->parent;
    $parent  = get_term( $term_id, $taxonomy);
  }
  return $parent;
}
add_action('wp_ajax_get_review', 'get_review');
add_action('wp_ajax_nopriv_get_review', 'get_review');
if (!function_exists('get_review')) {
  function get_review(){
    $id_hangmuc = (isset($_POST['id_hangmuc']))?esc_attr($_POST['id_hangmuc']) : '';
    if($id_hangmuc == 'all'){
      $args = array(
        'post_type'=>'hangmuc',
        'orderby' => 'date',
        'posts_per_page' => 21
      );
    }else {
      $args = array(
        'order' => 'ASC',
        'tax_query' => array(
          array(
            'taxonomy' => 'category_hangmuc',
            'field' => 'slug',
            'terms' => $id_hangmuc
          )
        ),
        'posts_per_page' => 9
      );
    }
    $loop = new WP_Query( $args ); ?>
    <?php if($loop->have_posts()): ?>
      <ul class="row list_pj">
       <?php while($loop->have_posts()) : $loop->the_post(); ?>
        <?php get_template_part('includes/frontend/loop/loop_duan');  ?>
      <?php endwhile; ?>
    </ul>
    <div class="btn_cat_home">
      <?php
         global $post;

      $term = get_the_terms($post->ID,'category_hangmuc');
      ?>
      <a href="<?php echo get_term_link($term[0]->term_id,$term[0]->taxonomy); ?>">Xem thêm</a>
    </div>
    <?php wp_reset_postdata(); ?>
    <?php else: ?>
      <p class="not_have_data">Không có dữ liệu</p>
      <?php 
    endif;
    die();
  }
} 



function more_post_ajax(){

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 4;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 1;
    header("Content-Type: text/html");
    $args = array(
        'suppress_filters' => true,
        'post_type' => 'review',
        'posts_per_page' => $ppp,
        'paged'    => $page,
    );

    $loop = new WP_Query($args);
    ?>
    <?php if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post(); ?>
      

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
                                            </div>
                                            <div class="tg_excerpt">
                                                <?php the_content(); ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
      <?php
    endwhile;
    endif;
    wp_reset_postdata();
    die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}


add_action('wp_ajax_get_review_home', 'get_review_home');
add_action('wp_ajax_nopriv_get_review_home', 'get_review_home');
if (!function_exists('get_review_home')) {
  function get_review_home(){
   ?>

  <ul>
          <li><a href="https://www.facebook.com/milky.nguyen.771" target="_blank"><i class="fa fa-facebook" aria-hidden="true" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Facebook"></i></a></li>
          <li><a href="https://www.google.com/search?hl=vi-VN&gl=vn&q=Alice+Van+Nguyen+-+WA+Real+Estate+Agent+%26+Loan+Officer,+10136+56th+Ave+NE,+Marysville,+WA+98270,+Hoa+K%E1%BB%B3&ludocid=8551833710005984709&lsig=AB86z5X5ChLLo1BwxXA2_AjTtAW6&source=g.page.m.rc._&laa=merchant-web-dashboard-card&fbclid=IwAR2LnVV7UXyWiDWzraQSmx0Dnzn5UeAavGtlFw04f9Tq6sAGfy8UV44KSgY#laa=merchant-web-dashboard-card&lrd=0x548553b48a4930fb:0x76ae37731f1e1dc5,3" target="_blank"><i class="fa fa-google-plus" aria-hidden="true" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Google"></i></a></li>
          <li><a href="https://www.zillow.com/reviews/write/?s=X1-ZUsq2x7eqy0hzd_6wmna&fbclid=IwAR18AZM8XmuxiJq6oVC34Be7qiDYNKQLKKV_-8guhIzBM3qxx5fCoHYXZp0" data-toggle="tooltip" data-html="true" data-placement="top" title="" data-original-title="Zillow" target="_blank"><img src="<?php echo BASE_URL; ?>/images/zillow-50x50.png"></a></li>
        </ul>
  <?php 
die();
}
} 