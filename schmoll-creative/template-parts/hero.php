<?php
/**
 * template-parts/hero.php
 * Hero section — uses Slider Revolution for the visual area if active,
 * falls back to the static featured image.
 */

$eyebrow  = schmoll_opt( 'hero_eyebrow',    'Art Direction · Creative Direction · Brand Strategy' );
$hl1      = schmoll_opt( 'hero_headline_1', 'Bold' );
$hl2      = schmoll_opt( 'hero_headline_2', 'Brands.' );
$sub      = schmoll_opt( 'hero_sub',        '20+ years turning forgettable brands into visual experiences people can\'t scroll past. Available for freelance &amp; full-time.' );
$stat_1n  = schmoll_opt( 'stat_1_n', '20+' );
$stat_1l  = schmoll_opt( 'stat_1_l', 'Years' );
$stat_2n  = schmoll_opt( 'stat_2_n', '150+' );
$stat_2l  = schmoll_opt( 'stat_2_l', 'Brands' );
$stat_3n  = schmoll_opt( 'stat_3_n', '∞' );
$stat_3l  = schmoll_opt( 'stat_3_l', 'Ideas' );

/**
 * Slider Revolution integration.
 *
 * SETUP INSTRUCTIONS:
 * 1. Install & activate the Slider Revolution plugin.
 * 2. Create a new slider — recommended settings:
 *      - Slider type: Fullwidth
 *      - Min height: 100vh (or set to match hero panel)
 *      - Add your hero imagery / video as layers
 *      - Use the alias "schmoll-hero" for the slider
 * 3. The alias is stored in Appearance > Theme Options > Hero Slider Alias
 *    (defaults to "schmoll-hero").
 *
 * If Slider Revolution is not active, the static hero image from the
 * "Hero Image" custom field falls back automatically.
 */
$sr_alias      = schmoll_opt( 'sr_hero_alias', 'schmoll-hero' );
$use_slider    = function_exists( 'putRevSlider' ) && ! empty( $sr_alias );
$hero_image_id = get_option( 'schmoll_hero_image_id' );
$hero_src      = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'portfolio-hero' ) : get_template_directory_uri() . '/assets/img/hero-placeholder.jpg';
?>

<!-- HERO -->
<section class="hero" id="home">

    <!-- Visual panel: Slider Revolution or static image -->
    <div class="hero-art">
        <?php if ( $use_slider ) : ?>
            <?php putRevSlider( esc_attr( $sr_alias ) ); ?>
        <?php else : ?>
            <span class="hero-caption">Art Director · Charleston SC</span>
            <img src="<?php echo esc_url( $hero_src ); ?>"
                 alt="<?php esc_attr_e( 'Kevin Schmoll — Art Director', 'schmoll-creative' ); ?>"
                 width="700" height="525"
                 loading="eager"
                 decoding="async">
        <?php endif; ?>
    </div>

    <!-- Copy panel -->
    <div class="hero-content">
        <p class="hero-eyebrow reveal"><?php echo esc_html( $eyebrow ); ?></p>

        <h1 class="hero-headline reveal">
            <span class="charcoal"><?php echo esc_html( $hl1 ); ?></span><br>
            <span class="blue"><?php echo esc_html( $hl2 ); ?></span>
        </h1>

        <p class="hero-sub reveal"><?php echo wp_kses_post( $sub ); ?></p>

        <div class="hero-ctas reveal">
            <a href="#work"    class="btn btn-primary"><?php _e( 'View My Work', 'schmoll-creative' ); ?></a>
            <a href="#contact" class="btn btn-ghost"><?php _e( "Let's Talk", 'schmoll-creative' ); ?></a>
        </div>

        <div class="hero-stats reveal">
            <div class="stat">
                <div class="stat-n"><?php echo esc_html( $stat_1n ); ?></div>
                <div class="stat-l"><?php echo esc_html( $stat_1l ); ?></div>
            </div>
            <div class="stat">
                <div class="stat-n"><?php echo esc_html( $stat_2n ); ?></div>
                <div class="stat-l"><?php echo esc_html( $stat_2l ); ?></div>
            </div>
            <div class="stat">
                <div class="stat-n"><?php echo esc_html( $stat_3n ); ?></div>
                <div class="stat-l"><?php echo esc_html( $stat_3l ); ?></div>
            </div>
        </div>
    </div>

</section>
