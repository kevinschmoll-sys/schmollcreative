<?php
/**
 * Schmoll Creative — functions.php
 * Theme setup, assets, CPTs, menus, widget areas, customizer.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'SCHMOLL_VERSION', '1.0.0' );
define( 'SCHMOLL_DIR',     get_template_directory() );
define( 'SCHMOLL_URI',     get_template_directory_uri() );

/* ============================================================
   THEME SETUP
   ============================================================ */
function schmoll_setup() {
    load_theme_textdomain( 'schmoll-creative', SCHMOLL_DIR . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'schmoll-creative' ),
        'footer'  => __( 'Footer Navigation',  'schmoll-creative' ),
    ] );

    add_image_size( 'portfolio-thumb',   800, 600, true );
    add_image_size( 'portfolio-hero',   1400, 900, true );
    add_image_size( 'testimonial-avatar', 88,  88, true );
}
add_action( 'after_setup_theme', 'schmoll_setup' );

/* ============================================================
   ENQUEUE STYLES & SCRIPTS
   ============================================================ */
function schmoll_assets() {
    // Main stylesheet
    wp_enqueue_style(
        'schmoll-main',
        SCHMOLL_URI . '/assets/css/main.css',
        [],
        SCHMOLL_VERSION
    );

    // Front-page JS (nav, scroll reveal, smooth scroll)
    wp_enqueue_script(
        'schmoll-main',
        SCHMOLL_URI . '/assets/js/main.js',
        [],
        SCHMOLL_VERSION,
        true
    );

    // Pass dynamic data to JS
    wp_localize_script( 'schmoll-main', 'schmollData', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'schmoll_nonce' ),
    ] );

    // Comment reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'schmoll_assets' );

/* ============================================================
   PORTFOLIO CUSTOM POST TYPE
   ============================================================ */
function schmoll_register_portfolio_cpt() {
    $labels = [
        'name'               => __( 'Portfolio',        'schmoll-creative' ),
        'singular_name'      => __( 'Portfolio Item',   'schmoll-creative' ),
        'add_new_item'       => __( 'Add New Project',  'schmoll-creative' ),
        'edit_item'          => __( 'Edit Project',     'schmoll-creative' ),
        'view_item'          => __( 'View Project',     'schmoll-creative' ),
        'search_items'       => __( 'Search Projects',  'schmoll-creative' ),
        'not_found'          => __( 'No projects found.', 'schmoll-creative' ),
        'menu_name'          => __( 'Portfolio',        'schmoll-creative' ),
    ];
    register_post_type( 'portfolio', [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'rewrite'            => [ 'slug' => 'work' ],
    ] );
}
add_action( 'init', 'schmoll_register_portfolio_cpt' );

/* Portfolio taxonomy */
function schmoll_register_portfolio_taxonomy() {
    register_taxonomy( 'portfolio_category', 'portfolio', [
        'labels'            => [
            'name'          => __( 'Portfolio Categories', 'schmoll-creative' ),
            'singular_name' => __( 'Category',            'schmoll-creative' ),
        ],
        'hierarchical'      => true,
        'show_in_rest'      => true,
        'rewrite'           => [ 'slug' => 'work-category' ],
    ] );
}
add_action( 'init', 'schmoll_register_portfolio_taxonomy' );

/* Portfolio meta boxes */
function schmoll_portfolio_meta_boxes() {
    add_meta_box(
        'schmoll_project_details',
        __( 'Project Details', 'schmoll-creative' ),
        'schmoll_project_details_cb',
        'portfolio',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'schmoll_portfolio_meta_boxes' );

function schmoll_project_details_cb( $post ) {
    wp_nonce_field( 'schmoll_project_details', 'schmoll_project_nonce' );
    $client   = get_post_meta( $post->ID, '_schmoll_client',   true );
    $year     = get_post_meta( $post->ID, '_schmoll_year',     true );
    $role     = get_post_meta( $post->ID, '_schmoll_role',     true );
    $url      = get_post_meta( $post->ID, '_schmoll_url',      true );
    $featured = get_post_meta( $post->ID, '_schmoll_featured', true );
    ?>
    <p>
        <label><strong><?php _e( 'Client', 'schmoll-creative' ); ?></strong></label><br>
        <input type="text" name="schmoll_client" value="<?php echo esc_attr( $client ); ?>" style="width:100%">
    </p>
    <p>
        <label><strong><?php _e( 'Year', 'schmoll-creative' ); ?></strong></label><br>
        <input type="text" name="schmoll_year" value="<?php echo esc_attr( $year ); ?>" style="width:100%">
    </p>
    <p>
        <label><strong><?php _e( 'Role / Category', 'schmoll-creative' ); ?></strong></label><br>
        <input type="text" name="schmoll_role" value="<?php echo esc_attr( $role ); ?>" style="width:100%">
    </p>
    <p>
        <label><strong><?php _e( 'Project URL', 'schmoll-creative' ); ?></strong></label><br>
        <input type="url" name="schmoll_url" value="<?php echo esc_url( $url ); ?>" style="width:100%">
    </p>
    <p>
        <label>
            <input type="checkbox" name="schmoll_featured" value="1" <?php checked( $featured, '1' ); ?>>
            <?php _e( 'Feature on homepage', 'schmoll-creative' ); ?>
        </label>
    </p>
    <?php
}

function schmoll_save_project_meta( $post_id ) {
    if ( ! isset( $_POST['schmoll_project_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['schmoll_project_nonce'], 'schmoll_project_details' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [ 'schmoll_client' => '_schmoll_client', 'schmoll_year' => '_schmoll_year', 'schmoll_role' => '_schmoll_role' ];
    foreach ( $fields as $key => $meta ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $meta, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
    if ( isset( $_POST['schmoll_url'] ) ) {
        update_post_meta( $post_id, '_schmoll_url', esc_url_raw( $_POST['schmoll_url'] ) );
    }
    update_post_meta( $post_id, '_schmoll_featured', isset( $_POST['schmoll_featured'] ) ? '1' : '0' );
}
add_action( 'save_post', 'schmoll_save_project_meta' );

/* ============================================================
   TESTIMONIAL CUSTOM POST TYPE
   ============================================================ */
function schmoll_register_testimonial_cpt() {
    register_post_type( 'testimonial', [
        'labels'        => [
            'name'          => __( 'Testimonials',    'schmoll-creative' ),
            'singular_name' => __( 'Testimonial',     'schmoll-creative' ),
            'add_new_item'  => __( 'Add Testimonial', 'schmoll-creative' ),
        ],
        'public'        => false,
        'show_ui'       => true,
        'show_in_rest'  => true,
        'menu_icon'     => 'dashicons-format-quote',
        'supports'      => [ 'title', 'editor', 'thumbnail' ],
    ] );
}
add_action( 'init', 'schmoll_register_testimonial_cpt' );

function schmoll_testimonial_meta_boxes() {
    add_meta_box( 'schmoll_testi_meta', __( 'Attribution', 'schmoll-creative' ), 'schmoll_testi_meta_cb', 'testimonial', 'side' );
}
add_action( 'add_meta_boxes', 'schmoll_testimonial_meta_boxes' );

function schmoll_testi_meta_cb( $post ) {
    wp_nonce_field( 'schmoll_testi_meta', 'schmoll_testi_nonce' );
    $name    = get_post_meta( $post->ID, '_testi_name',    true );
    $role    = get_post_meta( $post->ID, '_testi_role',    true );
    $company = get_post_meta( $post->ID, '_testi_company', true );
    ?>
    <p><label><strong>Name</strong></label><br><input type="text" name="testi_name" value="<?php echo esc_attr($name); ?>" style="width:100%"></p>
    <p><label><strong>Title / Role</strong></label><br><input type="text" name="testi_role" value="<?php echo esc_attr($role); ?>" style="width:100%"></p>
    <p><label><strong>Company</strong></label><br><input type="text" name="testi_company" value="<?php echo esc_attr($company); ?>" style="width:100%"></p>
    <?php
}

function schmoll_save_testi_meta( $post_id ) {
    if ( ! isset( $_POST['schmoll_testi_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['schmoll_testi_nonce'], 'schmoll_testi_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    foreach ( [ 'testi_name' => '_testi_name', 'testi_role' => '_testi_role', 'testi_company' => '_testi_company' ] as $k => $m ) {
        if ( isset( $_POST[$k] ) ) update_post_meta( $post_id, $m, sanitize_text_field( $_POST[$k] ) );
    }
}
add_action( 'save_post', 'schmoll_save_testi_meta' );

/* ============================================================
   THEME OPTIONS (Appearance > Theme Options)
   ============================================================ */
function schmoll_options_page() {
    add_theme_page(
        __( 'Theme Options', 'schmoll-creative' ),
        __( 'Theme Options', 'schmoll-creative' ),
        'manage_options',
        'schmoll-options',
        'schmoll_options_page_html'
    );
}
add_action( 'admin_menu', 'schmoll_options_page' );

function schmoll_options_admin_scripts( $hook ) {
    if ( $hook !== 'appearance_page_schmoll-options' ) return;
    wp_enqueue_media();
    wp_add_inline_script( 'jquery-core', "
        jQuery(function($){
            $('.schmoll-media-btn').on('click', function(e){
                e.preventDefault();
                var btn    = $(this);
                var target = btn.data('target');
                var prev   = btn.data('preview');
                var frame  = wp.media({ title: 'Select Image', button: { text: 'Use this image' }, multiple: false });
                frame.on('select', function(){
                    var att = frame.state().get('selection').first().toJSON();
                    $('#' + target).val(att.id);
                    $('#' + prev).attr('src', att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url).show();
                });
                frame.open();
            });
        });
    " );
}
add_action( 'admin_enqueue_scripts', 'schmoll_options_admin_scripts' );

function schmoll_options_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    if ( isset( $_POST['schmoll_options_nonce'] ) && wp_verify_nonce( $_POST['schmoll_options_nonce'], 'schmoll_save_options' ) ) {
        $fields = [ 'hero_eyebrow', 'hero_headline_1', 'hero_headline_2', 'hero_sub', 'stat_1_n', 'stat_1_l', 'stat_2_n', 'stat_2_l', 'stat_3_n', 'stat_3_l', 'contact_email', 'linkedin_url', 'instagram_url', 'behance_url', 'marquee_text' ];
        foreach ( $fields as $f ) {
            update_option( 'schmoll_' . $f, sanitize_text_field( $_POST[ $f ] ?? '' ) );
        }
        foreach ( [ 'hero_image_id', 'about_image_id' ] as $img_field ) {
            if ( isset( $_POST[ $img_field ] ) && is_numeric( $_POST[ $img_field ] ) ) {
                update_option( 'schmoll_' . $img_field, absint( $_POST[ $img_field ] ) );
            }
        }
        echo '<div class="updated"><p>Options saved.</p></div>';
    }
    $g = fn($k) => get_option( 'schmoll_' . $k, '' );
    ?>
    <div class="wrap">
        <h1>Schmoll Creative — Theme Options</h1>
        <form method="post">
            <?php wp_nonce_field( 'schmoll_save_options', 'schmoll_options_nonce' ); ?>
            <h2>Hero Section</h2>
            <table class="form-table">
                <tr>
                    <th>Hero Image</th>
                    <td>
                        <?php $hero_id = (int) get_option( 'schmoll_hero_image_id' ); $hero_thumb = $hero_id ? wp_get_attachment_image_url( $hero_id, 'thumbnail' ) : ''; ?>
                        <input type="hidden" id="hero_image_id" name="hero_image_id" value="<?php echo esc_attr( $hero_id ?: '' ); ?>">
                        <img id="hero_image_preview" src="<?php echo esc_url( $hero_thumb ); ?>" style="max-width:120px;display:<?php echo $hero_thumb ? 'block' : 'none'; ?>;margin-bottom:6px;">
                        <button type="button" class="button schmoll-media-btn" data-target="hero_image_id" data-preview="hero_image_preview">Select Hero Image</button>
                    </td>
                </tr>
                <tr><th>Eyebrow Text</th><td><input name="hero_eyebrow" value="<?php echo esc_attr($g('hero_eyebrow')); ?>" class="regular-text" placeholder="Art Direction · Creative Direction · Brand Strategy"></td></tr>
                <tr><th>Headline Word 1 (charcoal)</th><td><input name="hero_headline_1" value="<?php echo esc_attr($g('hero_headline_1')); ?>" class="regular-text" placeholder="Bold"></td></tr>
                <tr><th>Headline Word 2 (blue)</th><td><input name="hero_headline_2" value="<?php echo esc_attr($g('hero_headline_2')); ?>" class="regular-text" placeholder="Brands."></td></tr>
                <tr><th>Sub-headline</th><td><textarea name="hero_sub" class="large-text" rows="2"><?php echo esc_textarea($g('hero_sub')); ?></textarea></td></tr>
            </table>
            <h2>Stats</h2>
            <table class="form-table">
                <tr><th>Stat 1 Number</th><td><input name="stat_1_n" value="<?php echo esc_attr($g('stat_1_n')); ?>" class="small-text" placeholder="20+"></td></tr>
                <tr><th>Stat 1 Label</th><td><input name="stat_1_l" value="<?php echo esc_attr($g('stat_1_l')); ?>" class="regular-text" placeholder="Years"></td></tr>
                <tr><th>Stat 2 Number</th><td><input name="stat_2_n" value="<?php echo esc_attr($g('stat_2_n')); ?>" class="small-text" placeholder="150+"></td></tr>
                <tr><th>Stat 2 Label</th><td><input name="stat_2_l" value="<?php echo esc_attr($g('stat_2_l')); ?>" class="regular-text" placeholder="Brands"></td></tr>
                <tr><th>Stat 3 Number</th><td><input name="stat_3_n" value="<?php echo esc_attr($g('stat_3_n')); ?>" class="small-text" placeholder="∞"></td></tr>
                <tr><th>Stat 3 Label</th><td><input name="stat_3_l" value="<?php echo esc_attr($g('stat_3_l')); ?>" class="regular-text" placeholder="Ideas"></td></tr>
            </table>
            <h2>Marquee / Ticker</h2>
            <table class="form-table">
                <tr><th>Marquee Text (separate items with ·)</th><td><input name="marquee_text" value="<?php echo esc_attr($g('marquee_text')); ?>" class="large-text" placeholder="Art Direction · Brand Identity · Creative Direction · Visual Strategy · UI/UX Design · Print · Digital"></td></tr>
            </table>
            <h2>About Section</h2>
            <table class="form-table">
                <tr>
                    <th>About / Profile Image</th>
                    <td>
                        <?php $about_id = (int) get_option( 'schmoll_about_image_id' ); $about_thumb = $about_id ? wp_get_attachment_image_url( $about_id, 'thumbnail' ) : ''; ?>
                        <input type="hidden" id="about_image_id" name="about_image_id" value="<?php echo esc_attr( $about_id ?: '' ); ?>">
                        <img id="about_image_preview" src="<?php echo esc_url( $about_thumb ); ?>" style="max-width:120px;display:<?php echo $about_thumb ? 'block' : 'none'; ?>;margin-bottom:6px;">
                        <button type="button" class="button schmoll-media-btn" data-target="about_image_id" data-preview="about_image_preview">Select About Image</button>
                    </td>
                </tr>
            </table>
            <h2>Contact & Social</h2>
            <table class="form-table">
                <tr><th>Contact Email</th><td><input name="contact_email" value="<?php echo esc_attr($g('contact_email')); ?>" class="regular-text" placeholder="kevin@schmollcreative.com"></td></tr>
                <tr><th>LinkedIn URL</th><td><input name="linkedin_url" value="<?php echo esc_attr($g('linkedin_url')); ?>" class="regular-text"></td></tr>
                <tr><th>Instagram URL</th><td><input name="instagram_url" value="<?php echo esc_attr($g('instagram_url')); ?>" class="regular-text"></td></tr>
                <tr><th>Behance URL</th><td><input name="behance_url" value="<?php echo esc_attr($g('behance_url')); ?>" class="regular-text"></td></tr>
            </table>
            <?php submit_button( 'Save Options' ); ?>
        </form>
    </div>
    <?php
}

/* ============================================================
   WIDGET AREAS
   ============================================================ */
function schmoll_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Footer Widget Area', 'schmoll-creative' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'schmoll_widgets_init' );

/* ============================================================
   HELPER: get option with fallback
   ============================================================ */
function schmoll_opt( $key, $fallback = '' ) {
    return get_option( 'schmoll_' . $key, $fallback );
}

/* ============================================================
   AVADA BUILDER / AVADA CORE COMPATIBILITY
   ============================================================ */

/**
 * Register the Portfolio CPT with Avada Builder so individual
 * project pages can be built with the drag-and-drop editor.
 */
add_filter( 'fusion_builder_post_types', 'schmoll_avada_post_types' );
function schmoll_avada_post_types( $post_types ) {
    if ( ! in_array( 'portfolio', $post_types, true ) ) {
        $post_types[] = 'portfolio';
    }
    return $post_types;
}

/**
 * Skip theme stylesheet inside the Avada Builder live-preview
 * iframe to prevent CSS conflicts while editing.
 */
add_action( 'wp_enqueue_scripts', 'schmoll_maybe_dequeue_in_builder', 20 );
function schmoll_maybe_dequeue_in_builder() {
    if ( function_exists( 'fusion_is_preview_frame' ) && fusion_is_preview_frame() ) {
        wp_dequeue_style( 'schmoll-main' );
    }
}

/**
 * Add a body class when Avada Builder is present so CSS can
 * target Avada-specific contexts safely.
 */
add_filter( 'body_class', 'schmoll_avada_body_class' );
function schmoll_avada_body_class( $classes ) {
    if ( class_exists( 'FusionBuilder' ) ) {
        $classes[] = 'schmoll-avada-active';
    }
    return $classes;
}
