	<?php
/*
Template Name: padrão
*/
?>
		<?php get_header(); ?>
			<div id='main' role='main'>
				<section id="page">
					<div id="category_affter"></div>
						<div class="container">
							<div class="row">
								<?php while (have_posts()) : the_post(); ?>
									<header class="span12">
										<h1 class="entry-title"><?php the_title(); ?></h1>
									</header>
									<article id="page-<?php the_ID(); ?>" class="span12">
										<div class="row">
												<?php if (has_post_thumbnail()) { ?>
														<div class="span8 entry-content">
																<!-- The content or the description of the event-->
																<?php the_content(); ?>
																
														</div><!-- .entry-content -->
														<figure class="span3">
																<?php the_post_thumbnail( '', array( 'class' => 'span3' ) ); ?>
														</figure>
														<?php } else { ?>
														<div class="span9 entry-content">
																<?php the_content(); ?>
														</div>
												<!-- .entry-content --><?php } ?>
											
										</div>				
									</article>
									
									<footer class="span12">
										
										
										
									</footer>
								<?php endwhile; // end of the loop. ?>	
							</div>
						</div>
				</section>
			</div>
		<?php get_footer(); ?>
		
