<?php //this is the blog page not the page called home! ?>
<?php get_header(); ?>

<main class="main blog">
  <div class="container">
    <div class="content blog">
    		<?php get_template_part( 'loop', 'blog' );	?>
    </div> <!--/.content -->

    <?php get_sidebar('blog'); ?>

  </div> <!-- /.container -->
</main> <!-- /.main -->

<?php get_footer(); ?>