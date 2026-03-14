<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="splatter-layer" aria-hidden="true"></div>

<!-- NAV -->
<nav class="site-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Navigation', 'schmoll-creative' ); ?>">
    <a class="nav-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?>">
        Schmoll<span class="dot">.</span>
    </a>

    <!-- Mobile hamburger -->
    <button class="nav-toggle" id="navToggle" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle menu', 'schmoll-creative' ); ?>">
        <span></span><span></span><span></span>
    </button>

    <!-- Desktop links -->
    <ul class="nav-desktop">
        <li><a href="<?php echo esc_url( home_url( '/#work' ) ); ?>"><?php _e( 'Work', 'schmoll-creative' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>"><?php _e( 'About', 'schmoll-creative' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/#testimonials' ) ); ?>"><?php _e( 'Kind Words', 'schmoll-creative' ); ?></a></li>
        <li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="hire"><?php _e( "Let's Talk", 'schmoll-creative' ); ?></a></li>
    </ul>
</nav>

<!-- Mobile nav drawer -->
<div class="nav-drawer" id="navDrawer" role="dialog" aria-label="<?php esc_attr_e( 'Mobile menu', 'schmoll-creative' ); ?>">
    <a href="<?php echo esc_url( home_url( '/#work' ) ); ?>" onclick="closeNav()"><?php _e( 'Work', 'schmoll-creative' ); ?></a>
    <a href="<?php echo esc_url( home_url( '/#about' ) ); ?>" onclick="closeNav()"><?php _e( 'About', 'schmoll-creative' ); ?></a>
    <a href="<?php echo esc_url( home_url( '/#testimonials' ) ); ?>" onclick="closeNav()"><?php _e( 'Kind Words', 'schmoll-creative' ); ?></a>
    <a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" onclick="closeNav()"><?php _e( "Let's Talk", 'schmoll-creative' ); ?></a>
</div>
