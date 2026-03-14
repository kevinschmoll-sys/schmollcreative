<?php
/**
 * index.php — fallback template.
 * Used for blog/archive views. The actual homepage uses front-page.php.
 */
get_header();
?>
<main class="site-main" style="padding-top:66px;min-height:60vh;">
    <div class="sec-wrap" style="max-width:860px;margin:0 auto;">
        <?php if ( have_posts() ) : ?>
            <div class="sec-head" style="margin-bottom:40px;">
                <h1 class="sec-title">
                    <?php
                    if ( is_archive() )      the_archive_title();
                    elseif ( is_search() )   printf( esc_html__( 'Search: %s', 'schmoll-creative' ), get_search_query() );
                    else                     esc_html_e( 'Latest Posts', 'schmoll-creative' );
                    ?>
                </h1>
            </div>
            <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?> style="margin-bottom:48px;border-bottom:1px solid var(--ink-4);padding-bottom:40px;">
                <h2 style="font-family:var(--f-black);font-weight:900;font-size:clamp(1.4rem,4vw,2rem);margin-bottom:10px;">
                    <a href="<?php the_permalink(); ?>" style="color:var(--paper);"><?php the_title(); ?></a>
                </h2>
                <p style="font-size:0.78rem;color:var(--paper-dim);letter-spacing:2px;text-transform:uppercase;margin-bottom:16px;">
                    <?php echo get_the_date(); ?>
                </p>
                <div style="color:var(--paper-dim);line-height:1.75;">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-ghost" style="margin-top:18px;display:inline-block;">
                    <?php esc_html_e( 'Read More', 'schmoll-creative' ); ?>
                </a>
            </article>
            <?php endwhile; ?>
            <div><?php the_posts_pagination(); ?></div>
        <?php else : ?>
            <p style="color:var(--paper-dim);"><?php esc_html_e( 'Nothing found.', 'schmoll-creative' ); ?></p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
