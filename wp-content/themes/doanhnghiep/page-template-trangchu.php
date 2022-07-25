
<?php 
/*
Template Name: page-template-trangchu
*/
get_header(); 
?>	
<div class="g_content">
	<?php 
	if(have_posts()) :
		while(have_posts()) : the_post();?>
			<?php the_content(); ?>
		<?php endwhile; 
		wp_reset_postdata();
	else:
		echo 'No data';	
	endif;
	?>
	<div class="news_home">
      <div class="container">
         <div class="short_text_home ">
            <h3><?php if(get_locale() == 'vi'){ echo 'Kiến thức hữu ích dành cho bạn';} else { echo 'Useful Articles about Real Estate and Mortgage Industry';} ?></h3>
         </div>
         <div class="row">
            <div class="col-sm-6">
               <?php 
               $arg_news = array(
                  'post_type' => 'post',
                  'posts_per_page' => 1,
                  'orderby' => 'date'
               );
               $query_news = new WP_Query($arg_news);
               if($query_news->have_posts()) : ?>
                  <?php while($query_news->have_posts()) : $query_news->the_post(); ?>
                     <div class="big_post_home pw">
                        <?php 
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'large'); 
                        ?>
                        <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>"></a></figure>
                        <div class="textwidget">
                           <div class="info_post">
                              <?php 
                              $cats = get_the_category();
                              $cat_name = $cats[0]->name;
                              ?>
                              <span><?php echo $cat_name; ?></span><em><?php the_time('d/m/Y'); ?></em>
                           </div>
                           <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                     </div>
                  <?php endwhile; ?>
                  <?php wp_reset_postdata(); ?> 
                  <?php else: echo 'No data';
                  endif;   
                  ?>
               </div>
               <div class="col-sm-6">
                  <?php 
                  $arg_news_child = array(
                     'post_type' => 'post',
                     'posts_per_page' => 2,
                     'offset' => 1,
                     'orderby' => 'date',
                  );
                  $query_news_child = new WP_Query($arg_news_child);
                  if($query_news_child->have_posts()) : ?>
                     <ul class="list_news_child">
                        <?php while($query_news_child->have_posts()) : $query_news_child->the_post(); ?>
                           <li class="pw">
                              <?php 
                              $image_child = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), $size = 'medium'); 
                              ?>
                              <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_child[0]; ?>"></a></figure>
                              <div class="textwidget">
                                 <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                 <div class="info_post">
                                    <?php 
                                    $cats = get_the_category();
                                    $cat_name = $cats[0]->name;
                                    ?>
                                    <span><?php echo $cat_name; ?></span><em><?php the_time('d/m/Y'); ?></em>
                                 </div>
                                 <p><?php echo excerpt(20); ?></p>
                              </div>
                           </li>
                        <?php endwhile; ?>
                     </ul>
                     <?php wp_reset_postdata(); ?> 
                     <?php else: echo 'No data';
                     endif;   
                     ?>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <?php get_footer(); ?>




