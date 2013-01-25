	
		<?php get_header(); ?>
			<div id='main' role='main'>
				<section id="home">
						<div id="products">
							<div class="container">
								<div class="row">
									
									<article class="span12">
										<div class="row">
											<div class="tab-content" id="myTabContent">
												<?php
	                        $args = array( 'public' => true, '_builtin' => false, 'exclude_from_search' => false, );
													$output = 'objects'; // names or objects
													$post_types = get_post_types($args, $output);
													//print_r( $post_types);
													foreach ($post_types as $post_type) {
												?>
													<div class="tab-pane fade" id="<?php echo $post_type->name; ?>">
														<div class="col-1 span6">
															<a href="<?php print_r(get_post_type_archive_link( $post_type->name )); ?>" title="<?php echo $post_type->name; ?>" rel="bookmark">
																<h1><?php echo $post_type->labels->singular_name; ?></h1>
																<?php echo category_description( get_category_by_slug( $post_type->name )->term_id ); ?>
															</a>
														</div>
														<div class="col-2 span6">
															<?php
																$product = new WP_Query(array('post_type' => $post_type->name, 'orderby' => 'rand', 'posts_per_page' => '1','category_name' =>'mostrar-home' ));
																while ($product->have_posts()) : $product->the_post();
															?>
															  <div class="span5"> <?php the_post_thumbnail( '', array( 'class' => 'span5' ) ); ?> </div>
																<h5 class="span5"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a> </h5>
															<?php
																endwhile;
															?>
														</div>
													</div>
												<?php } ?>
											</div>
										</div>
									</article>
									<nav class="span12">
										<ul class="nav nav-tabs" id="myTab">
											<?php //Script que constroi o menu de categorias filhas da categoria produtos

											$args = array( 'public' => true, '_builtin' => false, 'exclude_from_search' => false,  );
											$output = 'objects'; // names or objects
											$post_types = get_post_types($args, $output);
											//print_r( $post_types);
											foreach ($post_types as $post_type) {
												$option = '<li><a href="#'.$post_type->name.'">';
												$option .= '<img src="'.get_template_directory_uri().'/img/ico.'.$post_type->name.'.png" alt="' . $post_type->description . '" />';
												$option .= '<h5>'.$post_type->labels->singular_name.'</h5>';
												$option .= '</a></li>';
												echo $option;
											}
											?>
										</ul>	
									</nav>
									
								</div>
							</div>
							
						</div>
						<div id="simulator">
							<div class="container">
								<div class="row">
									<?php
										$simulador = new WP_Query( array( 'post_type' => 'page', 'name' => 'simulador' ) );
										while ( $simulador->have_posts() ) : $simulador->the_post();
									?>
									<article class="span12">
										<div class="row">
											<div class="col-1 span6">
												<h1><?php the_title(); ?></h1>

												<p><?php the_excerpt(); ?></p>

												<div id="btn">
													<a href="<?php  the_permalink(); ?>" class="btn btn-rosa" style=""> Simule agora >></a>
												</div>
											</div>
											<div class="col-2 span6">
												<figure>
													<?php the_post_thumbnail( '', array( 'class' => 'span6' ) ); ?>
												</figure>
											</div>
										</div>
									</article>
								<?php endwhile; /* End loop */ ?>
								</div>
							</div>
						</div>
				</section>
			</div>
		<?php get_footer(); ?>
		
