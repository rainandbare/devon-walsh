<?php

/*
	Template Name: Menu
*/

get_header();  ?>

<main class="menu_main">
  <div class="container">
  <header class="menu">
  <?php // Start the loop ?>
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <h1><?php the_title(); ?></h1>      
        <?php 
            $menuDates = get_menu_dates();
            $menuStart = $menuDates[0];
            $menuEnd = $menuDates[1];
            $orderBy = $menuDates[2];
            ?>
            <h5 id="next_menu_week"><?php echo $menuStart. ' to ';  echo $menuEnd;?></h5>
            <h5 id="order_deadline">Order by 
              <?php if( get_field('order_by_deadline_override') ): ?>
                <?php the_field('order_by_deadline_override'); ?>
              <?php else: 
                echo $orderBy; ?>
              <?php endif; edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
            </h5> 
  </header>
  <div class="background">
  <h2>Bowls</h2>
    <?php
   $week = what_week_is_it();
        $params = array(
            'posts_per_page' => -1,
            'post_type' => 'product',
            'product_cat' => $week,
            'orderby' => 'title',
            'order' => 'ASC'
        ); 
        $wc_query = new WP_Query($params); 
    ?>
  <?php if ($wc_query->have_posts()) :  ?>
  <ul class="menu_list bowls clearfix">
      <li class="directions">
        <h3>All bowls come with your choice of protein:</h3>
        <h3>chicken, beef, tofu or just veg</h3>
      </li>
    <?php while ($wc_query->have_posts()) : 
                $wc_query->the_post();  ?>
      <li>
        <div class="image">
          <?php
            $productId = get_the_ID();
            $product = new WC_product($productId);
            $image = $product->get_image('shop_single');
            echo $image;
          ?>
          <p class="ingredients"><?php echo get_the_content();?></p>    
        </div>
        <h4><?php the_title();?></h4>
      </li>
      
    <?php endwhile; ?>
</ul>
  <?php wp_reset_postdata();  ?>
<?php else:  ?>
  <p>
       <?php _e( 'No Bowls Right Now' );  ?>
  </p>
<?php endif; ?>


<h2>Snacks</h2>
<?php
    $params = array(
        'posts_per_page' => -1,
        'post_type' => 'product',
        'product_cat' => 'snacks'
  ); 
    $wc_query = new WP_Query($params); ?>
  <?php if ($wc_query->have_posts()) :  ?>
<ul class="menu_list bowls clearfix">
    <?php while ($wc_query->have_posts()) : 
                $wc_query->the_post();  ?>

      <li>
        <div class="image">
          <?php
            $productId = get_the_ID();
            $product = new WC_product($productId);
            $image = $product->get_image('shop_single');
            echo $image;
          ?>
          <p class="ingredients"><?php echo get_the_content();?></p>    
        </div>
        <h4><?php the_title();?></h4>
      </li>

    <?php endwhile; ?>
</ul>
  <?php wp_reset_postdata();  ?>
<?php else:  ?>
  <p>
       <?php _e( 'No Snacks Right Now' );  ?>
  </p>
<?php endif; ?>
</div>
</div>
<section class="why">

  <h3><?php the_field("why_title"); ?>
  <img class="icon" src=<?php the_field("why_icon") ?>></h3>
    <div class="row clearfix">  
      <div class="half why-content">
        <p class="number">1.</p>
        <h4><?php the_field("why_subtitle_1"); ?></h4>
        <p><?php the_field("why_content_1"); ?></p>
      </div>
      <div class="half whyImage">
        <img src=<?php the_field("why_image_1"); ?>>
      </div>
    </div>
    <div class="row clearfix"> 

      <div class="half whyImage">
        <img src=<?php the_field("why_image_2"); ?>>
      </div> 
      <div class="half why-content">
      <p class="number">2.</p> 
        <h4><?php the_field("why_subtitle_2"); ?></h4>
        <p><?php the_field("why_content_2"); ?></p>
      </div>
    </div>
    <div class="row clearfix">  
      <div class="half why-content">
        <p class="number">3.</p> 
        <h4><?php the_field("why_subtitle_3"); ?></h4>
        <p><?php the_field("why_content_3"); ?></p>
      </div> 
      <div class="half whyImage">
        <img src=<?php the_field("why_image_3"); ?>>
      </div>
    </div>
    </section>
<section class="call-to-action">
  <div class="container">
    <button class="c-2-a"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Order' ) ) ); ?>">Order Now</a></button>
  </div>
</section>


<?php endwhile; // end the loop?>

  </div> <!-- /.container -->
</main> <!-- /.main -->

<?php get_footer(); ?>