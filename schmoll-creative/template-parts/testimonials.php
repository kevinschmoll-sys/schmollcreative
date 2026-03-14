<?php
/**
 * template-parts/testimonials.php
 * Pulls live Testimonial CPT. Falls back to hardcoded data if none exist.
 */
$testi_query = new WP_Query( [
    'post_type'      => 'testimonial',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order date',
    'order'          => 'ASC',
] );
?>
<!-- TESTIMONIALS -->
<section class="testimonials" id="testimonials">
    <div class="sec-wrap">
        <div class="sec-head reveal">
            <span class="sec-num">// 04</span>
            <h2 class="sec-title"><?php _e( 'What They Say', 'schmoll-creative' ); ?></h2>
            <div class="sec-rule"></div>
        </div>

        <div class="testi-grid">
        <?php if ( $testi_query->have_posts() ) :
            while ( $testi_query->have_posts() ) : $testi_query->the_post();
                $name    = get_post_meta( get_the_ID(), '_testi_name',    true );
                $role    = get_post_meta( get_the_ID(), '_testi_role',    true );
                $company = get_post_meta( get_the_ID(), '_testi_company', true );
                $avatar  = get_the_post_thumbnail_url( get_the_ID(), 'testimonial-avatar' );
        ?>
            <div class="testi-card reveal">
                <p class="testi-quote"><?php echo wp_kses_post( get_the_content() ); ?></p>
                <div class="testi-attr">
                    <?php if ( $avatar ) : ?>
                    <img class="testi-avatar"
                         src="<?php echo esc_url( $avatar ); ?>"
                         alt="<?php echo esc_attr( $name ); ?>"
                         width="44" height="44" loading="lazy">
                    <?php endif; ?>
                    <div>
                        <div class="testi-name"><?php echo esc_html( $name ); ?></div>
                        <div class="testi-role"><?php echo esc_html( $role . ( $company ? ' · ' . $company : '' ) ); ?></div>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata();
        else :
            // Fallback: hardcoded testimonials from schmollcreative.com
            $fallback = [
                [
                    'quote'   => '"I am so grateful we had Kevin on our creative team. Not only did Kevin exceed his role of Art Director, but he contributed strategically and creatively, worked cohesively with the entire team, and was always able to find a solution to even the most difficult client challenges."',
                    'name'    => 'Genna Shelnutt',
                    'role'    => 'Executive Creative Director · Buffalo Groupe',
                    'avatar'  => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/1587673613215-1.jpeg',
                ],
                [
                    'quote'   => '"Kevin loves collaborating, and does so with gusto, incurable curiosity and a winning attitude. Always fun to work with, Kevin works efficiently, making the days go by swiftly for everyone around him. You would be so lucky to have such a problem-solving designer on your team."',
                    'name'    => 'Rodney Hom',
                    'role'    => 'Lead UX Designer · IQVIA',
                    'avatar'  => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/1617649073214.jpeg',
                ],
                [
                    'quote'   => '"Kevin could be counted on to get the work done, and done well. Deadlines, changes and tight budgets didn\'t hamper his efforts. He has an infectious laugh and good demeanor — needed traits in a pressure-filled environment. Strong skills and work ethic."',
                    'name'    => 'Bruce D. Murdy',
                    'role'    => 'CEO · Rawle Murdy',
                    'avatar'  => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/Bruce.jpeg',
                ],
                [
                    'quote'   => '"Kevin was a wonderful coworker and a real team player. His work was always completed thoughtfully, accurately and timely. His attention to detail really made a difference in the projects we worked on together."',
                    'name'    => 'Allison Cross',
                    'role'    => 'Brand Media Manager · Google',
                    'avatar'  => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/allison.jpeg',
                ],
                [
                    'quote'   => '"Kevin is an incredibly talented and creative individual, capable of developing some of the most original and engaging advertising materials that I have seen in my 20+ years in the industry."',
                    'name'    => 'Ron Schulz',
                    'role'    => 'VP Supply Chain · Dave &amp; Buster\'s',
                    'avatar'  => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/ron.jpeg',
                ],
                [
                    'quote'   => '"I found Kevin to be highly creative and very easy-going and his work was always of the best quality. I am confident that Kevin would make a great addition to any creative team."',
                    'name'    => 'Chad Walldorf',
                    'role'    => 'Co-founder · Sticky Fingers Restaurant Group',
                    'avatar'  => 'https://www.schmollcreative.com/wp-content/uploads/2023/06/WalldorfChad.jpeg',
                ],
            ];
            foreach ( $fallback as $t ) : ?>
            <div class="testi-card reveal">
                <p class="testi-quote"><?php echo esc_html( $t['quote'] ); ?></p>
                <div class="testi-attr">
                    <img class="testi-avatar"
                         src="<?php echo esc_url( $t['avatar'] ); ?>"
                         alt="<?php echo esc_attr( $t['name'] ); ?>"
                         width="44" height="44" loading="lazy">
                    <div>
                        <div class="testi-name"><?php echo esc_html( $t['name'] ); ?></div>
                        <div class="testi-role"><?php echo wp_kses_post( $t['role'] ); ?></div>
                    </div>
                </div>
            </div>
            <?php endforeach;
        endif; ?>
        </div>
    </div>
</section>
