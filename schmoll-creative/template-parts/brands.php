<?php
/**
 * template-parts/brands.php
 * Brand logo strip. logos are filterable from child themes.
 */
$logos = apply_filters( 'schmoll_brand_logos', [
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/twillo.png',        'alt' => 'Twilio' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/gwl.png',           'alt' => 'Great Wolf Lodge' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/ortho.png',         'alt' => 'OrthoLite' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/musc.png',          'alt' => 'MUSC' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/hpu.png',           'alt' => 'High Point University' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/lennar.png',        'alt' => 'Lennar' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/newyork.png',       'alt' => 'New York Life' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/moon.png',          'alt' => 'Midnight Moon' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/stickyfingers-1.png','alt' => 'Sticky Fingers' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/cm.png',            'alt' => 'CM' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/viscid-1.png',      'alt' => 'Viscid Surf' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/cargo.png',         'alt' => 'Cargo' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/ycs.png',           'alt' => 'Your Crawlspace' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/mex1.png',          'alt' => 'Mex 1' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/sg.png',            'alt' => 'SG' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2025/06/tsc.png',           'alt' => 'Top Shelf Catering' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/ama.png',           'alt' => 'AMA' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/pig.png',           'alt' => 'PIG' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/ggolf.png',         'alt' => 'Golden Golf' ],
    [ 'src' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/freehouse.png',     'alt' => 'Freehouse' ],
] );
?>
<!-- BRANDS -->
<section class="brands">
    <div class="sec-wrap">
        <p class="brands-label reveal"><?php _e( "Brands I've Worked With", 'schmoll-creative' ); ?></p>
        <div class="brands-grid reveal">
            <?php foreach ( $logos as $logo ) : ?>
            <img src="<?php echo esc_url( $logo['src'] ); ?>"
                 alt="<?php echo esc_attr( $logo['alt'] ); ?>"
                 loading="lazy">
            <?php endforeach; ?>
        </div>
    </div>
</section>
