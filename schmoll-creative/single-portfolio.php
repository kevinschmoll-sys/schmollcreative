<?php
/**
 * single-portfolio.php — single portfolio project view
 */
get_header();

while ( have_posts() ) : the_post();
    $client  = get_post_meta( get_the_ID(), '_schmoll_client', true );
    $year    = get_post_meta( get_the_ID(), '_schmoll_year',   true );
    $role    = get_post_meta( get_the_ID(), '_schmoll_role',   true );
    $url     = get_post_meta( get_the_ID(), '_schmoll_url',    true );
    $hero    = get_the_post_thumbnail_url( get_the_ID(), 'portfolio-hero' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="padding-top:66px;">

    <?php if ( $hero ) : ?>
    <div style="width:100%;max-height:560px;overflow:hidden;position:relative;">
        <img src="<?php echo esc_url( $hero ); ?>"
             alt="<?php the_title_attribute(); ?>"
             style="width:100%;object-fit:cover;filter:contrast(1.08) saturate(0.85);"
             loading="eager">
        <div style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,var(--ink));"></div>
    </div>
    <?php endif; ?>

    <div class="sec-wrap" style="max-width:900px;margin:0 auto;">

        <!-- Meta bar -->
        <div style="display:flex;flex-wrap:wrap;gap:24px;margin-bottom:36px;border-bottom:1px solid var(--ink-4);padding-bottom:24px;">
            <?php if ( $client ) : ?>
            <div>
                <div style="font-size:0.6rem;letter-spacing:3px;text-transform:uppercase;color:var(--blue);margin-bottom:4px;"><?php _e( 'Client', 'schmoll-creative' ); ?></div>
                <div style="font-family:var(--f-ui);font-weight:400;color:var(--paper);"><?php echo esc_html( $client ); ?></div>
            </div>
            <?php endif; ?>
            <?php if ( $role ) : ?>
            <div>
                <div style="font-size:0.6rem;letter-spacing:3px;text-transform:uppercase;color:var(--blue);margin-bottom:4px;"><?php _e( 'Role', 'schmoll-creative' ); ?></div>
                <div style="font-family:var(--f-ui);font-weight:400;color:var(--paper);"><?php echo esc_html( $role ); ?></div>
            </div>
            <?php endif; ?>
            <?php if ( $year ) : ?>
            <div>
                <div style="font-size:0.6rem;letter-spacing:3px;text-transform:uppercase;color:var(--blue);margin-bottom:4px;"><?php _e( 'Year', 'schmoll-creative' ); ?></div>
                <div style="font-family:var(--f-ui);font-weight:400;color:var(--paper);"><?php echo esc_html( $year ); ?></div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Title -->
        <h1 style="font-family:var(--f-black);font-weight:900;font-size:clamp(2rem,6vw,3.5rem);color:var(--paper);line-height:1;margin-bottom:28px;">
            <?php the_title(); ?>
        </h1>

        <!-- Content -->
        <div style="color:var(--paper-dim);line-height:1.8;font-weight:300;max-width:720px;">
            <?php the_content(); ?>
        </div>

        <!-- CTAs -->
        <div style="margin-top:40px;display:flex;gap:14px;flex-wrap:wrap;">
            <?php if ( $url ) : ?>
            <a href="<?php echo esc_url( $url ); ?>" class="btn btn-primary" target="_blank" rel="noopener">
                <?php _e( 'View Live Project', 'schmoll-creative' ); ?>
            </a>
            <?php endif; ?>
            <a href="<?php echo esc_url( home_url( '/#work' ) ); ?>" class="btn btn-ghost">
                &larr; <?php _e( 'Back to Work', 'schmoll-creative' ); ?>
            </a>
        </div>

    </div>
</article>

<?php endwhile; ?>
<?php get_footer(); ?>
