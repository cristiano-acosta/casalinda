<?php
/*
Template Name: Produtos
*/
?>
		<?php get_header(); ?>
			<div id='main' role='main'>
				<section id="page">
					<div id="category_affter"></div>
						<div class="container">
							<div class="row">
								<div class="header span12">
									<div class="row">
										<?php while (have_posts()) : the_post(); ?>

												<article id="page-<?php the_ID(); ?>" class="span12">
													<div class="row">
														<h1 class="span12"><?php the_title(); ?></h1>
															<?php if (has_post_thumbnail()) { ?>
																	<div class="span7 entry-content">
																			<!-- The content or the description of the event-->
																			<?php the_content(); ?>

																	</div><!-- .entry-content -->
																	<figure class="span3">
																			<?php the_post_thumbnail( '', array( 'class' => 'span3' ) ); ?>
																	</figure>
																	<?php } else { ?>
																	<div class="span12 entry-content">
																			<?php the_content(); ?>
																	</div>
															<!-- .entry-content --><?php } ?>

													</div>
												</article>
										<?php endwhile; // end of the loop. ?>
									</div>
								</div>
								<article id="products" class="span9">
									<?php
									  $args = array( 'public' => true, '_builtin' => false, 'exclude_from_search' => false, );
										$output = 'objects'; // names or objects
										$post_types = get_post_types($args, $output);
										//print_r( $post_types);
										foreach ($post_types as $post_type) {
									?>
										<div id="archives" class="post-<?php the_ID(); ?>">
											<div class="row">
												<div class="post_type_archive_link span9">
													<a href="<?php print_r(get_post_type_archive_link( $post_type->name )); ?>" title="<?php echo $post_type->name; ?>" rel="bookmark">
														<?php echo '<img class="title_image span1" src="'.get_template_directory_uri().'/img/ico.b.'.$post_type->name.'.png" alt="' . $post_type->description . '" />'; ?>
														<div class="title_text span6">
															<h2 ><?php echo $post_type->labels->singular_name; ?></h2>
														<?php echo category_description( get_category_by_slug( $post_type->name )->term_id ); ?>
														</div>
													</a>
												</div>
													<?php
															$products = new WP_Query( array( 'post_type' => $post_type->name ) );
															while ( $products->have_posts() ) : $products->the_post();
													?>
													<div class="produtos span9">
														<div class="entry span6">
															<h3><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
															<p><?php excerpt( '30' );?></p>

														</div>
														<figure>
														<?php the_post_thumbnail( '', array( 'class' => 'span2' ) ); ?>
															<a class="btn btn-inverse span2" href="<?php  the_permalink(); ?>"> Saiba mais >></a>
														</figure>
													</div>
												  <?php endwhile; /* wp_reset_query(); */ ?>
											</div>
										</div>
									<?php } //endforeach ?>
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
							</div>
				</section>
			</div>
		<?php get_footer(); ?>
		
