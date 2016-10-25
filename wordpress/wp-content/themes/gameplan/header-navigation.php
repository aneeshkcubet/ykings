<?php 
	// Navigation part of template
	global $font_awesome;
?>
<div id="navigation">
			<?php if(ot_get_option( 'topmenu_visible', 1)){?>
            <div class="bg-container" id="nav-top">
                <div class="container">
                	<div class="container-pad">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="nav-contact">
                                    <?php if(is_active_sidebar('top_menu')):?>                                    
                                        <?php echo get_dynamic_sidebar('top_menu');?>
                                    <?php endif;?>
                                </div>
                            </div>
                        <div class="span6 text-right">
                            <?php 
							$arr_social = array(
								'facebook' => ot_get_option('acc_facebook'),
								'envelope' => ot_get_option('acc_envelope'),
								'twitter' => ot_get_option('acc_twitter'),
								'linkedin' => ot_get_option('acc_linkedin'),
								//'behance' => ot_get_option('acc_behance'),
								'dribbble' => ot_get_option('acc_dribbble'),
								'flickr' => ot_get_option('acc_flickr'),
								'google_plus' => ot_get_option('acc_google_plus'),
								'instagram' => ot_get_option('acc_instagram'),
								'tumblr' => ot_get_option('acc_tumblr'),
								'pinterest_sign' => ot_get_option('acc_pinterest_sign'),
								'github' => ot_get_option('acc_github'),
								'youtube' => ot_get_option('acc_youtube'),
							);
							echo show_social_icon($arr_social);
							?>
							<?php if(is_active_sidebar('search')):?>
								<div id="search">
									<?php echo get_dynamic_sidebar('search');?>
								</div>
							<?php endif;?>
                            <span style="height:35px;display:inline-block;vertical-align:middle; margin-left:-4px"></span>
                        </div>

                    </div>
                </div>
            </div>
            </div>
			<?php }?>
			<?php if(ot_get_option( 'nav_show', 1)){?>
            <div class="bg-container" id="nav-bottom">
                <div class="shadow"><!----></div>
                <div class="nav-bottom">                	
                    <div class="container">
                    	<div class="container-pad">
                            <div class="row-fluid">
                                <div class="span3">
										<?php if(ot_get_option('logo_image') == ''):?>
											<a class="logo" href="<?php echo get_home_url(); ?>" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo get_template_directory_uri()?>/images/logo-1.png" /></a>
										<?php else:?>
											<a class="logo" href="<?php echo get_home_url(); ?>" title="<?php wp_title( '|', true, 'right' ); ?>"><img src="<?php echo ot_get_option('logo_image'); ?>" alt="<?php wp_title( '|', true, 'right' ); ?>"/></a>
										<?php endif;?>
                                </div>
                                <div class="span9">                            
                                    <div id="navigation-menu">
                                        <div class="current-menu"></div>                            
                                        <?php
                                            if(is_active_sidebar('navigation'))
                                                echo get_dynamic_sidebar('navigation');
                                            else
                                                wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu','container_class'=>'menu-main-menu-container','walker'=> new custom_walker_nav_menu()));
                                        ?>                                                                           
                                    </div>
                                    <div id="navigation-menu-mobile" class="hide">
                                    	<?php
											wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu-mobile','container_class'=>'menu-main-menu-container','walker'=> new custom_walker_nav_menu_mobile(), 'items_wrap' => '<div class="divselect"><select onchange="if(this.value != \'\' && this.value != \'#\') location.href=this.value" id="%1$s" class="%2$s"><option value="#" style=" display:none"></option>%3$s</select><span class="spanselect"></span><i class="icon-reorder '.($font_awesome==4?'fa fa-reorder':'').'"></i></div>','fallback_cb'=>false));
											
                                        ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php }
			$sticky_show_menu=ot_get_option( 'sticky_show_menu');
			if($sticky_show_menu=='1'){ ?>
				<script>
				jQuery(document).ready(function(){
					if(jQuery(document).scrollTop()>35){
						jQuery('#navigation').addClass('pos_fixed_nav');
					}
				   jQuery(window).scroll(function(e){
					   if(jQuery(document).scrollTop()>35){
							jQuery('#navigation').addClass('pos_fixed_nav');
					   }else{
						   jQuery('#navigation').removeClass('pos_fixed_nav');
					   }
				   }); 
				});
				</script>
			<?php }?>
</div>