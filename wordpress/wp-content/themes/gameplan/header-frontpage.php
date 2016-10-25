<?php
	global $post;
	$blog_page = get_option('page_for_posts');
	$home_page = get_option('page_on_front');			
	$slider = ot_get_option('slider_section');
	$slider_style = ot_get_option('slider_style','wide');
	
	if(is_front_page() && $slider != 'page'){
		// if current page is Home Page (set in Settings --> Reading)
		if($slider == 'revslider' && ot_get_option('revslider_name') != ''){
			// use revolution slider
			$home_slider_height = 500;
			if(class_exists('RevSlider')){
				$home_slider = new RevSlider();
				try{
					$home_slider->initByMixed(ot_get_option('revslider_name'));
					$home_slider_height = $home_slider->getParam("height");
				}catch(Exception $e){
					// do nothing in case no slider found
				}
			}
		?>
			<div id="slider" class="<?php echo $slider_style?>" style="height:<?php echo $home_slider_height-130 ?>px">
			<?php
				echo do_shortcode('[rev_slider '.ot_get_option('revslider_name').']');
			?>
            <div class="clear"></div>
			</div>
	<?php
		} else {
			// use widget && background image
			echo '<div id="slider">';
			echo '<div class="bg-container" id="main-top">';
			if(is_active_sidebar('main_top'))
				echo get_dynamic_sidebar('main_top');
			echo '</div>';
			echo '</div>';
		}
	} elseif(is_page_template('page-templates/front-page.php')&&get_post_meta(get_the_ID(),'revslider',true)){
		$revslider = get_post_meta($post->ID,'revslider',true);
		$slider = ot_get_option('slider_section');
		if($revslider != ''){
			// use revolution slider
			$slider_style = (get_post_meta(get_the_ID(),'slider_style',true)=='def'||get_post_meta(get_the_ID(),'slider_style',true)=='')?ot_get_option('slider_style','wide'):get_post_meta(get_the_ID(),'slider_style',true);
		?>
			<div id="slider" class="<?php echo $slider_style ?>">
			<?php echo do_shortcode('[rev_slider '.$revslider.']');?>
			</div>
		<?php
		} else {
			// use widget && background image
			echo '<div id="slider">';
			echo '<div class="bg-container" id="main-top">';
			if(is_active_sidebar('main_top'))
				echo get_dynamic_sidebar('main_top');
			echo '</div>';
			echo '</div>';
		}
	} else {
		// if current page is Home Page or Blog Page
		
		/* read page metadata */
		$page_id = $post->ID; // for Home Page
		if(is_home()) $page_id = $blog_page;
		$sub_heading = get_post_meta($page_id,'page_subhead',true);
		$background = get_post_meta($page_id,'background',true);
		$header_height = get_post_meta($page_id,'header_height',true);
		$page = get_post($page_id);
		if((!isset($background['background-image']) || $background['background-image'] == '') && (!isset($background['background-color']) || ($background['background-color']==''))){
			$background = ot_get_option('subpage_header');
			$back1=isset($background['background-image'])?$background['background-image']:'';
			$back2=isset($background['background-color'])?$background['background-color']:'';
			if($back1=='' && $back2=='')	{
				$background['background-image'] = get_template_directory_uri().'/images/head.png';	
			}

		}
		if($header_height==''){
			$header_height = ot_get_option('header_height_page');
		}
	?>
	<style type="text/css">
		#page-header{ height:<?php echo $header_height;?>}
		#page-header .bg-container{background:<?php echo $background['background-color'];?> url(<?php echo $background['background-image'];?>) <?php echo $background['background-attachment'];?> center 0 <?php echo $background['background-repeat'];?>;background-size:cover; height:100%}
	</style>
			<div id="page-header" class="<?php echo $sub_heading != '' ? '':'no-subheading';?>">
				<div class="bg-container">
                	<div class="container-pad">
                        <h1><?php echo $page->post_title;?>&nbsp;</h1>
                        <p><?php echo $sub_heading; ?>&nbsp;</p>
                    </div>
				</div>
			</div>
	<?php
		}