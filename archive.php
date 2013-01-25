	
		<?php get_header(); ?>
			<div id='main' role='main'>
				<section id="archive">
					<div id="category_affter"></div>
						<div class="container">
							<div class="row">
								<?php if ( is_post_type_archive('promocoes') ) { ?>
									<header class="span12">
										<div class="row">
											<div id="cat_title" class="span8">
												<h1><?php post_type_archive_title(); ?></h1>
											</div>
										</div>
									</header>
									<article id="products" class="span9">
										<?php
										  while ( have_posts() ) : the_post();
										?>
										<div id="article" class="post-<?php the_ID(); ?>">
											<div class="row ">
												<div class="span6">
													<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
													<div class="content"><?php the_content();  ?></div>
													<a class="btn btn-inverse" href="<?php  the_permalink(); ?>"> Saiba mais >></a>
												</div>
												<figure>
													<?php the_post_thumbnail( '', array( 'class' => 'span2' ) ); ?>
												</figure>
											</div>
										</div>
										<?php endwhile; /* wp_reset_query(); */ ?>
									</article>
									<aside class="span3">
										<div id="aside"><h4> Outras Categorias </h4>
											<ul>
												<?php //Script que constroi o menu de categorias filhas da categoria produtos

												$args = array(
													'public' => true,
													'_builtin' => false,
													'exclude_from_search' => false,
												);
												$output = 'objects'; // names or objects
												$post_types = get_post_types($args, $output);
												//print_r( $post_types);
												foreach ($post_types as $post_type) {
													$option = '<li><a href="'.$post_type->permalink_epmask.'">';
													$option .= '<img src="'.get_template_directory_uri().'/img/ico.b.'.$post_type->name.'.png" alt="' . $post_type->description . '" />';
													$option .= ''.$post_type->labels->singular_name.'';
													$option .= '</a></li>';
													echo $option;
												}
												?>

											</ul>
											<div class="clearfix"></div>
										</div>
									</aside>
									<footer class="span12">

									</footer>

								<?php } else { 	?>
								<header class="span12">
									<div class="row">
										<div id="cat_title" class="span8">
											  <?php
													$ico_img = get_post_type_object(  get_query_var( 'post_type' )  );
													echo '<img class="span1" src="'.get_template_directory_uri().'/img/ico.b.'.$ico_img->name.'.png" alt="' . $ico_img->description . '" />';
												?>
												<h1><?php post_type_archive_title(); ?></h1>
										</div>
									</div>
								</header>
								<article id="products" class="span9">
									<?php
									  while ( have_posts() ) : the_post();
									?>
									<div id="article" class="post-<?php the_ID(); ?>">
										<div class="row ">
											<div class="span6">
												<h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
												<p><?php excerpt( '30' );?></p>
												<a class="btn btn-inverse" href="<?php  the_permalink(); ?>"> Saiba mais >></a>
											</div>
											<figure>
												<?php the_post_thumbnail( '', array( 'class' => 'span2' ) ); ?>
											</figure>
										</div>
									</div>
									<?php endwhile; /* wp_reset_query(); */ ?>
								</article>
								<aside class="span3">
									<div id="aside"><h4> Outras Categorias </h4>
										<ul>
											<?php //Script que constroi o menu de categorias filhas da categoria produtos

											$args = array(
												'public' => true,
												'_builtin' => false,
												'exclude_from_search' => false,
											);
											$output = 'objects'; // names or objects
											$post_types = get_post_types($args, $output);
											//print_r( $post_types);
											foreach ($post_types as $post_type) {
												//$option = '<li><a href="'.$post_type->permalink_epmask.'">';
												$option = '<li><a href="'. get_post_type_archive_link( $post_type->name ) .'">';
												$option .= '<img src="'.get_template_directory_uri().'/img/ico.b.'.$post_type->name.'.png" alt="' . $post_type->description . '" />';
												$option .= ''.$post_type->labels->singular_name.'';
												$option .= '</a></li>';
												echo $option;
											}
											?>

										</ul>
										<div class="clearfix"></div>
									</div>
								</aside>
								<footer class="span12">
									
								</footer>
								<?php } ?>
							</div>
				</section>
			</div>
		<?php get_footer(); ?>
		
