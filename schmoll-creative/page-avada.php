<?php
/**
 * Template Name: Avada Builder — Full Width
 *
 * A blank canvas page template that removes the theme's fixed
 * navigation and footer chrome, giving Avada Builder full control
 * over the layout from header to footer.
 *
 * Usage: assign this template to any Page in the WordPress editor
 * via Page Attributes > Template.
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class( 'schmoll-avada-canvas' ); ?>>
<?php wp_body_open(); ?>

<?php while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; ?>

<?php wp_footer(); ?>
</body>
</html>
