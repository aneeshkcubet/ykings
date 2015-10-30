<?php get_header(); ?>
<?php 
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
?>
<?php  tfuse_shortcode_content('before'); ?>
<?php get_template_part('workouts','filter');?>
<section class="main-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul id="workoutlist" class="workoutlist">
                            <?php
                            $the_query = new WP_Query( array('posts_per_page' => -1, 
                                                             'post_type' => 'workout',
                                                             'tax_query' => array(
                                                                array(
                                                                        'taxonomy' => $term->taxonomy,
                                                                        'field' => 'slug',
                                                                        'terms' => $term->slug
                                                                )
                                                        )) );
                            if (have_posts()) 
                            { $count = 0;
                                while ($the_query->have_posts()) : $the_query->the_post(); $count++;
                                    get_template_part('listing', 'workouts');
                                endwhile; ?>
                            
                                <li class="workout-item workout-item-dummy animatedFast hidden">
                                    <div class="workout-image"><i class="tficon-plus"></i></div>
                                    <div class="workout-title-before"></div>
                                    <h4 class="workout-title"><?php _e('More coming soon', 'tfuse'); ?>...</h4>
                                    <div class="workout-desc">
									<p><?php _e('We are currently working hard on adding a few more workouts to this list. Stay tuned!','tfuse');?></p>
                                    </div>
                                </li>
                            <?php } 
                            else 
                            { ?>
                                <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
                      <?php } ?>
                        </ul>
            <div class="nothing-found animatedFast hidden"><?php _e('Ops, no results found. Please select other option','tfuse');?></div>
            </div>
        </div>
    </div>
</section>
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();?>