<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!-- Consider specifying the language of your content by adding the `lang` attribute to <html> -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?> > <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <!-- Use the .htaccess and remove these lines to avoid edge case issues.
         More info: h5bp.com/i/378 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>

	    <?php
				if (is_category()) {
                echo 'Categoria &quot;';
                single_cat_title();
                echo '&quot; | ';
                bloginfo('name');
            } elseif (is_tag()) {
                echo 'Tags &quot;';
                single_tag_title();
                echo '&quot; | ';
                bloginfo('name');
            } elseif (is_archive()) {
                wp_title('');
                echo ' | ';
                bloginfo('name');
            } elseif (is_search()) {
                echo 'Busca por &quot;' . wp_specialchars($s) . '&quot; | ';
                bloginfo('name');
            } elseif (is_home()) {
                bloginfo('name');
                echo ' ';
                bloginfo('description');
            } elseif (is_404()) {
                echo 'Error 404 Nada Entrado | ';
                bloginfo('name');
            } elseif (is_single()) {
                wp_title('');
                echo '&quot; | ';
                bloginfo('name');
            } else {
                echo wp_title('');
                echo ' | ';
                bloginfo('name');
        }
      ?>
	  </title>
		<!-- Mobile viewport optimized: h5bp.com/viewport -->
		<meta name="description" content="<?php bloginfo('name'); echo ' '; bloginfo( 'description' ); echo ' : '; wp_title(''); ?>" />
		<meta name="author" content="EZ Comunicação" />
	  <meta name="keywords" content="<?php bloginfo('name'); echo ' | '; if (is_archive()) { wp_title(''); echo ': ';  }   ?>" />
		<meta name="robots" content="index,follow" />

		<!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Wordpress metatags -->
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
	
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
		<link href="favicon.ico" rel="shortcut icon">
		
		<!-- .CSS stylesheets -->
		<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap-responsive.css" />
		<?php /* <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/ttf/font.css" /> */ ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

    <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

    <!-- All JavaScript at the bottom, except this Modernizr build. Modernizr enables HTML5 elements & feature detects for optimal performance. Create your own custom Modernizr build: www.modernizr.com/download/ -->
			
    <script src="<?php bloginfo( 'template_url' ); ?>/js/modernizr-2.5.3.min.js"></script>

	
	<!-- This is used by many Wordpress features and for plugins to work proporly -->
	<?php wp_head(); ?>	

</head>
<body>
    <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
         chromium.org/developers/how-tos/chrome-frame-getting-started -->
    <!--[if lt IE 7]><p class="chromeframe">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <!-- Add your site or application content here -->
		
		<header>
			<div id="header">
				<div class="container">
					<nav class="navbar">
						<div class="container">
							<div class="row">
								<a class="brand" href="<?php bloginfo( 'url' ); ?>/">
									<img alt="<?php bloginfo('name'); ?>" src="<?php bloginfo( 'template_url' ); ?>/img/casalinda-brand.png" />
								</a>
								<div class="span6">
									<?php
										/* $args = array( 'container'  => false, 'menu_class' => 'nav', 'walker'     => new Bootstrap_Walker_Nav_Menu);
										wp_nav_menu( $args );*/
									uberMenu_easyIntegrate();
									?>
								</div>
								<!--/.nav-collapse -->
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>
		<?php
			if( is_front_page() ) {
			get_template_part( 'loop', 'slides' );
			}
		?>
		
		