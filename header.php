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
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0' />
<meta name='application-name' content='<?php bloginfo('name'); ?>' />
<meta name='apple-mobile-web-app-title' content='<?php bloginfo('name'); ?>' />
<meta name='theme-color' content='<?php echo get_theme_mod('primary_color'); ?>' />
<link rel='profile' href='http://gmpg.org/xfn/11' />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<div class="branding" id="branding">
			<div class="row">
				<div class="col">
					<div class="block">
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
							<h3 class="site-description"><?php bloginfo( 'description' ); ?></h3>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="navigation" id="navigation">
			<div class="row">
				<div class="col">
					<div class="block">
						<button class="menu-toggle" id="menu-toggle"><?php _e( 'Menu', 'fran' ); ?></button>
<?php if ( !get_theme_mod ( 'show_search' ) == '' ) { ?>
						<form class="searchform" method="get" action="<?php echo home_url(); ?>/">
							<input type="text" placeholder="<?php _e('Search', 'fran'); ?>" name="s" />
							<input type="submit" value="&#xf179;" />
						</form>
<?php } ?>
<?php if ( !get_theme_mod ( 'show_login' ) == '' ) {
	if ( is_user_logged_in() ) { ?>
		<a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Logout', 'fran'); ?>" class="login-logout-link"><?php _e('Logout', 'fran'); ?></a>
	<?php } else { ?>
		<a href="<?php echo wp_login_url( get_permalink() ); ?>" title="<?php _e('Login', 'fran'); ?>" class="login-logout-link"><?php _e('Login', 'fran'); ?></a>
	<?php }
} ?>
						<nav class="nav" id="nav" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
							<?php wp_nav_menu( array( 'theme_location' => 'header', 'container' => false ) ); ?>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="main" role="main">