<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!--
	╭──────────────────────────────────────────╮
	│ ≡ The Fran theme is developed by         │
	╞══════════════════════════════════════════╡
	│ Johan van der Wijk - The Web Works       │
	├──────────────────────────────────────────┤
	│  https://thewebworks.nl                  │
	╰──────────────────────────────────────────╯
-->
<meta charset='<?php bloginfo( 'charset' ); ?>' />
<meta name='viewport' content='width=device-width, initial-scale=1.0' />
<meta name='application-name' content='<?php bloginfo('name'); ?>' />
<meta name='apple-mobile-web-app-title' content='<?php bloginfo('name'); ?>' />
<meta name='theme-color' content='<?php echo get_theme_mod('primary_color'); ?>' />
<link rel='profile' href='http://gmpg.org/xfn/11' />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
				$logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
				if ( has_custom_logo() ) { ?>
					<img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="logo" />
				<?php } else if ( is_singular() ) { ?>
					<h2 class="site-title"><?php bloginfo( 'name' ); ?></h2>
				<?php } else { ?>
					<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<?php } ?>
			</a>
		</div>
		<button class="hamburger hamburger--elastic" type="button" aria-label="Menu" aria-controls="navigation">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</button>
		<div class="navigation">
			<nav class="nav" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
				<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => false, 'menu_id' => 'menu-header', 'menu_class' => 'menu-header' ) ); ?>
				<?php if ( !get_theme_mod ( 'show_login' ) == '' ) { ?>
					<ul class="menu-utilities">
					<?php if ( is_user_logged_in() ) { ?>
						<li class="login-logout-link"><a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Logout', 'fran'); ?>"><?php _e('Logout', 'fran'); ?></a></li>
					<?php } else { ?>
						<li><a href="<?php echo wp_login_url( get_permalink() ); ?>" title="<?php _e('Login', 'fran'); ?>" class="login-logout-link"><?php _e('Login', 'fran'); ?></a></li>
					<?php } ?>
					</ul>
				<?php } ?>
			</nav>
			<?php if ( !get_theme_mod ( 'show_search' ) == '' ) { 
				get_search_form();
			} ?>
		</div>
	</header>
	<main class="main" id="main" role="main">