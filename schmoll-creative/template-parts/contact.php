<?php
/**
 * template-parts/contact.php
 */
$email = schmoll_opt( 'contact_email', 'kevin@schmollcreative.com' );
?>
<!-- CONTACT -->
<section class="contact" id="contact">
    <span class="contact-tag reveal"><?php _e( 'Available Now', 'schmoll-creative' ); ?></span>

    <h2 class="contact-headline reveal">
        <?php _e( 'Got a brand', 'schmoll-creative' ); ?><br>
        <span class="blue"><?php _e( 'problem?', 'schmoll-creative' ); ?></span>
    </h2>

    <p class="contact-sub reveal">
        <?php _e( 'Freelance projects, full-time roles, or just want to talk shop — I\'m all ears.', 'schmoll-creative' ); ?>
    </p>

    <div class="contact-btns reveal">
        <a href="mailto:<?php echo esc_attr( $email ); ?>" class="btn btn-primary">
            <?php _e( 'Send an Email', 'schmoll-creative' ); ?>
        </a>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-ghost" target="_blank" rel="noopener">
            schmollcreative.com
        </a>
    </div>
</section>
