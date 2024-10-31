<?php 
/**
* 
*/
class NA_Scroll_Top
{
	
	function __construct()
	{
		add_action('admin_menu', array($this, 'na_register_admin_menu'));
		add_action('admin_enqueue_scripts', array($this, 'na_admin_script'));
		add_action('wp_enqueue_scripts', array($this, 'na_front_script'));
		add_action('wp_ajax_na_save_data', array($this, 'na_saving_data' ));
		add_action('wp_head', array($this, 'na_front_show'));		
	}

	function na_admin_script($slug) {
		if ($slug == 'toplevel_page_scroll-to-top') {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'na_admin_script', plugin_dir_url( __FILE__ ) . '/lib/admin.js', array('jquery','wp-color-picker'), '1.0.0', true );
			wp_enqueue_style( 'na_font_style', plugin_dir_url( __FILE__ ) . '/lib/font-awesome.css' );
			wp_enqueue_style( 'na_admin_style', plugin_dir_url( __FILE__ ) . '/lib/admin.css' );
		}
	}

	function na_front_script() {
		$saved_options = get_option('na_save_data');
		wp_enqueue_script( 'na_front_script', plugin_dir_url( __FILE__ ) . '/lib/script.js', array('jquery'), '1.0.0', true );
		wp_enqueue_style( 'na_front_style', plugin_dir_url( __FILE__ ) . '/lib/style.css' );
		wp_enqueue_style( 'na_font_style', plugin_dir_url( __FILE__ ) . '/lib/font-awesome.css' );
		wp_enqueue_style( 'na_animate_style', plugin_dir_url( __FILE__ ) . '/lib/animate.css' );
		wp_localize_script('na_front_script', 'options', array(
			'style' => $saved_options['styles'],
			'speed' => $saved_options['pgspeed'],
			'custom_scroll' => $saved_options['scrolltocustom'],
		));
	}

	function na_saving_data() {
		if (isset($_REQUEST)) {
			update_option( 'na_save_data', $_REQUEST );
		}
	}

	function na_register_admin_menu() {
		add_menu_page( 'Scroll Top', 'Scroll Top', 'manage_options', 'scroll-to-top', array($this, 'na_scroll_top'), 'dashicons-upload');
	}

	function na_scroll_top() {
	$saved_options = get_option('na_save_data');
	?>

	<div class="wrap">
		<h2>Scroll Top Advance Pro Setting <a href="http://myskins.pe.hu/scroll-top-advanced/" class="page-title-action">Need Help</a></h2>
		<form id="savedata">
			<table class="wp-list-table widefat fixed">
				<tr>
					<td><h3>Styles</h3></td>
				</tr>
				<tr>
					<th>Select One Option</th>
					<td>
						<select name="scrol_option" class="show_on widefat">
							<option value="scrol_icon" <?php selected( $saved_options['scrol_option'], 'scrol_icon' ); ?>>Font Awesome Icons</option>
							<option value="scrol_text" <?php selected( $saved_options['scrol_option'], 'scrol_text' ); ?>>Scrol Text</option>
							<option value="scrol_img" <?php selected( $saved_options['scrol_option'], 'scrol_img' ); ?>>Upload Your Image</option>
							<option value="scrol_default" <?php selected( $saved_options['scrol_option'], 'scrol_default' ); ?>>Default Scroll Images</option>
						</select>
					</td>
					<td <p class="description">How would you like to display button</p></td>
				</tr>
				<tr class="custom_img">
					<th>Custom Image</th>
					<td>
						<input name="imageurl" type="text" class="imageurl widefa" value="<?php echo (isset($saved_options['imageurl'])) ? $saved_options['imageurl'] : '' ; ?>">
						<button class="button-secondary scrol_image_button">Media</button>
					</td>
					<td>
						<p class="description">Use media to upload image</p>
					</td>
				</tr>
				<tr class="font_icons">
					<th>Select Button Icon [Optional]</th>
					<td style="font-size: 15px;">
						<label><input type="radio" name="icon" value="fa-arrow-up" <?php checked( $saved_options['icon'], 'fa-arrow-up' ); ?>><i class="fa fa-arrow-up"></i></label>
						<label><input type="radio" name="icon" value="fa-arrow-circle-up" <?php checked( $saved_options['icon'], 'fa-arrow-circle-up' ); ?>><i class="fa fa-arrow-circle-up"></i></label>
						<label><input type="radio" name="icon" value="fa-arrow-circle-o-up" <?php checked( $saved_options['icon'], 'fa-arrow-circle-o-up' ); ?>><i class="fa fa-arrow-circle-o-up"></i></label>
						<label><input type="radio" name="icon" value="fa-caret-up" <?php checked( $saved_options['icon'], 'fa-caret-up' ); ?>><i class="fa fa-caret-up"></i></label>
						<label><input type="radio" name="icon" value="fa-chevron-circle-up" <?php checked( $saved_options['icon'], 'fa-chevron-circle-up' ); ?>><i class="fa fa-chevron-circle-up"></i></label>
						<label><input type="radio" name="icon" value="fa-chevron-up" <?php checked( $saved_options['icon'], 'fa-chevron-up' ); ?>><i class="fa fa-chevron-up"></i></label>
						<label><input type="radio" name="icon" value="fa-long-arrow-up" <?php checked( $saved_options['icon'], 'fa-long-arrow-up' ); ?>><i class="fa fa-long-arrow-up"></i></label>
						<label><input type="radio" name="icon" value="fa-hand-o-up" <?php checked( $saved_options['icon'], 'fa-hand-o-up' ); ?>><i class="fa fa-hand-o-up"></i></label>
						<label><input type="radio" name="icon" value="fa-eject" <?php checked( $saved_options['icon'], 'fa-eject' ); ?>><i class="fa fa-eject"></i></label>
						<label><input type="radio" name="icon" value="fa-caret-square-o-up" <?php checked( $saved_options['icon'], 'fa-caret-square-o-up' ); ?>><i class="fa fa-caret-square-o-up"></i></label>
						<label><input type="radio" name="icon" value="fa-upload" <?php checked( $saved_options['icon'], 'fa-upload' ); ?>><i class="fa fa-upload"></i></label>
						<label><input type="radio" name="icon" value="fa-angle-double-up" <?php checked( $saved_options['icon'], 'fa-angle-double-up' ); ?>><i class="fa fa-angle-double-up"></i></label>
						<label><input type="radio" name="icon" value="fa-angle-up" <?php checked( $saved_options['icon'], 'fa-angle-up' ); ?>><i class="fa fa-angle-up"></i></label>
						<label><input type="radio" name="icon" value="fa-level-up" <?php checked( $saved_options['icon'], 'fa-level-up' ); ?>><i class="fa fa-level-up"></i></label>
						<label><input type="radio" name="icon" value="fa-sort" <?php checked( $saved_options['icon'], 'fa-sort' ); ?>><i class="fa fa-sort"></i></label>
					</td>
					<td><p class="description">Select icon for showing inside button</p></td>
				</tr>
				<tr class="scroll_text">
					<th>Scroll Text [Optional]</th>
					<td><input name="title" type="text" class="widefat" value="<?php echo (isset($saved_options['title'])) ? $saved_options['title'] : '' ; ?>"></td>
					<td><p class="description">Visible only text in button</p></td>
				</tr>
				<tr class="scroll-font-size">
					<th>Font Size</th>
					<td><input type="number" name="fsize" class="widefat" value="<?php echo (isset($saved_options['fsize'])) ? $saved_options['fsize'] : '23' ; ?>"></td>
					<td><p class="description">Font size in pixel</p></td>
				</tr>
				<tr class="scroll-opacity">
					<th>Background Opacity</th>
					<td><input type="number" step="0.01" name="opacity" class="widefat" value="<?php echo (isset($saved_options['opacity'])) ? $saved_options['opacity'] : '1' ; ?>"></td>
					<td><p class="description">Set background opacity between 0.1 to 1</p></td>
				</tr>
				<tr class="scroll-height">
					<th>Height</th>
					<td><input type="number" name="height" class="widefat" value="<?php echo (isset($saved_options['height'])) ? $saved_options['height'] : '40' ; ?>"></td>
					<td><p class="description">Set button height in pixel</p></td>
				</tr>
				<tr class="scroll-width">
					<th>Width</th>
					<td><input type="number" name="width" class="widefat" value="<?php echo (isset($saved_options['width'])) ? $saved_options['width'] : '40' ; ?>"></td>
					<td><p class="description">Set button width in pixel</p></td>
				</tr>
				<tr>
					<th>Page Scroll Speed</th>
					<td><input type="number" name="pgspeed" class="widefat" value="<?php echo (isset($saved_options['pgspeed'])) ? $saved_options['pgspeed'] : '300' ; ?>"></td>
					<td>in millisecond (1000 ms = 1 sec)</td>
				</tr>
				<tr class="scroll-icon-color">
					<th>Button Icon Color</th>
					<td><input name="textcolor" type="text" class="color" value="<?php echo (isset($saved_options['textcolor'])) ? $saved_options['textcolor'] : '' ; ?>"></td>
					<td><p class="description">Choose Icon color</p></td>
				</tr>
				<tr class="scroll-bc-color">
					<th>Background color</th>
					<td>
						<input name="bgcolor" type="text" class="color" value="<?php echo (isset($saved_options['bgcolor'])) ? $saved_options['bgcolor'] : '' ; ?>">
						<br>
						<label><input type="checkbox" name="enableclr" value="gclr" <?php if (isset($saved_options['enableclr']) && $saved_options['enableclr'] !='') {
							 checked( $saved_options['enableclr'], 'gclr' );
						} ?>> Enable Gradient Background</label>
					</td>
					<td><p class="description">Choose button background color</p></td>
				</tr>
				<tr class="scroll-bc-hover">
					<th>Background Color on Hover</th>
					<td><input name="hvrclr" type="text" class="color" value="<?php echo (isset($saved_options['hvrclr'])) ? $saved_options['hvrclr'] : '' ; ?>"></td>
					<td>Choose background Color on Hover</td>
				</tr>
			</table>
			<table class="wp-list-table widefat fixed">
				<tr>
					<td><h3>Button Location</h3></td>
				</tr>
				<tr>
					<th>Horizental Alignment</th>
					<td style="font-size: 15px;">
						<label><input type="radio" name="hlocation" value="left" <?php checked( $saved_options['hlocation'], 'left' ); ?>>Left</label>
						<label><input type="radio" name="hlocation" value="right" <?php checked( $saved_options['hlocation'], 'right' ); ?>>Right</i></label>
					</td>
					<td><p class="description">Show button Left or Right on the page</p></td>
				</tr>
				<tr>
					<th>Vertical Alignment</th>
					<td style="font-size: 15px;">
						<label><input type="radio" name="vlocation" value="top" <?php checked( $saved_options['vlocation'], 'top' ); ?>>Top</label>
						<label><input type="radio" name="vlocation" value="bottom" <?php checked( $saved_options['vlocation'], 'bottom' ); ?>>Bottom</label>
					</td>
					<td><p class="description">Show button Top or Bottom on the page</p></td>
				</tr>
				<tr>
					<th>Horizantal Distance from edge</th>
					<td><input min="0" max="100" step="0.1" name="hposition" type="number" value="<?php echo (isset($saved_options['hposition'])) ? $saved_options['hposition'] : '15' ; ?>">%</td>
					<td><p class="description">Set by percentage between 0 to 100</p></td>
				</tr>
				<tr>
					<th>Vertical Distance from edge</th>
					<td><input min="0" max="100" step="0.1" name="vposition" type="number" value="<?php echo (isset($saved_options['vposition'])) ? $saved_options['vposition'] : '15' ; ?>">%</td>
					<td><p class="description">Set by percentage between 0 to 100</p></td>
				</tr>
				<tr>
					<th>Scroll To</th>
					<td><input name="scrolltocustom" type="text" value="<?php echo (isset($saved_options['scrolltocustom'])) ? $saved_options['scrolltocustom'] : '' ; ?>"></td>
					<td><p class="description">eg: "#id" or ".class". Leave blank for scroll to top</p></td>
				</tr>
			</table>
			<table class="wp-list-table widefat fixed">
				<tr>
					<td><h3>Effects</h3></td>
				</tr>
				<tr class="btn-styles">
					<th>Select Button Styles</th>
					<td>
						<select class="widefat" name="styles">
							<option value="na-style4" <?php selected( $saved_options['styles'], 'na-style4' ); ?>>Square Style</option>
							<option value="na-style2" <?php selected( $saved_options['styles'], 'na-style2' ); ?>>Circle Style</option>
							<option value="na-style3" <?php selected( $saved_options['styles'], 'na-style3' ); ?>>Top Round</option>
							<option value="na-style" <?php selected( $saved_options['styles'], 'na-style' ); ?>>Diamond</option>
						</select>
					</td>
					<td><p class="description">Set Button Styling</p></td>
				</tr>
				<tr>
					<th>Select Animation Style</th>
					<td>
						<select class="widefat" name="animate">
							<option value="Default" <?php selected( $saved_options['animate'], 'Default' ); ?>>Default</option>
							<option value="bounce" <?php selected( $saved_options['animate'], 'bounce' ); ?>>Bounce</option>
							<option value="bounceIn" <?php selected( $saved_options['animate'], 'bounceIn' ); ?>>BounceIn</option>
							<option value="rubberBand" <?php selected( $saved_options['animate'], 'rubberBand' ); ?>>rubberBand</option>
							<option value="shake" <?php selected( $saved_options['animate'], 'shake' ); ?>>shake</option>
							<option value="swing" <?php selected( $saved_options['animate'], 'swing' ); ?>>swing</option>
							<option value="bounceInDown" <?php selected( $saved_options['animate'], 'bounceInDown' ); ?>>bounceInDown</option>
							<option value="bounceInLeft" <?php selected( $saved_options['animate'], 'bounceInLeft' ); ?>>bounceInLeft</option>
							<option value="bounceInRight" <?php selected( $saved_options['animate'], 'bounceInRight' ); ?>>bounceInRight</option>
							<option value="bounceInUp" <?php selected( $saved_options['animate'], 'bounceInUp' ); ?>>bounceInUp</option>
							<option value="fadeInLeft" <?php selected( $saved_options['animate'], 'fadeInLeft' ); ?>>fadeInLeft</option>
							<option value="fadeInRight" <?php selected( $saved_options['animate'], 'fadeInRight' ); ?>>fadeInRight</option>
							<option value="fadeInDown" <?php selected( $saved_options['animate'], 'fadeInDown' ); ?>>fadeInDown</option>
							<option value="flash" <?php selected( $saved_options['animate'], 'flash' ); ?>>flash</option>
							<option value="pulse" <?php selected( $saved_options['animate'], 'pulse' ); ?>>pulse</option>
							<option value="tada" <?php selected( $saved_options['animate'], 'tada' ); ?>>tada</option>
							<option value="wobble" <?php selected( $saved_options['animate'], 'wobble' ); ?>>wobble</option>
							<option value="flip" <?php selected( $saved_options['animate'], 'flip' ); ?>>flip</option>
							<option value="flipInX" <?php selected( $saved_options['animate'], 'flipInX' ); ?>>flipInX</option>
							<option value="flipInY" <?php selected( $saved_options['animate'], 'flipInY' ); ?>>flipInY</option>
							<option value="lightSpeedIn" <?php selected( $saved_options['animate'], 'lightSpeedIn' ); ?>>lightSpeedIn</option>
							<option value="rotateIn" <?php selected( $saved_options['animate'], 'rotateIn' ); ?>>rotateIn</option>
							<option value="rotateInDownLeft" <?php selected( $saved_options['animate'], 'rotateInDownLeft' ); ?>>rotateInDownLeft</option>
							<option value="rotateInDownRight" <?php selected( $saved_options['animate'], 'rotateInDownRight' ); ?>>rotateInDownRight</option>
							<option value="rotateInUpLeft" <?php selected( $saved_options['animate'], 'rotateInUpLeft' ); ?>>rotateInUpLeft</option>
							<option value="rotateInUpRight" <?php selected( $saved_options['animate'], 'rotateInUpRight' ); ?>>rotateInUpRight</option>
							<option value="slideInUp" <?php selected( $saved_options['animate'], 'slideInUp' ); ?>>slideInUp</option>
							<option value="slideInDown" <?php selected( $saved_options['animate'], 'slideInDown' ); ?>>slideInDown</option>
							<option value="slideInRight" <?php selected( $saved_options['animate'], 'slideInRight' ); ?>>slideInRight</option>
							<option value="zoomIn" <?php selected( $saved_options['animate'], 'zoomIn' ); ?>>zoomIn</option>
							<option value="zoomInDown" <?php selected( $saved_options['animate'], 'zoomInDown' ); ?>>zoomInDown</option>
							<option value="zoomInLeft" <?php selected( $saved_options['animate'], 'zoomInLeft' ); ?>>zoomInLeft</option>
							<option value="zoomInRight" <?php selected( $saved_options['animate'], 'zoomInRight' ); ?>>zoomInRight</option>
							<option value="zoomInUp" <?php selected( $saved_options['animate'], 'zoomInUp' ); ?>>zoomInUp</option>
							<option value="rollIn" <?php selected( $saved_options['animate'], 'rollIn' ); ?>>rollIn</option>
							<!-- <option value="hinge" <?php selected( $saved_options['animate'], 'hinge' ); ?>>hinge</option> -->
							<!-- <option value="flipOutY" <?php selected( $saved_options['animate'], 'flipOutY' ); ?>>flipOutY</option> -->
						</select>
					</td>
					<td><p class="description">Button Visibility Through Animation</p></td>
				</tr>
				<tr>
					<th>Scroll Visibility</th>
					<td>
						<select name="show_top" class="widefat show_on">
							<option value="whole_site" <?php selected( $saved_options['show_top'], 'whole_site' ); ?>>Complete Site</option>
							<option value="home_page" <?php selected( $saved_options['show_top'], 'home_page' ); ?>>Only Home Page</option>
						</select>
					</td>
					<td>Where To Show</td>
				</tr>
				<tr>
					<td><label><input type="checkbox" name="formbl" value="na-top" <?php if (isset($saved_options['formbl']) && $saved_options['formbl'] !='') {
							 checked( $saved_options['formbl'], 'na-top' ); 
						} ?>> Disable For Mobile Devices</label></td>
				</tr>
			</table>
			<table class="wp-list-table widefat fixed">
				<tr class="scrol_default">
					<td><h3>Custom Icon</h3></td>
				</tr>
				<tr class="scrol_default"><td>
					<div>
						<?php for ($i=1; $i <= 94; $i++) { ?>
						<label>
							<input type="radio" name="custom_icon" value="<?php echo $i; ?>" <?php checked( $saved_options['custom_icon'], $i ); ?>>
							<div class="ic-box">
								<img src="<?php echo plugin_dir_url( __FILE__ ); ?>/image/icons/<?php echo $i; ?>.png" alt="">
							</div>
							</label>
						<?php } ?>
					</div>
				</td></tr>
			</table>
			<br>
			<input type="submit" class="button-primary btn-save" value="Save Settings">	
			<img src="<?php echo plugin_dir_url(__FILE__).'image/loader.gif' ?>" class="nm-loading" style="display: none;">
			<span class="nm-saved" style="display: none;">Changes Saved!</span>
		</form>
	</div>
	<?php
	}
	function na_front_show() {
        $saved_options = get_option('na_save_data');
        global $post;

        $show_on = $saved_options['show_top'];

        switch ($show_on) {
            case 'home_page':
                if (is_home() || is_front_page()) {
                    $this->na_front_display();
                }
                break;
            
            case 'whole_site':
                $this->na_front_display();
                break;
        }
    }
	function na_front_display() {
	$saved_options = get_option('na_save_data'); ?>
	<div class="<?php echo $saved_options['formbl']; ?> scrol-top-advanced">
		<?php if ($saved_options['scrol_option'] == 'scrol_icon') { ?>
			<a class="<?php echo $saved_options['styles']; ?> <?php echo $saved_options['enableclr']; ?> <?php echo $saved_options['animate'] ?> animated position forhover" href="javascript: void(0);" 
			style="font-size: <?php echo $saved_options['fsize']; ?>px; color: <?php echo $saved_options['textcolor']; ?>; background-color: <?php echo $saved_options['bgcolor']; ?>; height: <?php echo $saved_options['height']; ?>px; width: <?php echo $saved_options['width']; ?>px; line-height: <?php echo $saved_options['height']; ?>px;">
				<i class="fa <?php echo $saved_options['icon']; ?>"></i>
			</a>
		<?php } ?>
		<?php if ($saved_options['scrol_option'] == 'scrol_text') { ?>
			<a class="<?php echo $saved_options['styles']; ?> <?php echo $saved_options['enableclr']; ?> <?php echo $saved_options['animate'] ?> animated position forhover" href="javascript: void(0);" 
			style="font-size: <?php echo $saved_options['fsize']; ?>px; color: <?php echo $saved_options['textcolor']; ?>; background-color: <?php echo $saved_options['bgcolor']; ?>; height: <?php echo $saved_options['height']; ?>px; width: <?php echo $saved_options['width']; ?>px; line-height: <?php echo $saved_options['height']; ?>px;">
				<?php echo $saved_options['title']; ?>
			</a>
		<?php } ?>
		<?php if ($saved_options['scrol_option'] == 'scrol_img') { ?>
			<a class="<?php echo $saved_options['styles']; ?> <?php echo $saved_options['animate'] ?> animated position" href="javascript: void(0);">
				<img src="<?php echo $saved_options['imageurl']; ?>">
			</a>
		<?php } ?>
		<?php if ($saved_options['scrol_option'] == 'scrol_default') { ?>
			<a class="<?php echo $saved_options['styles']; ?> <?php echo $saved_options['animate'] ?> animated position" href="javascript: void(0);">
				<img src="<?php echo plugin_dir_url( __FILE__ ); ?>/image/icons/<?php echo $saved_options['custom_icon']; ?>.png">
			</a>
		<?php } ?>
			
	</div>
	<style>
		.forhover:hover {
			background-color: <?php echo $saved_options['hvrclr']; ?> !important;
			text-decoration: none;
		}
		.position {
			position: fixed;
		    z-index: 1000;
		    <?php echo $saved_options['hlocation']; ?>: <?php echo $saved_options['hposition']; ?>%;
		    <?php echo $saved_options['vlocation']; ?>: <?php echo $saved_options['vposition']; ?>%;
		}
		.scrol-top-advanced a {
			opacity: <?php echo $saved_options['opacity']; ?>;
		}
		.scrol-top-advanced a:hover {
			opacity: 1 !important;
		}
		@media only screen and (max-width: 480px) {
			.na-top {
				display: none !important;
			}
		}
	</style>
	<?php 
	} 
}

$na_object = new NA_Scroll_Top;
 ?>