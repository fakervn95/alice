<?php 
?>
<div class="container">
	<div id="breadcrumb" class="breadcrumb">
		<ul>
			<?php  echo the_breadcrumb(); ?>
		</ul>
	</div> 
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-12">
			<div class="list_products_categories">
				<ul>
					<?php
					$taxonomy     = 'product_cat';
					$orderby      = 'name';  
						  $show_count   = 0;      // 1 for yes, 0 for no
						  $pad_counts   = 0;      // 1 for yes, 0 for no
						  $hierarchical = 0;      // 1 for yes, 0 for no  
						  $title        = '';  
						  $empty        = 0;

						  $args = array(
						  	'taxonomy'     => $taxonomy,
						  	'orderby'      => $orderby,
						  	'show_count'   => $show_count,
						  	'pad_counts'   => $pad_counts,
						  	'hierarchical' => $hierarchical,
						  	'title_li'     => $title,
						  	'hide_empty'   => $empty
						  );
						  $all_categories = get_categories( $args );
						  foreach ($all_categories as $cat) {
						  	if($cat->category_parent == 0) {
						  		$category_id = $cat->term_id;       
						  		echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .' <span>('. $cat->count .')</span></a></li>';

						  		$args2 = array(
						  			'taxonomy'     => $taxonomy,
						  			'child_of'     => 0,
						  			'parent'       => $category_id,
						  			'orderby'      => $orderby,
						  			'show_count'   => $show_count,
						  			'pad_counts'   => $pad_counts,
						  			'hierarchical' => $hierarchical,
						  			'title_li'     => $title,
						  			'hide_empty'   => $empty
						  		);
						  		$sub_cats = get_categories( $args2 );
						  		if($sub_cats) {
						  			foreach($sub_cats as $sub_category) {
						  				echo  $sub_category->name ;
						  			}   
						  		}
						  	}       
						  }
						  ?>
						</ul>
					</div>
				</div>
				<div class="col-md-9 col-sm-9 list_products">
					<?php
// first we need to get the product categories ....
$categories_args = array(
	'taxonomy' => 'product_cat' // the taxonomy we want to get terms of
);
$product_categories = get_terms( $categories_args ); // get all terms of the product category taxonomy
if ($product_categories) { // only start if there are some terms
	echo '<ul class="catalog">';
	// now we are looping over each term
	foreach ($product_categories as $product_category) {
		$term_id 	= $product_category->term_id; // Term ID
	    $term_name 	= $product_category->name; // Term name
	    $term_desc 	= $product_category->description; // Term description
	    $term_link 	= get_term_link($product_category->slug, $product_category->taxonomy); // Term link
	    echo '<li class="product-cat-'.$term_id.'">'; // for each term we will create one list element
	    echo '<h4 class="product-cat-title"><a href="'.$term_link.'">'.$term_name.'</a></h4>'; // display term name with link
	    echo '<p class="product-cat-description">'.$term_desc .'</p>'; // display term description
	    // ... now we will get the products which have that term assigned...
	    $products_args = array(
			'post_type' 	=> 'product', // we want to get products
			'tax_query' 	=> array( 
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $term_id, // here we enter the ID of the current term *this is where the magic happens*
				),
			),
		);
		$products = new WP_Query( $products_args );
		if ( $products->have_posts() ) { // only start if we hace some products
			// START some normal woocommerce loop, as you already posted in your question
			woocommerce_product_loop_start();
			while ( $products->have_posts() ) : $products->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile; // end of the loop.
			woocommerce_product_loop_end();
			// END the normal woocommerce loop
			// Restore original post data, maybe not needed here (in a plugin it might be necessary)
			wp_reset_postdata();
		} else { // if we have no products, show the default woocommerce no-product loop
			// no posts found
			wc_get_template( 'loop/no-products-found.php' );
		}//END if $products
		echo '</li>';//END here is the end of our product-cat-term_id list item
	}//END foreach $product_categories
	echo '</ul>';//END of catalog list
}//END if $product_categories
?>
				</div>
			</div>
		</div>
