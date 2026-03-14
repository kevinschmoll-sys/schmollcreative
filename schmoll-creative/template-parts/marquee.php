<?php
/**
 * template-parts/marquee.php
 */
$raw   = schmoll_opt( 'marquee_text', 'Art Direction · Brand Identity · Creative Direction · Visual Strategy · UI/UX Design · Print · Digital · Illustration' );
$items = array_map( 'trim', explode( '·', $raw ) );
// Build doubled track for seamless loop
$track = '';
foreach ( array_merge( $items, $items ) as $item ) {
    $track .= '<span>' . esc_html( $item ) . '</span><span class="sep">·</span>';
}
?>
<!-- MARQUEE -->
<div class="marquee-wrap" aria-hidden="true">
    <div class="marquee-track"><?php echo $track; ?></div>
</div>
