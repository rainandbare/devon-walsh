<?php get_header(); ?>

<main class="blog single">
  <div class="container">
    <div class="content">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <main>
          <img src=<?php echo devon_featured_url(); ?>>
          <h1 class="entry-title"><?php the_title(); ?></h1>
          <div class="entry-meta">
            <?php hackeryou_posted_on(); ?>
          </div><!-- .entry-meta -->

          <div class="entry-content">
            <?php the_content(); ?>
            <?php wp_link_pages(array(
              'before' => '<div class="page-link"> Pages: ',
              'after' => '</div>'
            )); ?>
          </div><!-- .entry-content -->
        </main>
        <aside>
          <p><?php the_tags('','<br>',null); ?></p>
          <div class="entry-utility">
            <?php edit_post_link( 'Edit Post', '<span class="edit-link">', '</span>' ); ?>
          </div><!-- .entry-utility -->
        </aside>
        </article><!-- #post-## -->

        <div id="nav-below" class="navigation clearfix">
          <p class="nav-previous"><?php previous_post_link('%link', '&larr; %title'); ?></p>
          <p class="nav-next"><?php next_post_link('%link', '%title &rarr;'); ?></p>
        </div><!-- #nav-below -->

        <?php comments_template( '', true ); ?>
          <?php //echo wpb_get_post_views(get_the_ID()); ?>
      <?php endwhile; // end of the loop. ?>

    </div> <!-- /.content -->

    <?php get_sidebar('blog'); ?>

  </div> <!-- /.container -->
</main>

<?php get_footer(); ?>