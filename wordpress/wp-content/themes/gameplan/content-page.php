<?php 
	if ( have_posts() ) : 
		while ( have_posts() ) : the_post(); 
			the_content();
			wp_link_pages();
			?>
			<?php
			$social_post= get_post_meta($post->ID,'showhide_social',true);
				if($social_post=='show'){ //check if show social share
					echo '<div class="container-pad">';
					gp_social_share(get_the_ID());
					echo '</div>';
				}
				if($social_post=='def'){
				if(ot_get_option( 'page_show_socialsharing', 1)){ //check if show social share
					echo '<div class="container-pad">';
					gp_social_share(get_the_ID());
					echo '</div>';
				}
				}
			?>
			<?php if(ot_get_option('page_show_authorbio',0) != 0){?>
				<div id="author-bio">
                	<div class="container-pad">
                      <div class="dotted-title">
                            <h3><?php echo esc_html__('About The Author','cactusthemes'); ?></h3>
                            <div class="dotted"></div>
                      </div>
                      <div id="author-content">
                        <div id="author-avatar">
                            <?php echo get_avatar( get_the_author_meta('email'), '90' ); ?>
                        </div>
                        <h4><?php the_author(); ?></h4>
                        <?php the_author_meta('description'); ?>                          
                        <div class="clear"><!-- --></div>
                      </div> 
                      <div class="clear"><!-- --></div>
                  </div>
				</div>
			<?php }
			echo '<div class="container-pad">';
			comments_template( '', true );
			echo '</div>';
		endwhile; 
	endif; 
	?>