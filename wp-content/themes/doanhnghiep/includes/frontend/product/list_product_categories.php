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
						  		echo '<li><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .' <span>('. $cat->count .')</span></a>';

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
						  			?>
						  			<ul class="sub_product_category">
						  			<?php
						  			foreach($sub_cats as $sub_category) {
						  				echo  '<li><a href="'.get_term_link($sub_category->slug, 'product_cat')  .'">'.$sub_category->name.' <span class="count_pd_subpd">('. $sub_category->count .')</span>  </a></li>' ;
						  			}?>
						  			</ul>
						  			<?php   
						  		}
						  	}       
						  }
						  ?>
						</ul>
				</div>