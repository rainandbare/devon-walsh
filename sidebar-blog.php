<div class="sidebar">
	<ul>
		<li class="featured">
			<h3>Featured</h3>
			<?php
			    $params = array(
			        'posts_per_page' => 1,
			        'category_name' => 'featured'
			  ); 
			    $featuredQuery = new WP_Query($params); ?>
			 <?php if ($featuredQuery->have_posts()) :  ?>

			    <?php while ($featuredQuery->have_posts()) : 
			                $featuredQuery->the_post();  ?>
					<img src=<?php echo devon_featured_url(); ?>>
					<h5 class="featured">
				        <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
				          <?php the_title(); ?>
				        </a>
					</h5>						
					<?php the_excerpt(); ?>
			    <?php endwhile; ?>
			  <?php wp_reset_postdata();  ?>
			<?php else:  ?>
			  <p>
			       <?php _e( 'No Snacks Right Now' );  ?>
			  </p>

			<?php endif; ?>
		</li>
		<li class="sign-up">
			<h4>Sign up to receive weekly menus and ordering information!</h4>
			<form class="clearfix">
				<input type="email"/>
				<input type="submit"/>
			</form>
		</li>
		<li class="most-popular">
			<h3>Most Popular</h3>
			<ul>
				<?php
				$popularpost = new WP_Query( array( 
										'posts_per_page' => 3, 
										'meta_key' => 'wpb_post_views_count', 
										'orderby' => 'meta_value_num', 
										'order' => 'DESC'  ) 
										);
				while ( $popularpost->have_posts() ) : $popularpost->the_post();?>
					<li class="clearfix">	
						<img src=<?php echo devon_featured_url(); ?>>
						<h5 class="popular">
					        <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
					          <?php the_title(); ?>
					        </a>
						</h5>						
					</li>
				<?php endwhile;?>
			</ul>
		</li>
		<li class="instagram">
			<h3>instagram</h3>
			<?php echo apply_filters( 'the_content',' [instagram-feed num=6 cols=3 showfollow=true followcolor= #3C305E] '); ?>
		</li>
		<li class="categories">
			<?php the_widget('WP_Widget_Categories'); ?> 
		</li>
	</ul>
</div>
	
