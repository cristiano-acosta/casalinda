<div id="slide">
	  <div class="container">
		  <div class="row">
			  <ul class="rslides"><!-- aqui vai os post_thumbnail do custon post type slides -->
				  <?php
				  $slides = new WP_Query(array('post_type' => 'slide'));
				  while ($slides->have_posts()) : $slides->the_post();
					  if (has_post_thumbnail()) {
						  ?>
						  <li>
							  <?php the_post_thumbnail('', array('class' => 'full')); ?>
						  </li>
						  <?php } endwhile; /* End loop */ ?>   <?php wp_reset_query(); ?>
			  </ul>
		  </div>
		</div>
 <?php /*
	<div class="container">
		<div class="row">
			<figure>
			<?php
				$casal = new WP_Query( array( 'post_type' => 'post', 'name' => 'casal' ) );
					while ( $casal->have_posts() ) : $casal->the_post();
						if ( has_post_thumbnail() ) {
			?>
				<?php the_post_thumbnail('', array('class' => 'offset8 span4'  )); ?>
			<?php } endwhile;  ?>
			</figure>
		</div>
	</div> */ ?>
</div> <?php wp_reset_query(); ?>	<?php
/*
Template Name: Simulador
*/
?>
		<?php get_header(); ?>
			<div id='main' role='main'>
				<section id="page">
					<div id="category_affter"></div>
					<div class="modal hide" id="myModal">
				    <div class="modal-body">
				      <p>Preencha o formulário abaixo para ter acesso ao simulador.</p>
					    <?php echo do_shortcode('[contact-form-7 id="1397" title="modal contact"]'); ?>

					    <a class="btn btn-inverse hide close" data-dismiss="modal">Fechar ×</a>

					    <a class="btn btn-inverse voltar" href="<?php bloginfo( 'url' ); ?>/" >< Voltar</a>


				    </div>
					</div>
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
										<iframe width="101%" src="http://www.spacedesigner3d.com/Main.html?l=pt"></iframe> 
									</footer>
								<?php endwhile; // end of the loop. ?>	
							</div>
					</div>
				</section>
			</div>
		<?php get_footer(); ?>
		
