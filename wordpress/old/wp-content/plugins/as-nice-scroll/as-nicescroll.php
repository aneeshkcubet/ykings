<?php
/**
 * @package as-nicescroll
 * @version 1.3
 * @licence GPLv2
 */

/*
Plugin Name: AS nice scroll
Plugin URI: https://wordpress.org/plugins/as-nice-scroll/
Description: This is simple wordpress plugin.
Author: Anu Islam
Version: 1.3
Author URI: http://anuislamshohag.tk
*/

/*  Copyright 2015  anuislam  (email : anuislams@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 1, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Provide attaching images to menu items.
 *
 * @package as-nicescroll
 */

 function as_ncescroll_script(){
	 wp_register_script( 'nicescroll', plugins_url( 'js/nicescroll.js', __FILE__ ), 'jquery', 1.0, true );
	 wp_enqueue_script('jquery');
	 wp_enqueue_script('nicescroll');
 }
 add_action('wp_enqueue_scripts','as_ncescroll_script');

//admin picker
function as_admin_color_picker_option(){
if( is_admin() ) {
	wp_enqueue_style( 'wp-color-picker' );
	wp_register_script( 'as_admin_custom', plugins_url( 'js/as_admin_custom.js', __FILE__ ), 'wp-color-picker', 1.0, true );
	wp_enqueue_script('as_admin_custom');
	wp_enqueue_script('wp-color-picker');
}
wp_enqueue_style( 'as_admin_css', plugins_url( 'css/as-admin-css.css', __FILE__ ) );
}
add_action('admin_enqueue_scripts','as_admin_color_picker_option');
//nice scrol avtive
function as_ncescroll_js_active() {
	@$as_option	= get_option('as_op_save');
	@$cursorcolor = $as_option['as_nice_cursorcolor'];
	@$cursorwidth = $as_option['as_nice_cursorwidth'];
	@$cursorborderwidth = $as_option['as_nice_border_width'];
	@$cursorborderstyle = $as_option['as_nice_border_style'];
	@$cursorbordercolor = $as_option['as_nice_border_color'];
	@$scrollspeed = $as_option['as_nice_scroll_speed'];
	@$autohidemode = $as_option['as_nice_autohide_mode'];
	@$background = $as_option['as_nice_background'];
	@$hidecursordelay = $as_option['as_nice_hidecursordelay'];
	@$cursorfixedheight = $as_option['as_nice_cursorfixedheight'];
	@$cursorminheight = $as_option['as_nice_cursorminheight'];
	@$enablekeyboard = $as_option['as_nice_enablekeyboard'];
	@$horizrailenabled = $as_option['as_nice_horizrailenabled'];
	@$bouncescroll = $as_option['as_nice_bouncescroll'];
	@$smoothscroll = $as_option['as_nice_smoothscroll'];
	@$iframeautoresize = $as_option['as_nice_iframeautoresize'];
	@$touchbehavior = $as_option['as_nice_touchbehavior'];

	?>
<script type="text/javascript">
(function($){
	$(document).ready(
	function() {
		$("html").niceScroll({
			cursorcolor:		"<?php echo (!empty($cursorcolor)) ? $cursorcolor : '#ff0000'; ?>",
			cursorwidth: 		"<?php echo (!empty($cursorwidth)) ? $cursorwidth : '5'; ?>px",
			cursorborder: 		"<?php echo (!empty($cursorborderwidth)) ? $cursorborderwidth : '0'; ?>px <?php echo (!empty($cursorborderstyle)) ? $cursorborderstyle : 'solid'; ?> <?php echo (!empty($cursorbordercolor)) ? $cursorbordercolor : '#000'; ?>",
			scrollspeed: 		<?php echo (!empty($scrollspeed)) ? $scrollspeed : '60'; ?>,
			autohidemode: 		<?php echo (!empty($autohidemode)) ? $autohidemode : 'true'; ?>,
			background: 		'<?php echo (!empty($background)) ? $background : '#ddd'; ?>',
			hidecursordelay: 	<?php echo (!empty($hidecursordelay)) ? $hidecursordelay : '400'; ?>,
			cursorfixedheight: 	<?php echo (!empty($cursorfixedheight)) ? $cursorfixedheight : 'false'; ?>,
			cursorminheight: 	<?php echo (!empty($cursorminheight)) ? $cursorminheight : '20'; ?>,
			enablekeyboard: 	<?php echo (!empty($enablekeyboard)) ? $enablekeyboard : 'true'; ?>,
			horizrailenabled: 	<?php echo (!empty($horizrailenabled)) ? $horizrailenabled : 'true'; ?>,
			bouncescroll: 		<?php echo (!empty($bouncescroll)) ? $bouncescroll : 'false'; ?>,
			smoothscroll: 		<?php echo (!empty($smoothscroll)) ? $smoothscroll : 'true'; ?>,
			iframeautoresize: 	<?php echo (!empty($iframeautoresize)) ? $iframeautoresize : 'true'; ?>,
			touchbehavior: 		<?php echo (!empty($touchbehavior)) ? $touchbehavior : 'false'; ?>,
		});
	}

);})(jQuery);
</script>
<?php
    }
add_action( 'wp_footer', 'as_ncescroll_js_active' );
 // nice scroll admin option
 define( 'as_nice_scroll_path', plugin_dir_path( __FILE__ ) );
 require_once( as_nice_scroll_path . '/settings/as_scroll_option.php' );

