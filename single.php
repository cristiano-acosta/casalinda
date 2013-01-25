	
		<?php get_header(); ?>
			<div id='main' role='main'>
				<section id="single">
					<div id="category_affter"></div>
					<div class="container">
						<div class="row">
							
                <div id="article" >
										<?php while (have_posts()) : the_post(); ?>
											<article id="post-<?php the_ID(); ?>" class="span9">
													<div class="row">
														<header class="span12 entry-header">
																<h1 class="entry-title"><?php the_title(); ?></h1>
																<br/>
														</header>
														<?php /*	<?php if (has_post_thumbnail()) { ?>
														<div class="span4 entry-content">
																<!-- The content or the description of the event-->
																<?php the_content(); ?>
																
														</div><!-- .entry-content -->
														<figure class="span4">
																<?php the_post_thumbnail( '', array( 'class' => 'span3' ) ); ?>
														</figure>
														<?php } else { ?>*/ ?>
														<div class="span9 entry-content">
																<?php the_content(); ?>
														</div><!-- .entry-content -->
														<?php //} ?>
														<footer class="span12 entry-footer">
														<p><b> Compartilhe </b></p>
														<span class='st_facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='facebook'></span><span class='st_twitter' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='twitter'></span><span class='st_linkedin' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='linkedin'></span><span class='st_email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='email'></span><span class='st_sharethis' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='sharethis'></span><span class='st_fblike' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' displayText='fblike'></span>
														</footer>
														<!-- .entry-meta -->
													</div>
											</article>
										<?php endwhile; // end of the loop. ?>
                    <!-- #post-<?php the_ID(); ?> -->
									<aside class="span3">
									<div id="aside">
										<div id="post_more"> 
											<h4>
												<?php
													$category =  get_categories( array(  'exclude' => get_cat_id( 'mostrar.home' ),'hide_empty' => 0  ));
													echo '<img src="'.get_template_directory_uri().'/img/ico.b.'.$category[0]->slug.'.png" alt="' . $category->cat_name . '" />';
													echo $category[0]->cat_name;
												?>
											</h4>
											<ul>
												<?php
													$product = new WP_Query(array('post_type' => $category->cat_name, 'cat' => $category[0]->cat_ID, ));
													while ($product->have_posts()) : $product->the_post();
												?>
													<li>
														<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
															
															<h5><?php the_title(); ?></h5>
															
														</a>
													</li>
												<?php endwhile; /* wp_reset_query(); */ ?>
											</ul>
										</div>
										<div id="category_more" >
											<h4> Outras Categorias </h4>
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
										</div>
										<div class="clearfix"></div>
										</div>
									</aside>
								</div>
            </div>		
					</div>	
				</section>
			</div>
		<?php get_footer(); ?>
		
