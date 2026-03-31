<?php
/**
 * front-page.php
 * The homepage template. Loaded automatically when a static front page is set
 * (Settings > Reading > "A static page").
 *
 * Section order:
 *   Hero (with Slider Revolution)
 *   Marquee ticker
 *   Services
 *   Work / Portfolio grid
 *   About
 *   Testimonials
 *   Brand logos
 *   Contact
 */
get_header();
?>

<?php get_template_part( 'template-parts/marquee' ); ?>

<?php get_template_part( 'template-parts/hero' ); ?>

<div class="tear dark"></div>

<?php get_template_part( 'template-parts/services' ); ?>

<div class="tear"></div>

<?php get_template_part( 'template-parts/work' ); ?>

<div class="tear"></div>

<?php get_template_part( 'template-parts/about' ); ?>

<div class="tear dark"></div>

<?php get_template_part( 'template-parts/testimonials' ); ?>

<?php get_template_part( 'template-parts/brands' ); ?>

<div class="tear dark"></div>

<?php get_template_part( 'template-parts/contact' ); ?>

<?php get_footer(); ?>
