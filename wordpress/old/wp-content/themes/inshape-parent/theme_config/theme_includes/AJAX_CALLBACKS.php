<?php 

if (!function_exists('tfuse_ajax_get_posts')) :
    function tfuse_ajax_get_posts(){ 
    
        $post_type = $_POST['post_type'];
        $search_param = $_POST['search_param'];
    
        $max = (intval($_POST['max'])); 
        $pageNum = (intval($_POST['pageNum']));
        $search_key = $_POST['search_key'];
        $allhome = $_POST['allhome'];
        $allblog = $_POST['allblog'];
        $homepage = $_POST['homepage'];
        $cat_ids = $_POST['cat_ids'];           
        $cat_ID = (intval($_POST['id']));
        $is_tax = $_POST['is_tax']; 
        $items = get_option('posts_per_page');  
        
        $pos4 = $pos1 = $pos2= $pos3 =$pos5 = $pos6 = $pos7 = $pos8 = $pos9 = $allpos = $pos = $pos10 =
        $pos11 = $pos12 = $pos13 = $pos14 = $pos15 = $pos16 = $pos17 = '';
        
        $posts = array();
    if($pageNum <= $max) {
        if($homepage == 'homepage' && $allhome == 'nonehomeall')
        {  

            $specific = tfuse_options('categories_select_categ'); 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ) ,
                            'paged' => $pageNum,
                            'cat' => $specific
                );
            }
            else 
            {
                $args = array(
                    'post_status' => array( 'publish') ,
                            'paged' => $pageNum,
                            'cat' => $specific
                );
            }
                
            $query = new WP_Query($args);
            $posts = $query->posts; 
        }
        elseif($homepage == 'blogpage' && $allblog == 'allblogcategories')
        { 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ) ,
                    'paged' => $pageNum,
                    'post_type' => 'post'
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ) ,
                    'paged' => $pageNum,
                    'post_type' => 'post'
                );
            }
            
            $query = new WP_Query( $args );
            $posts = $query -> posts; 
        }
        elseif($homepage == 'blogpage' && $allblog == 'noneblogall')
        { 
            $specific = tfuse_options('categories_select_categ_blog'); 
                $args = array(
                    'paged' => $pageNum,
                    'cat' => $specific
                );
                
            $query = new WP_Query( $args );
            $posts = $query -> posts; 
        }
        elseif(($homepage == 'homepage') && ($allhome == 'allhomecategories'))
        { 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ) ,
                    'paged' => $pageNum,
                    'post_type' => 'post'
                );
            }
            else 
            {
                $args = array(
                    'post_status' => array( 'publish') ,
                            'paged' => $pageNum,
                            'cat' => $cat_ids
                );
            }
                
            $query = new WP_Query($args);
            $posts = $query->posts; 
        }
        
        elseif($is_tax == 'category')
        { 
            if(is_user_logged_in())
            {
                $query = new WP_Query(array('post_status' => array( 'publish','private' ) , 'cat' => $cat_ID,'paged' => $pageNum));
            }
            else
            {
                $query = new WP_Query(array('post_status' => array( 'publish' ) , 'cat' => $cat_ID,'paged' => $pageNum));
            }
            $posts = $query->posts;
        }
        elseif($is_tax == 'nutrition')
        { 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'nutrition',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'nutrition',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'tags_advice')
        { 
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags_advice',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags_advice',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'stories')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'stories',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'stories',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'tags')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'exercises')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'exercises',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'exercises',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'tags_exercises')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags_exercises',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags_exercises',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'services')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'services',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'services',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'tags_service')
        {
            if(is_user_logged_in())
            {
                $args = array(
                    'post_status' => array( 'publish','private' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags_service',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
            else
            {
                $args = array(
                    'post_status' => array( 'publish' ),
                        'paged' => $pageNum,
                        'tax_query' => array(
                                array(
                                        'taxonomy' => 'tags_service',
                                        'field' => 'id',
                                        'terms' => $cat_ID
                                )
                        )
                );
            }
           $query = new WP_Query( $args );
           $posts = $query->posts;
        }
        elseif($is_tax == 'search') 
        { 
            $query = new WP_Query(array('post_status' => array( 'publish' ) , 's' => $search_key ,'paged' => $pageNum));
                
            $posts = $query->posts;
        }
        
        $cnt = 0; 
        foreach($posts as $post)
        { 
            $cnt++;
            //get date format
            $d = get_option('date_format');
            //get comments number
            $num_comments = get_comments_number($post->ID);
            if ( $num_comments == 0 ) {
                $comments = $num_comments.__(' comments','tfuse');
            } elseif ( $num_comments > 1 ) {
                    $comments = $num_comments . __(' comments','tfuse');
            } else {
                    $comments = __('1 comment','tfuse');
            }
            
            if($is_tax == 'nutrition' || $is_tax == 'tags_advice')
            { 
                $term = get_term( $cat_ID , 'nutrition' );
                if(empty($term)) $term = get_term( $cat_ID , 'tags_advice' );
                
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                
                $pos1 .='<div class="col-sm-4">
                        <article class="post">
                            <a href="'.get_permalink($post->ID).'" class="post-thumbnail"><span>'. __('View Details','tfuse').'</span>';
                                if(!empty($image)){
                                    $pos2 .='<img src="'.$image.'" alt="">';
                                }
                            $pos3 .='</a>
                            <div class="entry-content">
                                <div class="entry-title-before">'.$term->name.'</div>
                                <h3 class="entry-title"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>
                            </div>
                        </article>
                    </div>';
                $pos = $pos1.$pos2.$pos3;
                $pos1 = $pos2 = $pos3 = '';
            }
            elseif($is_tax == 'stories' || $is_tax == 'tags')
            {
                $term = get_term( $cat_ID , 'stories' );
                if(empty($term)) $term = get_term( $cat_ID , 'tags' );
                
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                
                $pos5 .='<article class="post clearfix">
                            <span class="post-thumbnail">';
                                if(!empty($image)){
                                    $pos6 .='<img src="'.$image.'" alt="">';
                                }
                            $pos7 .='</span>
                            <div class="entry-content">
                                <div class="entry-title-before">'.$term->name.'</div>
                                <h2 class="entry-title"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h2>';
                                if ( tfuse_options('post_content') == 'content' ) 
                                {
                                    $pos8 .= '<p>'.$post->post_content.'</p>'; 
                                }
                                else
                                {
                                    $pos9 .= (!empty($post->post_excerpt)) ? '<p>'.$post->post_excerpt.'</p>' : '<p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),50)).'</p>';
                                }
                                $pos10 .='<a href="'.get_permalink($post->ID).'" class="btn btn-transparent"><span>'.__('Read More','tfuse').'</span></a>
                            </div>
                        </article>';
                $pos = $pos5.$pos6.$pos7.$pos8.$pos9.$pos10;
                $pos5 = $pos6 = $pos7 =  $pos8 = $pos9 = $pos10 = '';
            }
            elseif($is_tax == 'exercises' || $is_tax == 'tags_exercises')
            {
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                $reps = tfuse_page_options('reps','',$post->ID);
                $video = tfuse_page_options('video_links','',$post->ID);
                $pos1 .='<article class="post clearfix">';
                        if(!empty($video))
                        {
                            $pos2 .='<div class="post-thumbnail video">';
                                if(!empty($image))
                                {
                                    $pos3 .='<a data-rel="prettyPhoto"  href="'.$video.'">
                                    <img src="'.$image.'" alt=""></a>';
                                }
                                else
                                {
                                    preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video, $video_id);
                                    if(!empty($video_id)) $pos4 .= '<iframe src="http://www.youtube.com/embed/'.$video_id[0].'?wmode=transparent" width="560" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                    else $pos5 .='<iframe src="'.$video.'" width="560" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                }
                            $pos6 .='</div>';
                        }
                        else
                        {
                            if(!empty($image))
                            {
                                $pos7 .='<div class="post-thumbnail"><img src="'.$image.'" alt=""></div>';
                            }
                        }

                         $pos8 .='<div class="entry-content">
                            <h4 class="entry-title"><a href="'.get_permalink( $post->ID ).'">'.$post->post_title.'</a></h4>';
                            if ( tfuse_options('post_content') == 'content' ) 
                            {
                                $pos9 .= '<p>'.$post->post_content.'</p>'; 
                            }
                            else
                            {
                                $pos10 .= (!empty($post->post_excerpt)) ? '<p>'.$post->post_excerpt.'</p>' : '<p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),50)).'</p>';
                            }
                            if(!empty($reps))
                            {
                                $pos11 .='<footer class="entry-meta">
                                    <i class="tficon-clock"></i>'.$reps.'</footer>';
                            }
                        $pos12 .='</div>
                    </article>';
                $pos = $pos1.$pos2.$pos3.$pos4.$pos5.$pos6.$pos7.$pos8.$pos9.$pos10.$pos11.$pos12;
                $pos1 =  $pos2 =$pos3 =$pos4 =$pos5 =$pos6 =$pos7 =$pos8 =$pos9 =$pos10 =$pos11 =$pos12 ='';
            }
            elseif($is_tax == 'services' || $is_tax == 'tags_service')
            {
                $term = get_term( $cat_ID , 'services' );
                if(empty($term)) $term = get_term( $cat_ID , 'tags_service' );
                
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                $link = tfuse_page_options('app_link','',$post->ID);
                
                $pos1 .='
                    <div class="col-sm-4">
                        <article class="post">
                            <div class="entry-content">
                                <div class="entry-title-before">'.$term->name.'</div>
                                <h3 class="entry-title"><a href="'.get_permalink( $post->ID ).'">'.$post->post_title.'</a></h3>';
                                if ( tfuse_options('post_content') == 'content' ) 
                                {
                                    $pos2 .= '<p>'.$post->post_content.'</p>'; 
                                }
                                else
                                {
                                    $pos3 .= (!empty($post->post_excerpt)) ? '<p>'.$post->post_excerpt.'</p>' : '<p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),50)).'</p>';
                                }
                            $pos3 .='</div>
                            <a href="'.get_permalink( $post->ID ).'" class="post-thumbnail"><span>'.__('View Details','tfuse').'</span>';
                                if(!empty($image))
                                    $pos4 .='<img src="'.$image.'" alt="">';
                            $pos4 .='</a>';
                            if(!empty($link))
                                $pos5 .='<footer class="entry-meta clearfix">
                                    <a href="'.$link.'" class="btn btn-small btn-transparent btn-black pull-left"><span>'.__('MAKE appointment','tfuse').'</span></a>
                                </footer>';
                        $pos6 .='</article>
                    </div>';
                $pos = $pos1.$pos2.$pos3.$pos4.$pos5.$pos6;
                $pos1 =  $pos2 =$pos3 =$pos4 =$pos5 =$pos6 ='';
            }
            elseif($is_tax == 'category')
            { 
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                $img_pos = tfuse_page_options('single_img_position','',$post->ID);
                
                $user_data = get_user_by('id',$post->post_author);

                $rounded = tfuse_page_options('rounded','',$post->ID);

                $position = tfuse_page_options('img_pos','',$post->ID);
                
                $rounded_class = ($rounded) ? "rounded" : "";
                
                $pos11 .='<article class="post clearfix">';
                            if($position == 'before')
                            {
                                if(!empty($image))
                                {
                                    $pos12 .='<span class="post-thumbnail '.$img_pos.'  '. $rounded_class . '"><img src="'.$image.'" alt=""></span>';
                                }
                            }
                             $pos13 .='<div class="entry-meta">
                                <time class="entry-date" datetime="'.get_the_time( $d, $post->ID ).'">'.get_the_time( $d, $post->ID ).'</time>
                                <span class="author"> '.__('by','tfuse').' <a href="'.get_author_posts_url( $post->post_author, $user_data->data->user_nicename ).'">'.$user_data->data->user_nicename.'</a></span>
                                <span class="cat-links"> '.__('in','tfuse').' '.tfuse_cat_links($post->post_type,$post->ID).'</span>
                            </div>
                            <div class="entry-content">
                                <h2 class="entry-title"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h2>';
                                if($position != 'before')
                                {
                                    if(!empty($image))
                                    {
                                        $pos14 .='<span class="post-thumbnail '.$img_pos.' '.$rounded_class.'"><img src="'.$image.'" alt=""></span>';
                                    }
                                }
                                if ( tfuse_options('post_content') == 'content' ) 
                                {
                                    $pos15 .= '<p>'.$post->post_content.'</p>'; 
                                }
                                else
                                {
                                    $pos16 .= (!empty($post->post_excerpt)) ? '<p>'.$post->post_excerpt.'</p>' : '<p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),50)).'</p>';
                                }
                            $pos17 .='</div>
                            <footer class="entry-meta clearfix">
                                <a href="'.get_permalink($post->ID).'" class="btn btn-small btn-transparent"><span>'.__('find out more','tfuse').'</span></a>
                                <a href="'.get_permalink($post->ID).'#comments" class="comments-link"><span>'.$comments.'</span></a>
                            </footer>
                        </article>';
                $pos = $pos11.$pos12.$pos13.$pos14.$pos15.$pos16.$pos17;
                $pos11 = $pos12 = $pos13 = $pos14 = $pos15 = $pos16 = $pos17 = '';
            }
            elseif($is_tax == 'search')
            {
                $img = tfuse_page_options('thumbnail_image',null,$post->ID);
                if(tfuse_options('disable_listing_lightbox'))
                {
                    $image = '<a href="'.$img.'" rel="prettyPhoto[gallery'.$post->ID.']">
                                <img src="'.$img.'" height="200" width="220" alt="">
                            </a>';
                }
                else
                {
                    $image = '<a href="'.get_permalink( $post->ID ).'"><img src="'.$img.'" height="200" width="220" alt="" ></a>';
                }
                
                $pos1 .='<div class="post-item clearfix">
                            <div class="post-image">'.$image.'</div>
                            <div class="post-meta">';
                                if ( tfuse_options('date_time')) :
                                    $pos2 .='<span class="post-date">'.get_the_time( $d, $post->ID ).'</span> &nbsp;|&nbsp;'; 
                                endif;
                                $pos3 .='<a href="' . get_comments_link($post->ID) .'" class="link-comments">'.$comments.'</a>
                            </div>
                            <div class="post-title">
                                <h3><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>
                            </div>
                            <div class="post-descr entry">
                                <p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),30)).'</p>
                            </div>
                            <div class="post-more"><a href="'.get_permalink($post->ID).'">'.__('READ THE ARTICLE','tfuse').'</a></div>
                        </div>';
                $pos = $pos1.$pos2.$pos3;
                $pos1 = $pos2 = $pos3 = '';
            }
                $allpos[] = $pos;
        }
        $rsp = array('html'=> $allpos,'items' => $items,'posts'=> $posts); 
        echo json_encode($rsp);
    }
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_posts','tfuse_ajax_get_posts');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_posts','tfuse_ajax_get_posts');
endif;

if (!function_exists('tfuse_ajax_get_rating')) :
    function tfuse_ajax_get_rating(){  
    
        $id = (intval($_POST['id'])); 
        $parent = $_POST['parent']; 
        $current = ($_POST['current']); 
        $rating_array = tfuse_object_to_array(json_decode(stripslashes($_POST['rating_array'])));
                
        $values = $rating_array;
                
            foreach ($values as  $key =>$value) {
                if($parent == $key)
                { 
                    $sum = $current + $value['val'];
                    $values[$key]['val'] = $sum;
                    $values[$key]['count'] = ++$value['count'];
                }

            tf_update_post_meta( $id, TF_THEME_PREFIX . '_rating', $values);
        }
        
        $rsp = $values;
        echo json_encode($rsp);
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_rating','tfuse_ajax_get_rating');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_rating','tfuse_ajax_get_rating');
endif;

if (!function_exists('tfuse_object_to_array')) :
    function tfuse_object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = tfuse_object_to_array($value);
            }
            return $result;
        }
        return $data;
    }
endif;

//get filter posts from game post
if (!function_exists('tfuse_ajax_get_exercises')) :
    function tfuse_ajax_get_exercises(){  
        $post_id = (intval($_POST['post_id'])); 
                
        $out = $out1 = '';
        
        $exercises_ids = explode(',',  tfuse_page_options('exercises_select','',$post_id));
        
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'exercise',
            'post__in' =>  $exercises_ids
        );
    
        $all_posts = new WP_Query( $args );
        $posts = $all_posts->posts;
        
        if(!empty($posts))
        {
            $count = 0;
            foreach ($posts as $post) { $count++;
                $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'post-thumbnails'));
                $reps = tfuse_page_options('reps','',$post->ID);
                $video = tfuse_page_options('video_links','',$post->ID);
                                                
                $out .= '<article class="post clearfix">';
                            if(!empty($video))
                            {
                                $out .= '<div class="post-thumbnail video">';
                                    if(!empty($image))
                                    {
                                        $out .= '<a data-rel="prettyPhoto" title="'.get_the_title($post->ID).'" href="'.$video.'">
                                        <img src="'.$image.'" alt=""></a>';
                                    }
                                    else
                                    {
                                            preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $video, $video_id);
                                            if(!empty($video_id)) $out .= '<iframe src="http://www.youtube.com/embed/'.$video_id[0].'?wmode=transparent" width="560" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                            else $out .= '<iframe src="'.$video.'" width="560" height="332" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
                                    }
                                $out .= '</div>';
                            }
                            else
                            {
                                if(!empty($image))
                                    $out .='<div class="post-thumbnail"><img src="'.$image.'" alt=""></div>';
                            }

                            $out .='<div class="entry-content">
                                <div class="entry-title-before">'. __('Exercise no','tfuse').'. '.$count.'</div>
                                <h4 class="entry-title"><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></h4>';
                                if ( tfuse_options('post_content') == 'content' ) 
                                {
                                    $out .= '<p>'.$post->post_content.'</p>'; 
                                }
                                else
                                {
                                    $out .= (!empty($post->post_excerpt)) ? '<p>'.$post->post_excerpt.'</p>' : '<p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),150)).'</p>';
                                }
                                if(!empty($reps))
                                {
                                    $out .= '<footer class="entry-meta">
                                        <i class="tficon-clock"></i>'.$reps.'
                                    </footer>';
                                }
                            $out .=' </div>
                        </article>';
            }
        }
        
        $bodyparts = tfuse_page_options('content_tabs_t','',$post_id);
        
        if(!empty($bodyparts))
        {
            $out1 .= '
                <h6 class="section-title">'.__('bodyparts worked','tfuse').'</h6>';
                foreach($bodyparts as $bodypart)
                {
                    $out1 .= '<div class="progress-wrap">
                                <div class="progress-label">'.$bodypart['tab_title'].'</div>
                                <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="'.(int)$bodypart['tab_percentage'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.(int)$bodypart['tab_percentage'].'%;"></div></div>
                                <div class="progress-mark clearfix"><span class="pull-left">0%</span><span class="pull-right">100%</span></div>
                            </div>';
                }
        }

        $rsp = array('html'=> $out,'bodyparts' => $out1); 
         
        echo json_encode($rsp);
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_exercises','tfuse_ajax_get_exercises');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_exercises','tfuse_ajax_get_exercises');
endif;


if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     *
     *
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
     */

    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');
            update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
        }
    }
endif;


if (!function_exists('tfuse_shorten_string')) :
    /**
     * To override tfuse_shorten_string() in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_shorten_string($string, $wordsreturned)

{
    $retval = $string;

    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)

    {
        $retval = $string;
    }
    else

    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array)." ...";
    }
    return $retval;
}

endif;

if ( !function_exists('tfuse_cat_links')):
    function tfuse_cat_links($post_type,$id){
        if($post_type == 'post')
            return get_the_term_list($id,'category', '', ', ' );
        elseif($post_type == 'story')
            return get_the_term_list($id,'stories', '', ', ' );
        elseif($post_type == 'service')
            return get_the_term_list($id,'services', '', ', ' );
        elseif($post_type == 'advice')
            return get_the_term_list($id,'nutrition', '', ', ' );
        elseif($post_type == 'workout')
            return get_the_term_list($id,'workouts', '', ', ' );
        elseif($post_type == 'exercise')
            return get_the_term_list($id,'exercises', '', ', ' );
    }
endif;

add_theme_support( 'post-thumbnails');


add_action( 'init', 'tfuse_remove_thumbnail_support' );
function tfuse_remove_thumbnail_support() {
	remove_post_type_support( 'page', 'thumbnail' );
}

add_image_size( 'feature-image', 9999, 9999, true ); 
add_image_size( 'medium-thumb', 200, 200, true );
add_image_size( 'similar_posts', 371, 234, true );

function change_posts_name() {
    global $menu;
    
    $menu[5][0] = __( 'Blog Posts', 'tfuse' );
}
add_action( 'admin_menu', 'change_posts_name' );

add_action( 'init', 'tfuse_action_change_post_labels' );
function tfuse_action_change_post_labels() {
       global $wp_post_types;
       $p = 'post';

       // Someone has changed this post type, always check for that!
       if ( empty ( $wp_post_types[ $p ] )
            or ! is_object( $wp_post_types[ $p ] )
            or empty ( $wp_post_types[ $p ]->labels )
       ) {
               return;
       }

       $wp_post_types[ $p ]->has_archive = true;

       $wp_post_types[ $p ]->labels->name               = __('Blog', 'tfuse');
       $wp_post_types[ $p ]->labels->singular_name      = __('Blog', 'tfuse');
       $wp_post_types[ $p ]->labels->add_new            = __('Add blog post', 'tfuse');
       $wp_post_types[ $p ]->labels->add_new_item       = __('Add new blog post', 'tfuse');
       $wp_post_types[ $p ]->labels->all_items          = __('All blog posts', 'tfuse');
       $wp_post_types[ $p ]->labels->edit_item          = __('Edit blog post', 'tfuse');
       $wp_post_types[ $p ]->labels->name_admin_bar     = __('Blog Post', 'tfuse');
       $wp_post_types[ $p ]->labels->menu_name          = __('Blog Post', 'tfuse');
       $wp_post_types[ $p ]->labels->new_item           = __('New blog post', 'tfuse');
       $wp_post_types[ $p ]->labels->not_found          = __('No blog posts found', 'tfuse');
       $wp_post_types[ $p ]->labels->not_found_in_trash = __('No blog posts found in trash', 'tfuse');
       $wp_post_types[ $p ]->labels->search_items       = __('Search blog posts', 'tfuse');
       $wp_post_types[ $p ]->labels->view_item          = __('View blog post', 'tfuse');
}
