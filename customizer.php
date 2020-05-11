<?php
class fran_customizer {
	public static function register ( $wp_customize ) {
		//1. Define a new section (if desired) to the Theme Customizer
		$wp_customize->add_section( 'fran_options', 
			array(
				'title' => __( 'Theme Options', 'fran' ), //Visible title of section
				'priority' => 35, //Determines what order this appears in
				'capability' => 'edit_theme_options', //Capability needed to tweak
				'description' => __('Allows you to customize layout settings for the theme.', 'fran'), //Descriptive tooltip
			)
		);


		$wp_customize->add_section( 'fran_code', 
			array(
				'title' => __( 'Additional Code', 'fran' ), // Visible title of section
				'priority' => 210, // Determines what order this appears in
				'capability' => 'edit_theme_options', //Capability needed to tweak
				'description' => __('Allows you to add code to the header and footer section of the theme.', 'fran'), //Descriptive tooltip
			)
		);

		//2. Register new settings to the WP database
		$wp_customize->add_setting( 'primary_color',
			array(
				'default' => '#3f51b5', //Default setting/value to save
				'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
				'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
				'transport' => 'refresh', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_setting( 'secondary_color',
			array(
				'default' => '#ff4081',
				'type' => 'theme_mod',
				'capability' => 'edit_theme_options',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_setting( 'fran_code_header' );
		$wp_customize->add_control(
			'fran_code_header',
				array(
					'type' => 'textarea',
					'label' => __( 'Header', 'fran' ),
					'section' => 'fran_code',
				)
		);

		$wp_customize->add_setting( 'fran_code_footer' );
		$wp_customize->add_control(
			'fran_code_footer',
				array(
					'type' => 'textarea',
					'label' => __( 'Footer', 'fran' ),
					'section' => 'fran_code',
				)
		);

		$wp_customize->add_setting( 'show_search' );
		$wp_customize->add_control(
			'show_search',
				array(
					'type' => 'checkbox',
					'label' => __( 'Show search box', 'fran' ),
					'section' => 'fran_options',
				)
		);

		$wp_customize->add_setting( 'show_login' );
		$wp_customize->add_control(
			'show_login',
				array(
					'type' => 'checkbox',
					'label' => __( 'Show login/logout links', 'fran' ),
					'section' => 'fran_options',
				)
		);

		$wp_customize->add_setting( 'disable_smileys' );
		$wp_customize->add_control(
			'disable_smileys',
				array(
					'type' => 'checkbox',
					'label' => __( 'Prevent WordPress from parsing smileys', 'fran' ),
					'section' => 'fran_options',
				)
		);

		$wp_customize->add_setting( 'show_author' );
		$wp_customize->add_control(
			'show_author',
				array(
					'type' => 'checkbox',
					'label' => __( 'Show author in post meta', 'fran' ),
					'section' => 'fran_options',
				)
		);

		$wp_customize->add_setting( 'show_date' );
		$wp_customize->add_control(
			'show_date',
				array(
					'type' => 'checkbox',
					'label' => __( 'Show the date in post meta', 'fran' ),
					'section' => 'fran_options',
				)
		);

		$wp_customize->add_setting( 'footer_widgets', array( 'default' => '3columns' ) );
		$wp_customize->add_control(
			'footer_widgets',
				array(
					'type' => 'radio',
					'label' => __( 'Footer Widgets', 'fran' ),
					'section' => 'fran_options',
					'choices' => array(
						'3columns' => __( '3 Columns', 'fran' ),
						'4columns' => __( '4 Columns', 'fran' )
					),
				)
		);





		//3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
			$wp_customize, //Pass the $wp_customize object (required)
			'fran_primary_color', //Set a unique ID for the control
			array(
				'label' => __( 'Primary Color', 'fran' ), //Admin-visible name of the control
				'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'primary_color', //Which setting to load and manipulate (serialized is okay)
				'priority' => 10, //Determines the order this control appears in for the specified section
			) 
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			'fran_secondary_color',
			array(
				'label' => __( 'Secondary Color', 'fran' ),
				'section' => 'colors',
				'settings' => 'secondary_color',
				'priority' => 10,
			) 
		) );

		//4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	}

	public static function header_code_output() {
		if ( get_theme_mod('fran_code_header') ) {
			echo get_theme_mod('fran_code_header');
		}
	}

	public static function footer_code_output() {
		if ( get_theme_mod('fran_code_footer') ) {
			echo get_theme_mod('fran_code_footer');
		}
	}

	public static function header_output() {

		// Functionality to make colors darker or brighter
		function colourBrightness($hex, $percent) {
			// Work out if hash given
			$hash = '';
			if (stristr($hex,'#')) {
				$hex = str_replace('#','',$hex);
				$hash = '#';
			}
			/// HEX TO RGB
			$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
			//// CALCULATE 
			for ($i=0; $i<3; $i++) {
				// See if brighter or darker
				if ($percent > 0) {
					// Lighter
					$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
				} else {
					// Darker
					$positivePercent = $percent - ($percent*2);
					$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
				}
				// In case rounding up causes us to go to 256
				if ($rgb[$i] > 255) {
					$rgb[$i] = 255;
				}
			}
			//// RBG to Hex
			$hex = '';
			for($i=0; $i < 3; $i++) {
				// Convert the decimal digit to hex
				$hexDigit = dechex($rgb[$i]);
				// Add a leading zero if necessary
				if(strlen($hexDigit) == 1) {
				$hexDigit = "0" . $hexDigit;
				}
				// Append to the hex string
				$hex .= $hexDigit;
			}
			return $hash.$hex;
		}

		$primary_color = get_theme_mod('primary_color');
		$secondary_color = get_theme_mod('secondary_color');
		$light = 0.2; // 50% brighter
		$lighter = 0.1;
		if ( get_theme_mod('primary_color') ) {
			$primary_color_light = colourBrightness($primary_color,$light); 
			$primary_color_lighter = colourBrightness($primary_color,$lighter);
		}
		?>
<style>
<?php if ( ( get_theme_mod ( 'show_author' ) == '' )  && ( get_theme_mod ( 'show_date' ) == '' ) ) { ?>
.single .entry-meta {
	display: none;
	margin: 0;
}
<?php } ?>
<?php if ( get_theme_mod ( 'show_author' ) == '' ) { ?>
.entry-meta .author {
	display: none;
}
<?php } ?>
<?php if ( get_theme_mod ( 'show_date' ) == '' ) { ?>
.entry-meta .date {
	display: none;
}
<?php } ?>

:root {
  --primary-color: <?php echo $primary_color; ?>;
  --primary-color-light: <?php echo $primary_color_light; ?>;
  --primary-color-lighter: <?php echo $primary_color_lighter; ?>;
}

h1,
h2,
h3,
h4,
h5,
h6,
a,
.searchform input {
	color: <?php echo $primary_color; ?>; 
}
.main .call-to-action,
.header .nav .sub-menu,
.header .nav .children,
ul.nav-menu ul a:hover,
.nav-menu ul ul a:hover,
ul.nav-menu ul a:focus,
.nav-menu ul ul a:focus,
.main button,
.main .gform_wrapper .gform_footer input.button,
.main .gform_wrapper .gform_footer input[type="submit"],
form input[type=submit] { 
	background-color: <?php echo $primary_color; ?>; 
}
.pagination .current { 
	background-color: <?php echo $primary_color_lighter; ?>;
	border-color: <?php echo $primary_color_light; ?>;
	color: <?php echo $primary_color; ?>; 
}
.wp-caption,
.category-list li a:active { 
	background-color: <?php echo $primary_color_light; ?>; 
}
.site-description {
	color: <?php echo $primary_color_light; ?>;
}
.header .menu .current_page_item > a,
.header .menu .current_page_ancestor > a,
.header .menu .current-menu-item > a,
.header .menu .current-menu-ancestor > a,
.header .menu li:hover > a,
.header .menu li a:hover,
.header .menu li:focus > a,
.header .menu li a:focus {
	border-bottom-color: <?php echo $secondary_color; ?>;
}
.content a {
	color: <?php echo $primary_color; ?>;
	border-color: <?php echo $primary_color; ?>;
}
.one-third .entry-meta,
/*.searchform,
.searchform input */ {
	background: <?php echo $primary_color_lighter; ?>;
}
/*.searchform {
	border-color: <?php echo $primary_color_lighter; ?>;
}
.login-logout-link {
	color: <?php echo $primary_color; ?>;
	background: <?php echo $primary_color_lighter; ?>;
}
.searchform input[type=text],
.searchform input[type=text]:focus,
.searchform input[type=submit] {
	color: <?php echo $secondary_color; ?>;
}*/
</style>
<?php
	}

	public static function live_preview() {
		wp_enqueue_script( 
			'fran-theme-customizer', // Give the script a unique ID
			get_template_directory_uri() . '/assets/js/theme-customizer.js', // Define the path to the JS file
			array( 'jquery', 'customize-preview' ), // Define dependencies
			'', // Define a version (optional) 
			true // Specify whether to put in footer (leave this true)
		);
	}

	public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
	$return = '';
	$mod = get_theme_mod($mod_name);
	if ( ! empty( $mod ) ) {
		$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix.$mod.$postfix
		);
		if ( $echo ) {
			echo $return;
		}
	}
	return $return;
	}

}

// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'fran_customizer' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'fran_customizer' , 'header_output' ) );

add_action( 'wp_head' , array( 'fran_customizer' , 'header_code_output' ) );

add_action( 'wp_footer' , array( 'fran_customizer' , 'footer_code_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
//add_action( 'customize_preview_init' , array( 'fran_customizer' , 'live_preview' ) );