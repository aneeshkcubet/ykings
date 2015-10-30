<?php
/**
 * Create custom posts types
 *
 * @since  In Shape 1.0
 */

if ( !function_exists('tfuse_create_custom_post_types') ) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_create_custom_post_types()
    {
		//Reservation_form
		        $labels = array(
                        'name' => __('Reservation', 'tfuse'),
                        'singular_name' => __('Reservation', 'tfuse'),
                        'add_new' => __('Add New', 'tfuse'),
                        'add_new_item' => __('Add New Reservation', 'tfuse'),
                        'edit_item' => __('Edit Reservation info', 'tfuse'),
                        'new_item' => __('New Reservation', 'tfuse'),
                        'all_items' => __('All Reservations', 'tfuse'),
                        'view_item' => __('View Reservation info', 'tfuse'),
                        'parent_item_colon' => ''
                );
                $reservationform_rewrite=apply_filters('tfuse_reservationform_rewrite','reservationform_list');
                $res_args = array(
                                'labels' => $labels,
                                'public' => true,
                                'publicly_queryable' => false,
                                'show_ui' => false,
                                'query_var' => true,
                                'exclude_from_search'=>true,
                                //'menu_icon' => get_template_directory_uri() . '/images/icons/doctors.png',
                                'has_archive' => true,
                                'rewrite' => array('slug'=> $reservationform_rewrite),
                                'menu_position' => 6,
                                'supports' => array(null)
                        );
               register_taxonomy('reservations', array('reservations'), array(
                            'hierarchical' => true,
                            'labels' => array(
                                'name' => __('Reservation Forms', 'tfuse'),
                                'singular_name' => __('Reservation Form', 'tfuse'),
                                'add_new_item' => __('Add New Reservation Form', 'tfuse'),
                            ),
                            'show_ui' => false,
                            'query_var' => true,
                            'rewrite' => array('slug' => $reservationform_rewrite)
                        ));
                        register_post_type( 'reservations' , $res_args );
        // Games
        $labels = array(
                'name' => __('Workouts', 'tfuse'),
                'singular_name' => __('Workout', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Workout', 'tfuse'),
                'edit_item' => __('Edit workout', 'tfuse'),
                'new_item' => __('New Workout', 'tfuse'),
                'all_items' => __('All Workouts', 'tfuse'),
                'view_item' => __('View Workout info', 'tfuse'),
                'search_items' => __('Search Workouts', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $workoutlist_rewrite = apply_filters('tfuse_workoutlist_rewrite','all-workout-list');
        
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $workoutlist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $workoutlist_taxonomy_rewrite = apply_filters('tfuse_workoutlist_taxonomy_rewrite','workout-list');
        register_taxonomy('workouts', array('workout'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $workoutlist_taxonomy_rewrite)
        ));
        
        $labels = array(
            'name' => __('Difficulties','tfuse' ),
            'singular_name' => __('Difficulty', 'tfuse'),
            'search_items' => __('Search Difficulties','tfuse'),
            'popular_items' => __( 'Popular Difficulties','tfuse' ),
            'all_items' => __('All Difficulties','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Difficulty','tfuse'),
            'update_item' => __('Update Difficulty','tfuse'),
            'add_new_item' => __('Add New Difficulty','tfuse'),
            'new_item_name' => __('New Difficulty Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate difficulties with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove difficulties','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used difficulties','tfuse' ),
        );
		
            $difficultieslist_taxonomy_tags_rewrite = apply_filters('tfuse_workoutlist_taxonomy_difficulties_rewrite','difficulty-list'); 
		
            register_taxonomy('difficulties', 'workout', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $difficultieslist_taxonomy_tags_rewrite)
            ));   
            
        
            
        $labels = array(
            'name' => __('Goals','tfuse' ),
            'singular_name' => __('Goal', 'tfuse'),
            'search_items' => __('Search Goals','tfuse'),
            'popular_items' => __( 'Popular Goals','tfuse' ),
            'all_items' => __('All Goals','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Goal','tfuse'),
            'update_item' => __('Update Goal','tfuse'),
            'add_new_item' => __('Add New Goal','tfuse'),
            'new_item_name' => __('New Goal Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate goals with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove goals','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used goals','tfuse' ),
        );
		
            $goalslist_taxonomy_tags_rewrite = apply_filters('tfuse_workoutlist_taxonomy_goals_rewrite','goal-list'); 
		
            register_taxonomy('goals', 'workout', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $goalslist_taxonomy_tags_rewrite)
            ));  
            
            $labels = array(
            'name' => __('Durations','tfuse' ),
            'singular_name' => __('Duration', 'tfuse'),
            'search_items' => __('Search Durations','tfuse'),
            'popular_items' => __( 'Popular Durations','tfuse' ),
            'all_items' => __('All Durations','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Duration','tfuse'),
            'update_item' => __('Update Duration','tfuse'),
            'add_new_item' => __('Add New Duration','tfuse'),
            'new_item_name' => __('New Duration Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate durations with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove durations','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used durations','tfuse' ),
        );
		
            $durationlist_taxonomy_tags_rewrite = apply_filters('tfuse_workoutlist_taxonomy_durations_rewrite','duration-list'); 
		
            register_taxonomy('durations', 'workout', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $durationlist_taxonomy_tags_rewrite)
            ));   
            
            
        register_post_type( 'workout' , $args );
        
        // Trainings
        $labels = array(
                'name' => __('Trainings', 'tfuse'),
                'singular_name' => __('Session', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Session', 'tfuse'),
                'edit_item' => __('Edit Session', 'tfuse'),
                'new_item' => __('New Session', 'tfuse'),
                'all_items' => __('All Sessions', 'tfuse'),
                'view_item' => __('View Session', 'tfuse'),
                'search_items' => __('Search Sessions', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title')
        ); 

        register_post_type( 'session' , $args );
        
        // Exercises
        $labels = array(
                'name' => __('Exercises', 'tfuse'),
                'singular_name' => __('Exercise', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Exercise info', 'tfuse'),
                'new_item' => __('New Exercise', 'tfuse'),
                'all_items' => __('All Exercises', 'tfuse'),
                'view_item' => __('View Exercise info', 'tfuse'),
                'search_items' => __('Search Exercise', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $exerciselist_rewrite = apply_filters('tfuse_exerciselist_rewrite','all-exercise-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $exerciselist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','thumbnail','excerpt')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $exerciselist_taxonomy_rewrite = apply_filters('tfuse_exerciselist_taxonomy_rewrite','exercise-list');
        register_taxonomy('exercises', array('exercise'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $exerciselist_taxonomy_rewrite)
        )); 
        
        $labels = array(
            'name' => __('Tags','tfuse' ),
            'singular_name' => __('Tag', 'tfuse'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tags','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );
		
        $tag_exerciselist_taxonomy_tags_rewrite = apply_filters('tfuse_exerciselist_taxonomy_tags_rewrite','tag-exercise-list'); 

        register_taxonomy('tags_exercises', 'exercise', array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => $tag_exerciselist_taxonomy_tags_rewrite)
        ));  

        register_post_type( 'exercise' , $args );  
        
        // Nutrition
        $labels = array(
                'name' => __('Nutrition', 'tfuse'),
                'singular_name' => __('Nutrition', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Advice info', 'tfuse'),
                'new_item' => __('New Advice', 'tfuse'),
                'all_items' => __('All Advices', 'tfuse'),
                'view_item' => __('View Advice info', 'tfuse'),
                'search_items' => __('Search Advice', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $advicelist_rewrite = apply_filters('tfuse_advicelist_rewrite','all-advice-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $advicelist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $advicelist_taxonomy_rewrite = apply_filters('tfuse_advicelist_taxonomy_rewrite','advice-list');
        register_taxonomy('nutrition', array('advice'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $advicelist_taxonomy_rewrite)
        ));
        
        $labels = array(
            'name' => __('Tags','tfuse' ),
            'singular_name' => __('Tag', 'tfuse'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tags','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );
		
        $tag_advicelist_taxonomy_tags_rewrite = apply_filters('tfuse_advicelist_taxonomy_tags_rewrite','tag-advice-list'); 

        register_taxonomy('tags_advice', 'advice', array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => $tag_advicelist_taxonomy_tags_rewrite)
        ));   
            
            

        register_post_type( 'advice' , $args );   
                        
        // Services
        $labels = array(
                'name' => __('Services', 'tfuse'),
                'singular_name' => __('Service', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Service info', 'tfuse'),
                'new_item' => __('New Service', 'tfuse'),
                'all_items' => __('All Services', 'tfuse'),
                'view_item' => __('View Service info', 'tfuse'),
                'search_items' => __('Search Service', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $servicelist_rewrite = apply_filters('tfuse_servicelist_rewrite','all-service-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $servicelist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','excerpt','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $servicelist_taxonomy_rewrite = apply_filters('tfuse_servicelist_taxonomy_rewrite','service-list');
        register_taxonomy('services', array('service'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $servicelist_taxonomy_rewrite)
        ));
        
        $labels = array(
            'name' => __('Tags','tfuse' ),
            'singular_name' => __('Tag', 'tfuse'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tags','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );
		
        $tag_servicelist_taxonomy_tags_rewrite = apply_filters('tfuse_story_servicelist_taxonomy_tags_rewrite','tag-service-list'); 

        register_taxonomy('tags_service', 'service', array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => $tag_servicelist_taxonomy_tags_rewrite)
        ));   
            
            

        register_post_type( 'service' , $args );             
                        
        // Stories
        $labels = array(
                'name' => __('Stories', 'tfuse'),
                'singular_name' => __('Story', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Story info', 'tfuse'),
                'new_item' => __('New Story', 'tfuse'),
                'all_items' => __('All Stories', 'tfuse'),
                'view_item' => __('View Story info', 'tfuse'),
                'search_items' => __('Search Story', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $storylist_rewrite = apply_filters('tfuse_storylist_rewrite','all-story-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $storylist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments','excerpt','thumbnail')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $storylist_taxonomy_rewrite = apply_filters('tfuse_storylist_taxonomy_rewrite','story-list');
        register_taxonomy('stories', array('story'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $storylist_taxonomy_rewrite)
        ));
        
        $labels = array(
            'name' => __('Tags','tfuse' ),
            'singular_name' => __('Tag', 'tfuse'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tags','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );
		
        $taglist_taxonomy_tags_rewrite = apply_filters('tfuse_storylist_taxonomy_tags_rewrite','tag-list'); 

        register_taxonomy('tags', 'story', array(
            'hierarchical' => false,
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array('slug' => $taglist_taxonomy_tags_rewrite)
        ));   
            
            

        register_post_type( 'story' , $args );

        // TESTIMONIALS
        $labels = array(
                'name' => __('Testimonials', 'tfuse'),
                'singular_name' => __('Testimonial', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Testimonial', 'tfuse'),
                'edit_item' => __('Edit Testimonial', 'tfuse'),
                'new_item' => __('New Testimonial', 'tfuse'),
                'all_items' => __('All Testimonials', 'tfuse'),
                'view_item' => __('View Testimonial', 'tfuse'),
                'search_items' => __('Search Testimonials', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        ); 

        register_post_type( 'testimonials' , $args );

    }
    tfuse_create_custom_post_types();

endif;

add_action('category_add_form', 'taxonomy_redirect_note');
add_action('specialties_add_form', 'taxonomy_redirect_note');
function taxonomy_redirect_note($taxonomy){
    echo '<p><strong>Note:</strong> More options are available after you add the '.$taxonomy.'. <br />
        Click on the Edit button under the '.$taxonomy.' name.</p>';
}
