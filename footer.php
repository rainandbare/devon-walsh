<footer>
	<section class="instagram">
		<p>Mmmm Instadrool..</p>
		<div>
		<?php echo apply_filters( 'the_content',' [instagram-feed] '); ?></div>
	</section>
  <div class="container clearfix">
	<div class="third footer-logo">
		 <img src="<?php $url = bloginfo( 'url' ); echo $url;?>/wp-content/uploads/2016/12/DWF-Web-Square.jpg"/>
	</div>
	<div class="third footer-links">
		<ul class="links">
			<li>
				<a href="mailto:hello@devonwalsh.com">hello@devonwalsh.com</a>
			</li>
			<li>
				<a href=<?php echo esc_url( get_permalink( get_page_by_title( 'FAQs' ) ) ); ?>>FAQs</a><p style="display: inline; padding: 0px 5px;">|</p>
				<a href=<?php echo esc_url( get_permalink( get_page_by_title( 'Terms & Conditions' ) ) ); ?>>TERMS AND CONDITIONS</a>
			</li>
		</ul>
	</div>
	<div class="third footer-social">
		<ul class="social clearfix">
			<li>
				<a href="http://www.facebook.com">
					<svg viewBox="0 0 512 512">
						<g>
						<path d="M223.22,71.227c16.066-15.298,38.918-20.465,60.475-21.109c22.799-0.205,45.589-0.081,68.388-0.072 c0.09,24.051,0.098,48.111-0.009,72.161c-14.734-0.026-29.478,0.036-44.212-0.026c-9.343-0.582-18.937,6.5-20.635,15.762 c-0.224,16.093-0.081,32.195-0.072,48.289c21.61,0.089,43.22-0.027,64.829,0.054c-1.582,23.281-4.47,46.456-7.858,69.541 c-19.088,0.179-38.187-0.018-57.274,0.099c-0.17,68.665,0.089,137.33-0.134,205.995c-28.352,0.116-56.721-0.054-85.072,0.08 c-0.537-68.674,0.044-137.383-0.295-206.066c-13.832-0.144-27.672,0.099-41.503-0.116c0.053-23.085,0.018-46.169,0.026-69.246 c13.822-0.169,27.654,0.036,41.477-0.098c0.42-22.442-0.421-44.91,0.438-67.333C203.175,101.384,209.943,83.493,223.22,71.227z"/>
						</g>
					</svg>
				</a>
			</li>
			<li>
				<a href="http://www.instagram.com">
					<svg viewBox="0 0 504 504">
						<path d="M252 45h102c25 1 38 5 47 9a78 78 0 0 1 29 19 78 78 0 0 1 19 29c3 9 8 22 9 47s1 35 1 102 0 75-1 102-5 38-9 47a83 83 0 0 1-48 48c-9 3-22 8-47 9H150c-25-1-38-5-47-9a78 78 0 0 1-29-19 78 78 0 0 1-19-29c-3-9-8-22-9-47s-1-35-1-102 0-75 1-102 5-38 9-47a78 78 0 0 1 19-28 78 78 0 0 1 29-19c9-3 22-8 47-9h102m0-45L148 2c-27 1-45 5-61 12a123 123 0 0 0-45 28 123 123 0 0 0-29 45c-6 16-10 34-12 61s-1 36-1 104 0 77 2 104 5 45 12 61a123 123 0 0 0 29 45 123 123 0 0 0 45 29c16 6 34 10 61 12l104 2 104-2c27-1 45-5 61-12a129 129 0 0 0 74-74c6-16 10-34 12-61s2-35 2-104 0-77-2-104-5-45-12-61a123 123 0 0 0-29-45 123 123 0 0 0-45-29c-16-6-34-10-61-12L252 0z"/>
						<path class="a" d="M252 123a129 129 0 1 0 129 129 129 129 0 0 0-129-129zm0 213a84 84 0 1 1 84-84 84 84 0 0 1-84 84z"/>
						<circle class="a" cx="386" cy="117" r="30"/>
					</svg>
				</a>
			</li>
		</ul>
	</div>
    <!-- <p>&copy; Devon Walsh Foods <?php echo date('Y'); ?></p>
 -->  
 </div>
</footer>

<script>
// scripts.js, plugins.js and jquery are enqueued in functions.php
/* Google Analytics! */
 var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]]; // Change UA-XXXXX-X to be your site's ID
 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
 g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
 s.parentNode.insertBefore(g,s)}(document,"script"));
</script>

<?php wp_footer(); ?>
</body>
</html>