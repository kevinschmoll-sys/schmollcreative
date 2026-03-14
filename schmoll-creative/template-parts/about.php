<?php
/**
 * template-parts/about.php
 */
$about_image_id = get_option( 'schmoll_about_image_id' );
$about_src      = $about_image_id
    ? wp_get_attachment_image_url( $about_image_id, 'portfolio-thumb' )
    : '';
?>
<!-- ABOUT -->
<section class="about" id="about">
    <div class="sec-wrap">

        <div class="about-img-wrap reveal">
            <div class="about-img">
                <?php if ( $about_src ) : ?>
                    <img src="<?php echo esc_url( $about_src ); ?>"
                         alt="<?php esc_attr_e( 'Kevin Schmoll', 'schmoll-creative' ); ?>"
                         width="380" height="380" loading="lazy">
                <?php endif; ?>
            </div>
            <div class="about-badge">Charleston, SC</div>
        </div>

        <div>
            <div class="sec-head reveal" style="margin-bottom:20px;">
                <span class="sec-num">// 03</span>
                <h2 class="sec-title"><?php _e( 'The Human', 'schmoll-creative' ); ?></h2>
            </div>

            <p class="about-kicker reveal"><?php _e( "Hi, I'm Kevin.", 'schmoll-creative' ); ?></p>

            <p class="about-body reveal">
                <?php _e( 'With over <strong>20 years of experience</strong> in the field, I\'ve developed a keen eye for detail and a deep understanding of the importance of design in marketing and advertising. My expertise lets me work with a diverse range of clients — from small businesses establishing a brand identity to large corporations revamping their design collateral.', 'schmoll-creative' ); ?>
            </p>
            <p class="about-body reveal">
                <?php _e( 'I believe a well-designed graphic conveys a message and evokes emotions, making a lasting impression. I ensure my designs not only look good but effectively communicate the values of the brand. Based in <strong>Charleston, SC</strong> — operating globally under <strong>Schmoll Creative</strong>.', 'schmoll-creative' ); ?>
            </p>
            <p class="about-body reveal">
                <?php _e( 'Available for <strong>freelance projects</strong> and <strong>full-time creative roles</strong>.', 'schmoll-creative' ); ?>
            </p>

            <div class="skills reveal">
                <?php
                $skills = apply_filters( 'schmoll_skills', [
                    'Brand Identity', 'Art Direction', 'Creative Direction', 'UX/UI Design',
                    'Print Design', 'Visual Strategy', 'Midjourney', 'Adobe Firefly',
                    'DALL·E', 'Stable Diffusion', 'Runway ML', 'Figma',
                    'Adobe Creative Suite', 'Procreate',
                ] );
                foreach ( $skills as $skill ) {
                    echo '<span class="skill">' . esc_html( $skill ) . '</span>';
                }
                ?>
            </div>
        </div>

    </div>
</section>
