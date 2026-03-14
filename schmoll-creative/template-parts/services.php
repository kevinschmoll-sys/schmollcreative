<?php
/**
 * template-parts/services.php
 *
 * Services are editable via the schmoll_services filter so child themes
 * can override without touching this file.
 */
$services = apply_filters( 'schmoll_services', [
    [
        'n'     => '01',
        'title' => 'Brand Identity',
        'desc'  => 'Logo systems, color, type, voice — the complete visual DNA that makes a brand unmistakable.',
    ],
    [
        'n'     => '02',
        'title' => 'Art Direction',
        'desc'  => 'Campaign concepting, shoot direction, and visual storytelling across every channel.',
    ],
    [
        'n'     => '03',
        'title' => 'Creative Direction',
        'desc'  => 'Senior-level oversight of teams, agencies, and vendors to keep the work sharp end-to-end.',
    ],
    [
        'n'     => '04',
        'title' => 'Digital Design',
        'desc'  => 'Web, UX/UI, email, social — digital executions built on solid brand foundations.',
    ],
    [
        'n'     => '05',
        'title' => 'Print & Collateral',
        'desc'  => 'Brochures, packaging, environmental, and everything else that exists in physical space.',
    ],
    [
        'n'     => '06',
        'title' => 'AI-Assisted Design',
        'desc'  => 'Midjourney, Firefly, DALL·E, Stable Diffusion, and Runway ML — used as force multipliers, not shortcuts.',
    ],
] );
?>
<!-- SERVICES -->
<section class="services" id="services">
    <div class="sec-wrap">
        <div class="sec-head reveal">
            <span class="sec-num">// 01</span>
            <h2 class="sec-title"><?php _e( 'What I Do', 'schmoll-creative' ); ?></h2>
            <div class="sec-rule"></div>
        </div>
        <div class="svc-grid">
            <?php foreach ( $services as $svc ) : ?>
            <div class="svc-card reveal">
                <span class="svc-n"><?php echo esc_html( $svc['n'] ); ?></span>
                <h3 class="svc-title"><?php echo esc_html( $svc['title'] ); ?></h3>
                <p class="svc-desc"><?php echo esc_html( $svc['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
