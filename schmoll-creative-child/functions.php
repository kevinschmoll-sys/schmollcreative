<?php
/**
 * Schmoll Creative Child — functions.php
 *
 * This file loads the parent stylesheet and provides hooks for
 * safe customisation without touching the parent theme.
 *
 * ── SLIDER REVOLUTION SETUP ──────────────────────────────────
 *
 * 1. Purchase & install the Slider Revolution plugin
 *    https://www.sliderrevolution.com
 *
 * 2. In WordPress admin go to:
 *    Slider Revolution > New Slider
 *
 * 3. Recommended hero slider settings:
 *    - Layout:        Fullwidth
 *    - Min Height:    100vh
 *    - Alias:         schmoll-hero   ← IMPORTANT
 *    - Slides:        Add your hero images / video as layers
 *    - Navigation:    Disable arrows / bullets for a clean look
 *
 * 4. In Appearance > Theme Options > Hero Slider Alias
 *    confirm the alias is set to "schmoll-hero"
 *    (or whatever alias you used above).
 *
 * 5. The hero.php template-part calls putRevSlider( 'schmoll-hero' )
 *    automatically when the plugin is active. If the plugin is
 *    inactive, it falls back to the static hero image.
 *
 * ─────────────────────────────────────────────────────────────
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ── Load parent stylesheet ── */
add_action( 'wp_enqueue_scripts', 'schmoll_child_enqueue_styles' );
function schmoll_child_enqueue_styles() {
    wp_enqueue_style(
        'schmoll-parent',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        wp_get_theme( 'schmoll-creative' )->get( 'Version' )
    );
    wp_enqueue_style(
        'schmoll-child',
        get_stylesheet_uri(),
        [ 'schmoll-parent' ],
        wp_get_theme()->get( 'Version' )
    );
}

/* ── Extend Theme Options with Slider Revolution alias field ── */
add_action( 'admin_menu', 'schmoll_child_extend_options', 20 );
function schmoll_child_extend_options() {
    // The SR alias field is saved/displayed via the filter below.
    // We hook into the parent's options save action via admin_post.
}

/**
 * Add SR alias to the parent's options form.
 * Hooks into the options page output using output buffering is not
 * ideal — instead we use a dedicated sub-section via Settings API.
 */
add_action( 'admin_init', 'schmoll_child_register_sr_setting' );
function schmoll_child_register_sr_setting() {
    register_setting( 'schmoll_child_options', 'schmoll_sr_hero_alias', [
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => 'schmoll-hero',
    ] );
}

add_action( 'admin_menu', 'schmoll_child_sr_options_page' );
function schmoll_child_sr_options_page() {
    add_theme_page(
        __( 'Slider Revolution Settings', 'schmoll-creative-child' ),
        __( 'SR Settings', 'schmoll-creative-child' ),
        'manage_options',
        'schmoll-sr-options',
        'schmoll_child_sr_options_html'
    );
}

function schmoll_child_sr_options_html() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    if ( isset( $_POST['schmoll_sr_nonce'] ) &&
         wp_verify_nonce( $_POST['schmoll_sr_nonce'], 'schmoll_sr_save' ) ) {
        update_option( 'schmoll_sr_hero_alias', sanitize_text_field( $_POST['sr_alias'] ?? 'schmoll-hero' ) );
        echo '<div class="updated"><p>Slider Revolution settings saved.</p></div>';
    }

    $alias        = get_option( 'schmoll_sr_hero_alias', 'schmoll-hero' );
    $sr_active    = function_exists( 'putRevSlider' );
    $status_color = $sr_active ? 'green' : 'orange';
    $status_text  = $sr_active
        ? __( 'Slider Revolution is active ✓', 'schmoll-creative-child' )
        : __( 'Slider Revolution is NOT installed / activated. The static hero image will be shown instead.', 'schmoll-creative-child' );
    ?>
    <div class="wrap">
        <h1><?php _e( 'Slider Revolution Settings', 'schmoll-creative-child' ); ?></h1>
        <p style="color:<?php echo esc_attr( $status_color ); ?>;font-weight:600;"><?php echo esc_html( $status_text ); ?></p>

        <?php if ( ! $sr_active ) : ?>
        <p>
            <?php _e( 'To enable the animated hero slider:', 'schmoll-creative-child' ); ?><br>
            1. <?php printf( __( 'Purchase Slider Revolution at %s', 'schmoll-creative-child' ), '<a href="https://www.sliderrevolution.com" target="_blank">sliderrevolution.com</a>' ); ?><br>
            2. <?php _e( 'Install and activate the plugin in Plugins > Add New > Upload Plugin.', 'schmoll-creative-child' ); ?><br>
            3. <?php _e( 'Create a new slider with the alias set below and add your hero imagery.', 'schmoll-creative-child' ); ?><br>
            4. <?php _e( 'Refresh — the hero section will automatically switch to the slider.', 'schmoll-creative-child' ); ?>
        </p>
        <?php endif; ?>

        <form method="post">
            <?php wp_nonce_field( 'schmoll_sr_save', 'schmoll_sr_nonce' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="sr_alias"><?php _e( 'Hero Slider Alias', 'schmoll-creative-child' ); ?></label>
                    </th>
                    <td>
                        <input type="text"
                               id="sr_alias"
                               name="sr_alias"
                               value="<?php echo esc_attr( $alias ); ?>"
                               class="regular-text"
                               placeholder="schmoll-hero">
                        <p class="description">
                            <?php _e( 'Must match the "Alias" field in your Slider Revolution slider settings. Default: <code>schmoll-hero</code>', 'schmoll-creative-child' ); ?>
                        </p>
                    </td>
                </tr>
            </table>
            <?php submit_button( __( 'Save SR Settings', 'schmoll-creative-child' ) ); ?>
        </form>

        <?php if ( $sr_active ) : ?>
        <hr>
        <h2><?php _e( 'Your Sliders', 'schmoll-creative-child' ); ?></h2>
        <p><?php _e( 'Manage sliders at:', 'schmoll-creative-child' ); ?>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=revslider' ) ); ?>">
                <?php _e( 'Slider Revolution Dashboard', 'schmoll-creative-child' ); ?> &rarr;
            </a>
        </p>
        <?php endif; ?>
    </div>
    <?php
}

/* ── Example: override services via filter ── */
/*
add_filter( 'schmoll_services', function( $services ) {
    // Add, remove, or reorder services here.
    return $services;
} );
*/

/* ── Example: override brand logos via filter ── */
/*
add_filter( 'schmoll_brand_logos', function( $logos ) {
    // Return a custom array of [ 'src' => '...', 'alt' => '...' ] items.
    return $logos;
} );
*/
