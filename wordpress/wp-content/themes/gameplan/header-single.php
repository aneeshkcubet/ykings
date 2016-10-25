<?php
	// Header for single post or page or port-portfolio
	global $post;
	//$heading = $post->post_title;
	$heading = get_the_title($post->ID);
	$sub_heading = get_post_meta($post->ID,'page_subhead',true);
	$background = get_post_meta($post->ID,'background',true);
	$header_height = get_post_meta($post->ID,'header_height',true);
	$back1=isset($background['background-image'])?$background['background-image']:'';
	$back2=isset($background['background-color'])?$background['background-color']:'';
	if($back1=='' && $back2=='')	{
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
	/* Check Tribe Events Calendar template 
	 *
	 * check this link for conditional event template: https://gist.github.com/jo-snips/2415009
	 *
	 */
	$headings = get_tribe_events_page_heading();
	if($headings !== false){
		$heading = $headings[0];
		$sub_heading = $headings[1];
	}elseif(function_exists('is_woocommerce') && is_woocommerce()){
		if(is_shop()){
			$heading = esc_html__('Shop','cactusthemes');
		}elseif(is_product_category()||is_product_tag()){
			$heading = single_term_title('',false);
		}
	}else {
		if(is_404()){
			$heading = ot_get_option('page404_heading','404');
			$sub_heading = ot_get_option('page404_subheading','');
		}elseif(is_category() || is_tag()){
			$heading = single_tag_title( '', false );
			$sub_heading = '';
		}elseif(is_archive()){
			$heading = esc_html__('Archive','cactusthemes');
			$sub_heading = wp_title( ' ', false, 'right' );
		}elseif(is_search()){
			//if(!$post){
				$heading = esc_html__('Search results', 'castusthemes');;
				$sub_heading =  esc_html__('Search results for ', 'castusthemes').'"'. get_query_var('s') . '"';
			//}
		}
	}
?>
	<style type="text/css">
		#page-header{ height:<?php echo $header_height;?>}
		#page-header .bg-container{<?php if(isset($background['background-image'])){?>background:<?php echo $background['background-color'];?> url(<?php echo $background['background-image'];?>) <?php echo $background['background-attachment'];?> center 0 <?php echo $background['background-repeat'];?>;background-size:cover<?php }?>; height:100%}
	</style>
		<div id="page-header" class="<?php echo $sub_heading != '' ? '':'no-subheading';?>">
        	<div class="bg-container">
            	<div class="container-pad">
                    <h1><?php echo $heading;?>&nbsp;</h1>
                    <p><?php echo $sub_heading;?>&nbsp;</p>
                </div>
            </div>
        </div>