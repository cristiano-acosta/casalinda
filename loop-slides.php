<section id="slide">
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
				  <?php
						    }
							endwhile; /* End loop */
				    wp_reset_query();
				  ?>
				</ul>
		  </div>
		</div>
</section>