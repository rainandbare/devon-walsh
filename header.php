<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php // Load Meta ?>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php  wp_title('|', true, 'right'); ?></title>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!-- stylesheets should be enqueued in functions.php -->
  <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
<div class="container">
<header class="clearfix">
  <section class="header-logo">
    <a href="<?php $url = bloginfo( 'url' ); echo $url;?>">
    <img src="<?php $url = bloginfo( 'url' ); echo $url;?>/wp-content/uploads/2016/08/DWF-Web-Rectangle.jpg "/>
    <a>
  </section>
  <section class="header-nav">
      <nav>
        <?php wp_nav_menu( array(
          'container' => false,
          'theme_location' => 'primary'
        )); ?>
      </nav>
  </section>
</header><!--/.header-->
</div>
