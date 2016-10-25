<?php get_header(); ?>
<?php  
    tfuse_shortcode_content('before'); 
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
?>
<section class="main-row">
    <div id="postlist-nutritions" class="postlist-services">
        <div class="container">
            <div class="row" id="content_load">
                <?php if (have_posts()) 
                 { $count = 0;
                    while (have_posts()) : the_post(); 
                            get_template_part('listing','services');
                        $count++;
                    endwhile;
                 } 
                 else 
                 { ?>
                     <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
            <?php } ?>
            </div>
            <?php if(tfuse_options('pagination_type') == 'type2'):?>
                <div class="row text-center blog">
                   <a href="#" class="btn btn-transparent btn-padding-big" id="ajax_load_posts"><span><?php _e('LOAD MORE','tfuse');?></span></a>
               </div>
            <?php endif;?>
        </div>
    </div>
</section>
<?php if(tfuse_options('pagination_type') == 'type1'):?>
    <div class="services-pagination">
        <?php  tfuse_pagination();?>
    </div>
<?php endif;?>
<?php  tfuse_shortcode_content('after'); ?>
<?php  $id = tfuse_get_cat_id();?>
<input type="hidden" value="<?php echo $id; ?>" name="current_cat"  />
<input type="hidden" value="<?php echo $term->taxonomy;?>" name="is_this_tax"  />
<?php get_footer();?>