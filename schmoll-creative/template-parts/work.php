<?php
/**
 * template-parts/work.php
 * Pulls live Portfolio CPT posts. Falls back to placeholder if none exist.
 */
$portfolio_args = [
    'post_type'      => 'portfolio',
    'posts_per_page' => 12,
    'meta_query'     => [],
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
];
$portfolio = new WP_Query( $portfolio_args );
?>
<!-- WORK -->
<section class="work" id="work">
    <div class="sec-wrap">
        <div class="sec-head reveal">
            <span class="sec-num">// 02</span>
            <h2 class="sec-title"><?php _e( 'Selected Work', 'schmoll-creative' ); ?></h2>
            <div class="sec-rule"></div>
        </div>

        <div class="work-grid">
        <?php if ( $portfolio->have_posts() ) :
            while ( $portfolio->have_posts() ) : $portfolio->the_post();
                $thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'portfolio-thumb' );
                $role      = get_post_meta( get_the_ID(), '_schmoll_role', true );
                $proj_url  = get_post_meta( get_the_ID(), '_schmoll_url',  true );
                $link      = $proj_url ?: get_permalink();
                $thumb_style = $thumb_url ? ' style="background-image:url(\'' . esc_url( $thumb_url ) . '\')"' : '';
        ?>
            <a class="work-item reveal" href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener">
                <div class="work-thumb"<?php echo $thumb_style; ?>></div>
                <div class="work-over">
                    <span class="work-cat"><?php echo esc_html( $role ?: get_the_terms( get_the_ID(), 'portfolio_category' )[0]->name ?? '' ); ?></span>
                    <span class="work-name"><?php the_title(); ?></span>
                </div>
            </a>
        <?php endwhile; wp_reset_postdata();
        else :
            // Fallback placeholder tiles
            $placeholders = [
                [ 'cat' => 'Branding · Digital',   'name' => 'Green Ox',             'img' => 'https://www.schmollcreative.com/wp-content/uploads/2025/01/GreenOx_hero.jpg',                         'url' => 'https://www.schmollcreative.com/portfolio-items/template/' ],
                [ 'cat' => 'Brand Identity',        'name' => 'Robin Clip',           'img' => 'https://www.schmollcreative.com/wp-content/uploads/2025/12/robin_Hero-1.jpg',                         'url' => 'https://www.schmollcreative.com/portfolio-items/robin-clip/' ],
                [ 'cat' => 'Creative Direction',    'name' => 'Certified Evil Genius', 'img' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/ceg.jpg',                                 'url' => 'https://www.schmollcreative.com/portfolio-items/certified-evil-genius/' ],
                [ 'cat' => 'Brand Identity',        'name' => 'Viscid Surf',          'img' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/portfolio_thumbArtboard-2.jpg',           'url' => 'https://www.schmollcreative.com/portfolio-items/viscid-surf/' ],
                [ 'cat' => 'Art Direction',         'name' => 'ATRA',                 'img' => 'https://www.schmollcreative.com/wp-content/uploads/2025/01/ATRA_hero.jpg',                            'url' => 'https://www.schmollcreative.com/portfolio-items/atra/' ],
                [ 'cat' => 'Branding',              'name' => 'Star Taco',            'img' => 'https://www.schmollcreative.com/wp-content/uploads/2024/10/star_cover.jpg',                           'url' => 'https://www.schmollcreative.com/portfolio-items/star-taco/' ],
                [ 'cat' => 'Art Direction',         'name' => 'Great Wolf Lodge',     'img' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/gwl.jpg',                                 'url' => 'https://www.schmollcreative.com/portfolio-items/great-wolf-lodge/' ],
                [ 'cat' => 'Brand Identity',        'name' => 'Midnight Moon',        'img' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/mms.jpg',                                 'url' => 'https://www.schmollcreative.com/portfolio-items/midnight-moon/' ],
                [ 'cat' => 'Campaign',              'name' => 'Netflix',              'img' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/netflix.jpg',                             'url' => 'https://www.schmollcreative.com/portfolio-items/media-bridge-marketing/' ],
                [ 'cat' => 'Branding · Print',      'name' => 'Sticky Fingers',       'img' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/portfolio_thumbArtboard-3.jpg',           'url' => 'https://www.schmollcreative.com/portfolio-items/stickyfingers/' ],
                [ 'cat' => 'Digital · UX/UI',       'name' => 'Twilio + Authy',       'img' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/twil.jpg',                                'url' => 'https://www.schmollcreative.com/portfolio-items/twilio-authy/' ],
                [ 'cat' => 'Branding',              'name' => 'Your Crawlspace',      'img' => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/portfolio_thumbArtboard-1.jpg',           'url' => 'https://www.schmollcreative.com/portfolio-items/ycs/' ],
            ];
            foreach ( $placeholders as $p ) : ?>
            <a class="work-item reveal" href="<?php echo esc_url( $p['url'] ); ?>" target="_blank" rel="noopener">
                <div class="work-thumb" style="background-image:url('<?php echo esc_url( $p['img'] ); ?>')"></div>
                <div class="work-over">
                    <span class="work-cat"><?php echo esc_html( $p['cat'] ); ?></span>
                    <span class="work-name"><?php echo esc_html( $p['name'] ); ?></span>
                </div>
            </a>
            <?php endforeach;
        endif; ?>
        </div>

        <div style="text-align:center;margin-top:48px;" class="reveal">
            <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ?: 'https://www.schmollcreative.com/recent-work/' ); ?>"
               class="btn btn-ghost"><?php _e( 'View All Work', 'schmoll-creative' ); ?></a>
        </div>
    </div>
</section>
