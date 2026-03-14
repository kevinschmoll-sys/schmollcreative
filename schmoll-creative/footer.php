<footer role="contentinfo">
    <div class="footer-logo">
        Schmoll<span class="dot">.</span>
    </div>

    <div class="footer-copy">
        &copy; <?php echo date( 'Y' ); ?> Schmoll Creative. All rights reserved.
    </div>

    <nav class="footer-nav" aria-label="<?php esc_attr_e( 'Footer Navigation', 'schmoll-creative' ); ?>">
        <?php $li = schmoll_opt( 'linkedin_url' );  if ( $li )  : ?><a href="<?php echo esc_url( $li ); ?>" target="_blank" rel="noopener">LinkedIn</a><?php endif; ?>
        <?php $ig = schmoll_opt( 'instagram_url' ); if ( $ig )  : ?><a href="<?php echo esc_url( $ig ); ?>" target="_blank" rel="noopener">Instagram</a><?php endif; ?>
        <?php $bh = schmoll_opt( 'behance_url' );   if ( $bh )  : ?><a href="<?php echo esc_url( $bh ); ?>" target="_blank" rel="noopener">Behance</a><?php endif; ?>
    </nav>
</footer>

<?php wp_footer(); ?>
</body>
</html>
