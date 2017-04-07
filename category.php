<?php get_header(); ?>

<main class="blog">
  <div class="container">
    <div class="content">
      <h1><?php single_cat_title(); ?> Archives</h1>
    	<?php
    		$category_description = category_description();
    		if ( ! empty( $category_description ) )
    			echo '' . $category_description . '';
    	   get_template_part( 'loop', 'blog' );
        ?>

    </div> <!-- /.content -->

    <?php get_sidebar('blog'); ?>

  </div> <!-- /.container -->
</main> <!-- /.main -->

<?php get_footer(); ?>