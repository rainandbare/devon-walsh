<?php get_header(); ?>

<main class="blog archives">
  <div class="container">

    <div class="content">
      <h1><?php single_tag_title(); ?> Archives</h1>
      <?php get_template_part( 'loop', 'blog' ); ?>
    </div> <!-- /.content -->

    <?php get_sidebar('blog'); ?>

  </div><!-- /.container -->
</main><!-- /.main -->

<?php get_footer(); ?>