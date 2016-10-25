<?php
function tfuse_featured_workout($atts, $content = null)
{
    extract( shortcode_atts(array('post' => '','number' => ''), $atts) );
    $out = '';

    if(!empty($post))
    {
        $terms = wp_get_post_terms( $post , 'workouts' ); 
        
        $sessions = tfuse_page_options('content_weeks','',$post);
                
        if(!empty($sessions))
        {
            $ids = $exercises_ids = $distinct_ids = array();
            foreach ($sessions as $session) {
                if(!empty($session['tab_day1'])) $ids[$session['tab_day1']] = $session['tab_day1'];
                if(!empty($session['tab_day2'])) $ids[$session['tab_day2']] = $session['tab_day2'];
                if(!empty($session['tab_day3'])) $ids[$session['tab_day3']] = $session['tab_day3'];
                if(!empty($session['tab_day4'])) $ids[$session['tab_day4']] = $session['tab_day4'];
                if(!empty($session['tab_day5'])) $ids[$session['tab_day5']] = $session['tab_day5'];
                if(!empty($session['tab_day6'])) $ids[$session['tab_day6']] = $session['tab_day6'];
                if(!empty($session['tab_day7'])) $ids[$session['tab_day7']] = $session['tab_day7'];
                
                if($session['tab_repeat']) break;
            }
        }
        
        if(!empty($ids))
        {
            foreach($ids as $id)
                $exercises_ids[] = explode(',',tfuse_page_options('exercises_select','',$id));
            
            if(!empty($exercises_ids))
                foreach($exercises_ids as $exercises_id)
                    foreach($exercises_id as $exercise_id)
                        $distinct_ids[$exercise_id] = $exercise_id;
        }
                
        $out .= '<div class="row workout-featured">
                <div class="col-md-1">
                    <img class="man" src="'.get_template_directory_uri().'/images/man.png" alt="">
                </div>
                <div class="col-md-4">
                    <div class="section-title-before">'.__('featured','tfuse').'</div>
                    <h2 class="section-title">'.get_the_title($post).'</h2>
                    <div class="section-desc"><p>'.  tfuse_page_options('workout_desc','',$post).'</p></div>
                    <a href="'.get_term_link( $terms[0], 'workouts' ).'" class="btn btn-transparent"><span>'.__('VIEW ALL MY WORKOUTS','tfuse').'</span></a>
                </div>';
                if(!empty($distinct_ids))
                {
                    $out .='<div class="col-md-7">
                        <ul class="workout-exercises">';
                            $count = 1;
                            foreach($distinct_ids as $distinct_id)
                            { 
                                $current_post = get_post( $distinct_id );
                                $out .='<li>
                                    <h4>'.get_the_title($distinct_id).' - '. strtolower(tfuse_page_options('reps','',$distinct_id)) .'</h4>';
                                        $content = (!empty($current_post->post_excerpt)) ? tfuse_shorten_string(apply_filters('the_content',$current_post->post_excerpt),18) : strip_tags(tfuse_shorten_string(apply_filters('the_content',$current_post->post_content),18));
                                $out .= $content.'</li>';
                                if($count == $number) break;
                                $count++;
                            }
                        $out .='</ul>
                    </div>';
                }
            $out .='</div>';
    }
    
    return $out;
}

$atts = array(
    'name' => __('Featured Workout', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select Featured Workout','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_featured_workout_post',
            'value' => '',
            'options' =>  tfuse_list_workouts(),
            'type' => 'select',
            'divider' => true
        ),
        array(
            'name' => __('Exercises Number','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_featured_workout_number',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        
    )
);

tf_add_shortcode('featured_workout', 'tfuse_featured_workout', $atts);
