<?php
//admin fields
function as_nicescroll_admin_option(){
	add_settings_section('as_nicescroll_section','Nice scroll options', 'as_nicescroll_display_function','as_options');
	add_settings_field('as_nice_cursorcolor', 'Cursorcolor' , 'as_nicescroll_display_option','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_cursorwidth', 'Cursorwidth' , 'as_nice_cursorwidth_display_option','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_border_width', 'cursorborder width' , 'as_nice_cursorborder_width','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_border_style', 'cursorborder style' , 'as_nice_cursorborder_style','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_border_color', 'cursorborder color' , 'as_nice_cursorborder_color','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_scroll_speed', 'Scrollspeed' , 'as_nice_scrollspeed','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_autohide_mode', 'Autohidemode' , 'as_nice_autohide_mode','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_background', 'Background' , 'as_nice_background','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_hidecursordelay', 'Hidecursordelay' , 'as_nice_hidecursordelay','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_cursorfixedheight', 'Cursorfixedheight' , 'as_nice_cursorfixedheight','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_cursorminheight', 'Cursorminheight' , 'as_nice_cursorminheight','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_enablekeyboard', 'Enablekeyboard' , 'as_nice_enablekeyboard','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_horizrailenabled', 'Horizrailenabled' , 'as_nice_horizrailenabled','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_bouncescroll', 'Bouncescroll' , 'as_nice_bouncescroll','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_smoothscroll', 'Smoothscroll' , 'as_nice_smoothscroll','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_iframeautoresize', 'Iframeautoresize' , 'as_nice_iframeautoresize','as_options', 'as_nicescroll_section');
	add_settings_field('as_nice_touchbehavior', 'Touchbehavior' , 'as_nice_touchbehavior','as_options', 'as_nicescroll_section');
	register_setting('as_nicescroll_section','as_op_save');
}
add_action('admin_init', 'as_nicescroll_admin_option');

//add menu page

function as_nicescroll_admin_menu(){
	add_theme_page('As nice scroll options','As option', 'manage_options', 'as_options', 'as_nicescroll_display_menu');
}
add_action('admin_menu','as_nicescroll_admin_menu');


//all callback function

function as_nicescroll_display_function(){
	return ;
}


function as_nicescroll_display_option(){

	$as_color = (array)get_option('as_op_save');
	$color = (isset($as_color['as_nice_cursorcolor'])) ? $as_color['as_nice_cursorcolor'] : '';

	echo '<input name="as_op_save[as_nice_cursorcolor]" type="text" value="'.$color.'" class="regular-text as_color_option">';
}


function as_nice_cursorwidth_display_option(){
	$as_width = (array)get_option('as_op_save');
	$width = (isset($as_width['as_nice_cursorwidth']))? $as_width['as_nice_cursorwidth'] : '' ;
	echo '<input name="as_op_save[as_nice_cursorwidth]" type="number" value="'.$width.'" class="regular-text">';
	echo '<p>Number == px</p>';
}


function as_nice_cursorborder_width(){
	$as_border_width = (array)get_option('as_op_save');
	$border_width = (isset($as_border_width['as_nice_border_width'])) ? $as_border_width['as_nice_border_width'] : '';
	echo '<input name="as_op_save[as_nice_border_width]" type="number" value="'.$border_width.'" class="regular-text">';
	echo '<p>Number == px</p>';
}
function as_nice_cursorborder_style(){
	$as_border_style = (array)get_option('as_op_save');
	$border_style = (isset($as_border_style['as_nice_border_style'])) ? $as_border_style['as_nice_border_style'] : '';
	?>

	<select name="as_op_save[as_nice_border_style]" class="regular-text" >
		<option value="" <?php echo (empty($border_style)) ? 'selected' : '' ;?> >Select a value</option>
		<option value="solid" <?php echo ($border_style == 'solid') ? 'selected' : '' ;?> >Solid</option>
		<option value="ridge" <?php echo ($border_style == 'ridge') ? 'selected' : '' ;?> >Ridge</option>
		<option value="outset" <?php echo ($border_style == 'outset') ? 'selected' : '' ;?> >Outset</option>
		<option value="inset" <?php echo ($border_style == 'inset') ? 'selected' : '' ;?> >Inset</option>
		<option value="hidden" <?php echo ($border_style == 'hidden') ? 'selected' : '' ;?> >Hidden</option>
		<option value="groove" <?php echo ($border_style == 'groove') ? 'selected' : '' ;?> >Groove</option>
		<option value="double" <?php echo ($border_style == 'double') ? 'selected' : '' ;?> >Double</option>
		<option value="dotted" <?php echo ($border_style == 'dotted') ? 'selected' : '' ;?> >Dotted</option>
		<option value="dashed" <?php echo ($border_style == 'dashed') ? 'selected' : '' ;?> >Dashed</option>
		<option value="unset" <?php echo ($border_style == 'unset') ? 'selected' : '' ;?> >Unset</option>
		<option value="initial" <?php echo ($border_style == 'initial') ? 'selected' : '' ;?> >Initial</option>
		<option value="inherit" <?php echo ($border_style == 'inherit') ? 'selected' : '' ;?> >Inherit</option>
		<option value="none" <?php echo ($border_style == 'none') ? 'selected' : '' ;?> >None</option>
	</select>

	<?php
}
function as_nice_cursorborder_color(){
	$as_border_color = (array)get_option('as_op_save');
	$border_color = (isset($as_border_color['as_nice_border_color'])) ? $as_border_color['as_nice_border_color'] : '';

	echo '<input name="as_op_save[as_nice_border_color]" type="text" value="'.$border_color.'" class="regular-text as_color_option">';
}

function as_nice_scrollspeed(){
	$as_scroll_speed = (array)get_option('as_op_save');
	$scroll_speed = (isset($as_scroll_speed['as_nice_scroll_speed'])) ? $as_scroll_speed['as_nice_scroll_speed'] : '';

	echo '<input name="as_op_save[as_nice_scroll_speed]" type="number" value="'.$scroll_speed.'" class="regular-text">';
	echo '<p>Default 60</p>';
}

function as_nice_autohide_mode(){
	$as_autohide = (array)get_option('as_op_save');
	$autohide = (isset($as_autohide['as_nice_autohide_mode'])) ? $as_autohide['as_nice_autohide_mode'] : '';

?>

<select name="as_op_save[as_nice_autohide_mode]" class="regular-text" >
	<option value="" <?php echo (empty($autohide)) ? 'selected' : '' ;?> >Select a value</option>
	<option value="true" <?php echo ($autohide == 'true') ? 'selected' : '' ;?> >True</option>
	<option value="false" <?php echo ($autohide == 'false') ? 'selected' : '' ;?> >False</option>
</select>

<?php
}


function as_nice_background(){
	$as_background = (array)get_option('as_op_save');
	$background = (isset($as_background['as_nice_background'])) ? $as_background['as_nice_background'] : '';

	echo '<input name="as_op_save[as_nice_background]" type="text" value="'.$background.'" class="regular-text as_color_option">';
}

function as_nice_hidecursordelay(){
	$as_hidecursordelay = (array)get_option('as_op_save');
	$hidecursordelay = (isset($as_hidecursordelay['as_nice_hidecursordelay'])) ? $as_hidecursordelay['as_nice_hidecursordelay'] : '';

	echo '<input name="as_op_save[as_nice_hidecursordelay]" type="number" value="'.$hidecursordelay.'" class="regular-text">';
	echo '<p>Default 400</p>';
}
function as_nice_cursorfixedheight(){
	$as_cursorfixedheight = (array)get_option('as_op_save');
	$cursorfixedheight = (isset($as_cursorfixedheight['as_nice_cursorfixedheight'])) ? $as_cursorfixedheight['as_nice_cursorfixedheight'] : '';

?>

<select name="as_op_save[as_nice_cursorfixedheight]" class="regular-text">
	<option value="" <?php echo (empty($cursorfixedheight)) ? 'selected' : '' ;?> >Select a value</option>
	<option value="true" <?php echo ($cursorfixedheight == 'true') ? 'selected' : '' ;?> >True</option>
	<option value="false" <?php echo ($cursorfixedheight == 'false') ? 'selected' : '' ;?> >False</option>
</select>
<p>Default False</p>
<?php
}

function as_nice_cursorminheight(){
	$as_cursorminheight = (array)get_option('as_op_save');
	$cursorminheight = (isset($as_cursorminheight['as_nice_cursorminheight'])) ? $as_cursorminheight['as_nice_cursorminheight'] : '';

	echo '<input name="as_op_save[as_nice_cursorminheight]" type="number" value="'.$cursorminheight.'" class="regular-text">';
	echo '<p>Default 20</p>';
}

function as_nice_enablekeyboard(){
	$as_enablekeyboard = (array)get_option('as_op_save');
	$enablekeyboard = (isset($as_enablekeyboard['as_nice_enablekeyboard'])) ? $as_enablekeyboard['as_nice_enablekeyboard'] : '';
	?>
<select name="as_op_save[as_nice_enablekeyboard]" class="regular-text">
	<option value="" <?php echo (empty($enablekeyboard)) ? 'selected' : '' ;?> >Select a value</option>
	<option value="true" <?php echo ($enablekeyboard == 'true') ? 'selected' : '' ;?> >True</option>
	<option value="false" <?php echo ($enablekeyboard == 'false') ? 'selected' : '' ;?> >False</option>
</select>
<p>Default True</p>
	<?php
}
function as_nice_horizrailenabled(){
	$as_horizrailenabled = (array)get_option('as_op_save');
	$horizrailenabled = (isset($as_horizrailenabled['as_nice_horizrailenabled'])) ? $as_horizrailenabled['as_nice_horizrailenabled'] : '';
	?>
<select name="as_op_save[as_nice_horizrailenabled]" class="regular-text">
	<option value="" <?php echo (empty($horizrailenabled)) ? 'selected' : '' ;?> >Select a value</option>
	<option value="true" <?php echo ($horizrailenabled == 'true') ? 'selected' : '' ;?> >True</option>
	<option value="false" <?php echo ($horizrailenabled == 'false') ? 'selected' : '' ;?> >False</option>
</select>
<p>Default True</p>
	<?php
}
function as_nice_bouncescroll(){
	$as_bouncescroll = (array)get_option('as_op_save');
	$bouncescroll = (isset($as_bouncescroll['as_nice_bouncescroll'])) ? $as_bouncescroll['as_nice_bouncescroll'] : '';
	?>
<select name="as_op_save[as_nice_bouncescroll]" class="regular-text">
	<option value="" <?php echo (empty($bouncescroll)) ? 'selected' : '' ;?> >Select a value</option>
	<option value="true" <?php echo ($bouncescroll == 'true') ? 'selected' : '' ;?> >True</option>
	<option value="false" <?php echo ($bouncescroll == 'false') ? 'selected' : '' ;?> >False</option>
</select>
<p>Default False</p>
	<?php
}
function as_nice_smoothscroll(){
	$as_smoothscroll = (array)get_option('as_op_save');
	$smoothscroll = (isset($as_smoothscroll['as_nice_smoothscroll'])) ? $as_smoothscroll['as_nice_smoothscroll'] : '';
	?>
<select name="as_op_save[as_nice_smoothscroll]" class="regular-text">
	<option value="" <?php echo (empty($smoothscroll)) ? 'selected' : '' ;?> >Select a value</option>
	<option value="true" <?php echo ($smoothscroll == 'true') ? 'selected' : '' ;?> >True</option>
	<option value="false" <?php echo ($smoothscroll == 'false') ? 'selected' : '' ;?> >False</option>
</select>
<p>Default True</p>
	<?php
}
function as_nice_iframeautoresize(){
	$as_iframeautoresize = (array)get_option('as_op_save');
	$iframeautoresize = (isset($as_iframeautoresize['as_nice_iframeautoresize'])) ? $as_iframeautoresize['as_nice_iframeautoresize'] : '';
	?>
<select name="as_op_save[as_nice_iframeautoresize]" class="regular-text">
	<option value="" <?php echo (empty($iframeautoresize)) ? 'selected' : '' ;?> >Select a value</option>
	<option value="true" <?php echo ($iframeautoresize == 'true') ? 'selected' : '' ;?> >True</option>
	<option value="false" <?php echo ($iframeautoresize == 'false') ? 'selected' : '' ;?> >False</option>
</select>
<p>Default True</p>
	<?php
}
function as_nice_touchbehavior(){
	$as_touchbehavior = (array)get_option('as_op_save');
	$touchbehavior = (isset($as_touchbehavior['as_nice_touchbehavior'])) ? $as_touchbehavior['as_nice_touchbehavior'] : '';
	?>
<select name="as_op_save[as_nice_touchbehavior]" class="regular-text">
	<option value="" <?php echo (empty($touchbehavior)) ? 'selected' : '' ;?> >Select a value</option>
	<option value="true" <?php echo ($touchbehavior == 'true') ? 'selected' : '' ;?> >True</option>
	<option value="false" <?php echo ($touchbehavior == 'false') ? 'selected' : '' ;?> >False</option>
</select>
<p>Default False</p>
	<?php
}


function as_nicescroll_display_menu(){
?>
<div class="wrap" style="position:relative;overflow: hidden;">
     <div class="my_status_main">
        <div class="my_status_main_inner">
            <span class="as_click_hide"><img src="<?php echo plugins_url( 'img/right.png', __FILE__ ); ?>" alt=""></span>
            <span class="as_click_show"><img src="<?php  echo plugins_url( 'img/right.png', __FILE__ ); ?>" alt=""></span>
            <ul class="as_url">
                <li><span>See on my other plugins</span> <a target="_blank" href="https://wordpress.org/plugins/as-login/"><img  class="fiverr" src="<?php  echo plugins_url( 'img/wordpress.png', __FILE__ ); ?>" alt=""></a></li>
                <li><span>See on my Fiverr profile</span> <a target="_blank" href="https://www.fiverr.com/anuislam"><img  class="fiverr" src="<?php  echo plugins_url( 'img/fiverr.png', __FILE__ ); ?>" alt=""></a></li>
                <li><span>See on my PeoplePerhour profile</span> <a target="_blank" href="http://www.peopleperhour.com/freelancer/anu-islam/web-design-wordpress-wordpress-pl/910027"><img class="github" src="<?php  echo plugins_url( 'img/People.png', __FILE__ ); ?>" alt=""></a></li>

                <li><span>See on my GitHub repository</span> <a target="_blank" href="https://github.com/anuislam"><img class="github" src="<?php  echo plugins_url( 'img/github.png', __FILE__ ); ?>" alt=""></a></li>
            </ul>
        </div>
    </div>
	<h2>As nice scroll</h2>
	<?php settings_errors(); ?>
	<form action="options.php" method="POST">
	<?php do_settings_sections('as_options'); ?>
	<?php settings_fields('as_nicescroll_section'); ?>
	<?php submit_button(); ?>
	</form>
</div>
<?php
}