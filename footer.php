
<footer>
	<div id="curva">
		<div class="container"></div>
	</div>
	<div id="footer">

		<div class="container">
			<div class="row">
				<?php
					$rodape = new WP_Query( array( 'post_type' => 'page', 'name' => 'rodape' ) );
					while ( $rodape->have_posts() ) : $rodape->the_post();
				?>
				<?php the_content(); ?>
				<?php endwhile; /* End loop */ ?>
					
				<p id="ezcomunicacao" class="span12">
					<a title="Desenvolvimento web criação sites publicidade websites porto alegre RS" href="http://ezcomunicacao.com.br/"></a>
				</p>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
<!-- JavaScript at the bottom for fast page loading: http://developer.yahoo.com/performance/rules.html#js_bottom -->

<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.7.2.min.js"><\/script>')</script>

<!-- scripts concatenated and minified via build script -->
<script src="<?php bloginfo( 'template_url' ); ?>/js/bootstrap.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/bootstrap/transition.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/bootstrap/tab.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/bootstrap/modal.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/bootstrap/dropdown.js"></script>

<script src="<?php bloginfo( 'template_url' ); ?>/js/responsiveslides.js"></script>
<script src="<?php bloginfo( 'template_url' ); ?>/js/casalinda.js"></script>
<!-- end scripts -->

<!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
				 mathiasbynens.be/notes/async-analytics-snippet -->
<script>
	var _gaq = [
		['_setAccount', 'UA-36407033-1'],
		['_trackPageview']
	];
	(function (d, t) {
		var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
		g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g, s)
	}(document, 'script'));
</script>
</body>
</html>