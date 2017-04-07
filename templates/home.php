<?php

/*
	Template Name: Home
*/

get_header();  ?>

<main>
  	<header class="header-home clearfix" style="background: url(<?php the_field("home_header_image") ?>);  background-size: cover;">
	    <h2><?php the_field( "header" ); ?></h2>
    </header>
    <section class="summary">
	    <div class="container">
	    	<div class="fruitsOTS">
								<img class="fruit2" src=<?php the_field("fruit_2"); ?>>
				<h3><?php the_field("summary_title"); ?></h3>
	    	</div>
		    <ul class="summary clearfix">


			    <li class="third">
			    	<img src=<?php the_field("summary_image_1"); ?> />
			    	<div>
				    	<h4><?php the_field("summary_subtitle_1"); ?></h4>
				    	<p><?php the_field("summary_content_1"); ?></p>
				    </div>
			    </li>
			     <li class="third">
			     	<img src=<?php the_field("summary_image_2"); ?> />
			     	<div>
				    	<h4><?php the_field("summary_subtitle_2"); ?></h4>
				    	<p><?php the_field("summary_content_2"); ?></p>
				    </div>
			    </li>
			     <li class="third">
			     	<img src=<?php the_field("summary_image_3"); ?> />
			     	<div>
				    	<h4><?php the_field("summary_subtitle_3"); ?></h4>
				    	<p><?php the_field("summary_content_3"); ?></p>
				    </div>
			    </li>
			 </ul>
		</div>
	</section>
	<section class="process">
		<div class="container">
			<h3><?php the_field("process_title"); ?><!-- <img class="fruit1" src=<?php //the_field("fruit_1"); ?>> -->
				
			</h3>

			<ul>
				<li class="clearfix">
					<div class="icon">
					<svg viewBox="-365 248.3 90 90" style="enable-background:new -370 248.3 90 90;" xml:space="preserve">
<path d="M-298.6,390.5l-12.4,12.4c-0.8,0.8-1.9,1.2-3,1.2c-0.8,0-1.6,0.3-2.3,0.8l0,0l-3.7,4l0,0l-22.9,25.8  c-1.6,1.7-4.3,1.7-6,0c-1.7-1.7-1.7-4.4,0-6l24.5-24.5l3.5-3.5l0,0l25.9-25.9c1.1-1.1,2.9-1.1,4,0  C-286.6,379.1-298.6,390.5-298.6,390.5z"/>
<path d="M-322.1,399.4l1.4,1.2l-3.5,3.5l-1.2-1.4c-0.9-0.9-2-1.5-3.2-1.8l-5.1-1.2c-1.3-0.3-2.5-0.9-3.5-1.9  c-0.2-0.2-0.4-0.5-0.6-0.7l-14-14.8c-0.5-0.5-0.5-1.2,0-1.7c0.2-0.2,0.4-0.3,0.7-0.3c0.3,0,0.6,0,0.8,0.2c0.1,0,0.1,0.1,0.2,0.2  l13.3,12.9l0.1,0.1c0,0,0.1,0.1,0.1,0.1c0,0,0,0,0,0c0,0,0,0,0,0c0.4,0.3,1,0.3,1.4,0c0,0,0.1-0.1,0.1-0.1c0.4-0.4,0.5-1.1,0.1-1.6  c0,0,0,0,0,0c0,0,0,0-0.1-0.1l-0.1-0.1l-12.9-13.3c-0.5-0.5-0.5-1.2,0-1.7c0.5-0.5,1.2-0.5,1.7,0l13.5,13c0,0,0,0,0,0l0,0  c0.5,0.4,1.2,0.4,1.6,0c0,0,0.1-0.1,0.1-0.1c0.3-0.4,0.3-0.8,0.1-1.2c0,0,0-0.1-0.1-0.1c0-0.1-0.1-0.1-0.2-0.2c0,0-0.1-0.1-0.2-0.1  c0,0,0,0,0,0c0,0,0,0,0,0l-12.8-13.2c-0.1-0.1-0.1-0.1-0.2-0.2c-0.2-0.2-0.2-0.5-0.2-0.8c0,0,0,0,0,0c0-0.3,0.1-0.5,0.3-0.7  c0.5-0.5,1.2-0.5,1.7,0l14.8,14c0.2,0.2,0.5,0.4,0.7,0.6c1,1,1.6,2.2,1.9,3.5l1.2,5.1C-323.7,397.4-323.1,398.5-322.1,399.4z"/>
<path d="M-289,436c-1.7,1.7-4.4,1.7-6,0l-24.5-26.6l-0.4-0.4l3.7-4l0.5,0.4L-289,430C-287.3,431.6-287.3,434.3-289,436z  "/>
<path d="M-288.3,322.6l-26.2-24.1c0.2,0,0.4-0.1,0.6-0.1c1.4-0.1,2.7-0.6,3.6-1.5l12.3-12.3c0.4-0.3,8.8-8.5,8.9-14  c0-1.3-0.4-2.3-1.2-3.1c-1.4-1.4-4-1.4-5.4,0l-25.2,25.2l-0.6-0.6c-0.8-0.8-1.3-1.7-1.6-2.7l-1.2-5.1c-0.3-1.5-1.1-2.9-2.2-4  c-0.2-0.2-0.5-0.4-0.7-0.6l-14.8-14c-0.8-0.8-2.3-0.8-3.1,0c-0.4,0.3-0.6,0.8-0.6,1.3c0,0,0,0,0,0.1c0,0.5,0.1,1,0.3,1.4  c0,0,0.1,0.1,0.1,0.1c0,0.1,0.1,0.1,0.2,0.2l12.7,13.1c0.1,0.1,0.2,0.2,0.3,0.2c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0  c0,0,0,0.1,0,0.2c-0.1,0.1-0.2,0.1-0.3,0c0,0,0,0,0,0c0,0,0,0,0,0l-13.4-13c-0.8-0.8-2.3-0.8-3.1,0c-0.8,0.8-0.8,2.2,0,3.1  l12.9,13.3l0.1,0.1c0,0,0.1,0.1,0.1,0.1c0,0.1,0,0.1,0,0.2c-0.1,0-0.1,0.1-0.2,0c0,0,0,0,0,0l0,0l-13.4-13c-0.1-0.1-0.2-0.2-0.3-0.2  c0,0-0.1-0.1-0.1-0.1c-0.4-0.2-0.8-0.3-1.2-0.3c-0.1,0-0.2,0-0.3,0c-0.5,0.1-0.9,0.3-1.3,0.6c-0.4,0.4-0.6,1-0.6,1.5  s0.2,1.1,0.6,1.5l14,14.8c0.2,0.3,0.4,0.5,0.7,0.8c1.1,1.1,2.5,1.8,4,2.2l5.1,1.2c1,0.3,1.9,0.8,2.7,1.6l0.6,0.6l-23.9,23.9  c-2,2-2,5.4,0,7.4c1,1,2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.6l22.1-25l24.2,26.3c1,1,2.3,1.5,3.7,1.5c1.4,0,2.7-0.5,3.7-1.5  c1-1,1.5-2.3,1.5-3.7S-287.3,323.6-288.3,322.6z M-344.4,267.9l0.3-0.4l0.3-0.2L-344.4,267.9z M-324.2,296l-0.6-0.6  c-1-1-2.3-1.7-3.6-2.1l-5.1-1.2c-1.1-0.3-2.2-0.8-3-1.7c-0.2-0.2-0.4-0.4-0.6-0.7l-14.1-14.9c0,0-0.1-0.1-0.1-0.1c0,0,0-0.1,0.1-0.1  c0,0,0.1,0,0.1-0.1c0,0,0.1,0,0.1,0c0,0,0.1,0.1,0.1,0.1l13.3,12.8l0.1,0.1c0,0,0.1,0.1,0.1,0.1c0,0,0.1,0.1,0.1,0.1  c0.8,0.5,1.8,0.5,2.6,0c0.1-0.1,0.2-0.1,0.2-0.2c0.8-0.8,0.8-2,0.2-2.9c0,0,0,0,0,0c0,0-0.1-0.1-0.1-0.1c0,0,0-0.1-0.1-0.1l-13-13.4  c-0.1-0.1-0.1-0.2,0-0.3c0.1-0.1,0.2-0.1,0.3,0l13.5,13c0,0,0,0,0.1,0.1l0,0c0.8,0.8,2.2,0.7,3-0.1c0.1-0.1,0.2-0.2,0.2-0.3  c0.4-0.6,0.5-1.4,0.2-2.1c0-0.1-0.1-0.2-0.1-0.2c0-0.1-0.1-0.1-0.1-0.1c-0.1-0.1-0.2-0.2-0.3-0.3c0,0-0.1-0.1-0.2-0.1  c-0.1-0.1-0.1-0.1-0.2-0.1l-12.7-13.2l0,0c0-0.1,0-0.1,0-0.2c0,0,0,0,0,0c0,0,0-0.1,0.1-0.1c0.1-0.1,0.2-0.1,0.3,0l14.9,14  c0.2,0.2,0.5,0.4,0.7,0.6c0.8,0.8,1.4,1.9,1.6,3l1.2,5.2c0.4,1.4,1.1,2.6,2.1,3.6l0.6,0.5l-0.9,0.9L-324.2,296z M-343.5,327.3  c-1.2,1.2-3.4,1.2-4.6,0c-1.3-1.3-1.3-3.3,0-4.6l26.6-26.6l1.4-1.4c0,0,0,0,0,0l25.9-25.9c0.3-0.3,0.8-0.5,1.3-0.5  c0.5,0,0.9,0.2,1.3,0.5c0.4,0.4,0.6,1,0.6,1.7c0,3.8-6,10.4-8.3,12.6l-12.4,12.4c-0.7,0.7-1.7,0.9-2.3,1c-1,0-2,0.4-2.8,1  c-0.1,0-0.1,0.1-0.2,0.1l-3.7,4c0,0,0,0,0,0c0,0,0,0,0,0L-343.5,327.3z M-289.7,328.6c-0.6,0.6-1.4,1-2.3,1c-0.9,0-1.7-0.3-2.3-0.9  l-24.3-26.4l1.4-1.5l1-1.1l26.5,24.4c0.6,0.6,1,1.4,1,2.3C-288.7,327.2-289.1,328-289.7,328.6z"/><!-- Created by Adèle Foucart --></svg>
					</div>
					<div class="description">
						<h4><?php the_field("process_list_item_title_1"); ?></h4>
						<p><?php the_field("process_list_item_1"); ?></p>
					</div>
				</li>
				<li class="clearfix">
					<div class="icon">
							<svg viewBox="0 0 85 85" enable-background="new 0 0 85 85" xml:space="preserve">
								<title>drumstick</title>
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<g stroke="#FFF" stroke-width="2">
										<g transform="translate(44.500000, 47.500000) rotate(-44.000000) translate(-44.500000, -47.500000) translate(26.000000, 15.000000)">
											<path d="M18.599134,42.7543106 C27.0150955,42.7543107 36,36.6253539 36,23.7443308 C36,10.8633077 24.6188231,0.421175253 18.5991342,0.421175253 C12.5794454,0.421175253 1.19826846,10.8633077 1.19826846,23.7443308 C1.19826846,36.6253539 10.1831725,42.7543105 18.599134,42.7543106 Z" transform="translate(18.599134, 21.587743) scale(1, -1) rotate(-1.000000) translate(-18.599134, -21.587743) "/>
											<path d="M15.5308749,42.3740139 L15.530875,57.3420685 C15.530875,57.3420685 12.3766338,59.0620779 12.3766338,61.6982283 C12.3766338,64.3343786 15.4860565,65.2058165 18.3744547,63.0425867" stroke-linecap="round"/><path d="M21.5308749,42.4532738 L21.530875,57.3420685 C21.530875,57.3420685 18.3766338,59.0620779 18.3766338,61.6982283 C18.3766338,64.3343786 21.4860565,65.2058165 24.3744547,63.0425867" stroke-linecap="round" transform="translate(21.375544, 53.358743) scale(-1, 1) translate(-21.375544, -53.358743) "/>
										</g>
									</g>
								</g><!-- Created by Kevin from the Noun Project -->
							</svg>
					</div>
					<div class="description">
						<h4><?php the_field("process_list_item_title_2"); ?></h4>
						<p><?php the_field("process_list_item_2"); ?></p>
					</div>
				</li>
				<li class="clearfix">

					<div class="icon">
							<svg viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
								<path d="M80,48.5c-1.9,0-3.8,0.4-5.4,1.1l-5.7-10.3c0,0,0,0,0,0L71,34h4c0.8,0,1.5-0.7,1.5-1.5S75.8,31,75,31H65  c-0.8,0-1.5,0.7-1.5,1.5S64.2,34,65,34h2.7l-1.9,4.5H37.4l0.1-0.2c1.1-2.1,0.4-4.8-1.6-6.1l-3.6-2.4c-0.5-0.3-0.8-0.9-0.8-1.5  c0-1,0.8-1.8,1.8-1.8H40c0.8,0,1.5-0.7,1.5-1.5s-0.7-1.5-1.5-1.5h-6.7c-2.6,0-4.8,2.1-4.8,4.8c0,1.6,0.8,3.1,2.1,4l3.6,2.4  c0.7,0.5,1,1.5,0.6,2.3l-7.1,14c-2.2-1.5-4.9-2.4-7.8-2.4c-7.7,0-14,6.3-14,14s6.3,14,14,14s14-6.3,14-14c0-3.7-1.5-7.1-3.8-9.6  l2.9-5.7l18.4,12.9c-0.3,0.7-0.5,1.5-0.5,2.4c0,3.6,2.9,6.5,6.5,6.5c0,0,0.1,0,0.1,0l0.5,2h-0.6c-0.8,0-1.5,0.7-1.5,1.5  s0.7,1.5,1.5,1.5h5c0.8,0,1.5-0.7,1.5-1.5S63.3,71,62.5,71h-1.3l-0.7-2.7c1.7-0.9,2.9-2.4,3.3-4.3h2.3c0.8,7,6.7,12.5,13.9,12.5  c7.7,0,14-6.3,14-14S87.7,48.5,80,48.5z M31,62.5c0,6.1-4.9,11-11,11s-11-4.9-11-11s4.9-11,11-11c2.4,0,4.6,0.8,6.4,2.1l-0.3,0.5  l-0.1,0.1c-1.1,2.8-3.6,5.3-6.8,6.9c-0.7,0.4-1,1.3-0.7,2c0.3,0.5,0.8,0.8,1.3,0.8c0.2,0,0.5-0.1,0.7-0.2c3.7-1.8,6.6-4.8,8-8.1  C30.1,57.6,31,60,31,62.5z M73.4,53.7l4,7.3h-8.3C69.5,58,71.1,55.4,73.4,53.7z M34.4,44.5l1.5-3h28.7l-6.1,14.6  c-0.3-0.1-0.7-0.1-1-0.1c0,0-0.1,0-0.1,0l-0.5-2h0.6c0.8,0,1.5-0.7,1.5-1.5S58.3,51,57.5,51h-5c-0.8,0-1.5,0.7-1.5,1.5  s0.7,1.5,1.5,1.5h1.3l0.7,2.7c-0.5,0.3-0.9,0.6-1.3,0.9L34.4,44.5z M57.5,66c-1.9,0-3.5-1.6-3.5-3.5c0-1.1,0.5-2,1.3-2.7l0.8,3  c0.2,0.7,0.8,1.1,1.5,1.1c0.1,0,0.2,0,0.4,0c0.8-0.2,1.3-1,1.1-1.8l-0.8-3.1c1.6,0.3,2.8,1.7,2.8,3.4C61,64.4,59.4,66,57.5,66z   M63.8,61c-0.4-1.5-1.3-2.9-2.5-3.8l6-14.5l4.6,8.3c-3.2,2.3-5.4,5.8-5.9,9.9H63.8z M80,73.5c-5.6,0-10.1-4.1-10.9-9.5H80  c0.5,0,1-0.3,1.3-0.7s0.3-1,0-1.5L76,52.3c1.2-0.5,2.6-0.8,4-0.8c6.1,0,11,4.9,11,11S86.1,73.5,80,73.5z"/>
							</svg>
					</div>
					<div class="description">
						<h4><?php the_field("process_list_item_title_3"); ?></h4>
						<p><?php the_field("process_list_item_3"); ?></p>
					</div>
				</li>
				<li class="clearfix">
					<div class="icon last">
							<svg viewBox="0 0 200 200" enable-background="new 0 0 100 100"><path fill="none" stroke="#FFF" stroke-width="7" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M40.554,109.564c29.743-0.064,26.018-16.816,36.877-30.031c13.954-16.979,34.14-17.734,34.14-61.852c0,0,0.748-0.09,1.972-0.09  c5.308,0,19.496,1.713,19.594,20.018c0.099,18.435-9.932,25.039-9.932,36.713c0,7.062,5.728,12.788,12.792,12.788h22.504  c6.661,0,12.062,5.399,12.062,12.058c0,5.13-3.212,9.501-7.726,11.243h0.563c6.659,0,12.058,5.397,12.058,12.056  c0,6.662-5.398,12.06-12.058,12.06l0,0c3.941,1.708,7.746,5.987,7.746,11.016c0,6.521-5.716,10.813-11.531,10.813  c0,0,3.612,2.401,3.612,8.734s-5.535,9.73-12.152,9.73c-79.731,0-79.887-16.214-110.518-16.214"/><!-- Created by Rudy Jaspers --></svg>
					</div>
					<div class="description">
						<h4><?php the_field("process_list_item_title_4"); ?></h4>
						<p><?php the_field("process_list_item_4"); ?></p>
					</div>	
				</li>
			</ul>
		</div>
	</section>
	<section class="delivery clearfix">
		<div class="two-thirds">
			<img src="<?php the_field("delivery_image"); ?>" alt="Delivery Map">
		</div>
		<div class="third delivery-content">
			<h3><?php the_field("delivery_title"); ?></h3>
			<h6><?php the_field("delivery_subtitle"); ?></h6>
			<p><?php the_field("delivery_content"); ?></p>
			<button class="c-2-a" >
				<a href="#">Get Started</a>
			</button>
		<div>
	</section>
	<section class="order">
		<div class="container">
			<h3><?php the_field("order_title"); ?></h3>
			<div class="orderOption">
				<h4><?php the_field("order_option_title_1"); ?></h4>
				<p><?php the_field("order_option_content_1"); ?></p>
				<button class="c-2-a" >
					<a href="#">Order Now</a>
				</button>
			</div>
			<img src=<?php the_field("fruit_3"); ?> alt="An illustrated orange"/>
		</div>
	</section>
	<section class="testimonials">
		<div class="container">
			<h3><?php the_field("testimonials_title"); ?></h3>
			<img src=<?php the_field("testimonials_image"); ?> alt="Devon Walsh Foods" />
			 <?php
			 $params = array(
	            'posts_per_page' => -1,
	            'post_type' => 'testimonial',
	            'order' => 'ASC'        
            	); 
        	$testimonialsQuery= new WP_Query($params); 
    ?>
  <?php if ($testimonialsQuery->have_posts()) :  ?>
    <?php while ($testimonialsQuery->have_posts()) : 
                $testimonialsQuery->the_post();  ?>
      <div class="testimonial">
		<?php the_content();?>
		<div class="signOff">
	        <p class="name">-<?php the_title();?></p>
	        <p class="subtitle"><?php the_field('subtitle');?></p>
        </div>
       </div>
    <?php endwhile; ?>
</ul>
  <?php wp_reset_postdata();  ?>
<?php endif; ?>

		</div>
	</section>
	<section class="bio">
		<div class="container clearfix">
				<div class="two-thirds bio-content">
					<h3><?php the_field("bio_title"); ?></h3>
					<p><?php the_field("bio_content"); ?></p>
					<button class="c-2-a"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Menu' ) ) ); ?>">Check out this weeks menu</a></button>
				</div>
				<div class="third">
					<img src=<?php the_field("bio_image"); ?> alt="The lovely Devon Walsh cooking up a storm">
				</div>
				
		</div>
	</section>
    <?php // Start the loop ?>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <?php //the_content(); ?> 

    <?php endwhile; // end the loop?>
</main> 

<?php get_footer(); ?>