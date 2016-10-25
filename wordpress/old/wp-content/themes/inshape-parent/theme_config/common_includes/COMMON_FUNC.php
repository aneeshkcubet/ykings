<?php
if (!function_exists('tfuse_list_page_options')) :
    function tfuse_list_page_options() {
        $pages = get_pages();
        $result = array();
        $result[0] = 'Select a page';
        foreach ( $pages as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;


if (!function_exists('tfuse_list_posts')) :
    function tfuse_list_posts() {
        $posts = get_posts(array('post_type' => 'video','posts_per_page' => -1,'orderby' => 'post_date'));
		$result = array();
        foreach ( $posts as $post ) {
            $result[$post->ID] = get_the_title($post->ID);
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_posts_gallery')) :
    function tfuse_list_posts_gallery() {
        $posts = get_posts(array('post_type' => 'gallery','posts_per_page' => -1,'orderby' => 'post_date'));
		$result = array();
        foreach ( $posts as $post ) {
            $result[$post->ID] = get_the_title($post->ID);
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_goals')) :
    function tfuse_list_goals() {
        $args = array(
            'hide_empty'    => false, 
        ); 
        
        $goals = get_terms('goals',$args);
    
        $result = array();
        
        if(!empty($goals))
        {
            foreach ( $goals as $goal ) {
                $result[$goal->term_id] = $goal->name;
            }
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_get_weeks')) :
    function tfuse_get_weeks() {
        global $post;
        
        $selected_weeks = tfuse_page_options('workout_weeks','',$post->ID);
        $result = array();
                
        $selected_weeks = ($selected_weeks) ? $selected_weeks : 4;
        
        for($i = 1; $i <= $selected_weeks; $i++)
        {
            $result[$i] = __('Week','tfuse') .' '. $i;
        }
        
        return $result;
    }
endif;

if (!function_exists('tfuse_list_workouts')) :
    function tfuse_list_workouts() {
        
        $posts = get_posts(array('post_type' => 'workout','posts_per_page' => -1,'orderby' => 'post_date'));
        $result = array();
                
        if(!empty($posts))
        {
            foreach ( $posts as $post ) {
				$result[$post->ID] = get_the_title($post->ID);
            }
        }
        return $result;
    }
endif;
