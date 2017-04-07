<?php

/*
	Template Name: FAQ 
*/

get_header();  ?>

<div class="main full-page faqs">
  <div class="container">
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <h2 class='faq-main-title'><?php the_title(); ?></h2>
      <div class="tabs">
      <div><div>
     <?php
        $params = array(
            'posts_per_page' => -1,
            'post_type' => 'faq',
            'meta_key'	=> 'faq_category',
			'orderby'	=> 'meta_value',
			'order'		=> 'ASC'
        ); 
        $faqQuery = new WP_Query($params); 
        $lastCategory = '';
    ?>
  <?php if ($faqQuery->have_posts()) :  ?>
    <?php while ($faqQuery->have_posts()) : 
                $faqQuery->the_post();  ?>
        <?php
        	$field_name = "faq_category";
			$field = get_field_object($field_name);
			$newCategory = $field['value'];
			$label = $field['choices'][ $newCategory ];
	        	if ($newCategory != $lastCategory){
	        		$lastCategory = $newCategory; ?>
	        		</div> <!-- content-faq -->
	        	</div> <!-- tab -->
	        	<div class="tab clearfix">
		        	 <input type="radio" id=<?php echo 'tab-' . $newCategory; ?> name="tab-group">
	       			<label for=<?php echo 'tab-' . $newCategory; ?>><?php echo $label; ?></label>
	       			<div class="content-faq">
	        	<?php } ?>
	        		<div class="question">
			           <h4><?php the_title();?></h4>
			           <p class="answer"><?php echo get_the_content();?></p>
		           </div>   
    <?php endwhile; ?>
  <?php wp_reset_postdata();  ?>
<?php else:  ?>
  <p>
       <?php _e( 'No FAQs right now' );  ?>
  </p>
<?php endif; ?>
<?php endwhile; // end the loop?>
		</div> <!-- content-faq -->
	</div> <!-- tab -->

  </div> <!-- /.container -->
</div> <!-- /.main -->

<?php get_footer(); ?>