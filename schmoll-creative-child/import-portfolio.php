<?php
/**
 * Portfolio import data — scraped from schmollcreative.com
 * Triggered via Appearance > Portfolio Import in WP admin.
 *
 * Safe to run multiple times: skips posts whose titles already exist.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function schmoll_run_portfolio_import() {
    $projects = [

        [
            'title'   => 'GreenOx Renew Rebranding',
            'client'  => 'GreenFlow USA',
            'role'    => 'Graphic Designer & Art Director',
            'year'    => '2022',
            'featured'=> '1',
            'content' => '<p>GreenOx Renew is an eco-friendly wood cleaner using a hydrogen peroxide formula to remove mold, mildew, algae, and organic stains from decks, fences, docks, and other surfaces without aggressive scrubbing. The project involved a complete brand refresh addressing outdated packaging that failed to communicate the product\'s modern, premium, sustainable positioning across three product lines.</p>

<h2>The Challenge</h2>
<p>The original branding felt generic and didn\'t reflect the effortless performance or innovation story. The redesign needed to unify three product variants while emphasizing non-toxic, biodegradable, EPA Safer Choice qualification, and U.S. manufacturing.</p>

<h2>Design Solution</h2>
<ul>
<li>Geometric, faceted bull illustration symbolizing strength and forward momentum with glowing green eyes</li>
<li>Heavy, wide sans-serif wordmark with gradient sphere treatment on the \'O\'</li>
<li>Forest green paired with lime gradient for cohesive, nature-associated branding</li>
<li>Logo scaled effectively across all applications from business cards to billboards</li>
</ul>

<h2>Deliverables</h2>
<ul>
<li>Primary logo variations (horizontal, stacked, monochrome)</li>
<li>Full packaging redesign for three product lines</li>
<li>Brand style guide</li>
<li>Marketing collateral and digital assets</li>
</ul>

<h2>Result</h2>
<p>Transformed GreenOx from functional cleaner to standout eco-premium brand with improved shelf appeal across Amazon, specialty power-washing suppliers, and direct channels.</p>',
        ],

        [
            'title'   => 'Robin Clip',
            'client'  => 'Robin Clip',
            'role'    => 'Graphic Designer & Art Director',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Robin Clip is a silicone-and-steel clip case enabling discreet, wrist-free Apple Watch wear by attaching inside clothing. The brand targets athletes in sports prohibiting wrist devices, medical users requiring continuous monitoring, and consumers preferring concealed smartwatch wear.</p>

<h2>Scope</h2>
<p>Kevin Schmoll led comprehensive brand development from inception — custom illustrations, motion graphics, app UI design, product packaging, and branded merchandise. The challenge involved establishing credibility in the design-conscious Apple accessory market while clearly communicating a novel product concept through visual storytelling.</p>

<h2>Deliverables</h2>
<ul>
<li>Brand identity and logo system</li>
<li>Custom illustrations</li>
<li>App UI design</li>
<li>Product packaging</li>
<li>Branded merchandise</li>
<li>Kickstarter launch assets</li>
<li>Visual system documentation</li>
</ul>

<h2>Highlights</h2>
<ul>
<li>Featured on Core77, a design publication with 240,000+ designer audience</li>
<li>Kickstarter launch to global early adopters</li>
<li>Compatible with Apple Watch Series 4–11, SE, and Ultra</li>
</ul>',
        ],

        [
            'title'   => 'Certified Evil Genius Audio Productions',
            'client'  => 'Certified Evil Genius Audio Productions',
            'role'    => 'Graphic Designer & Art Director',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Complete brand identity for a high-end recording studio in Charleston, SC. The challenge centered on translating a provocative studio name into authentic, premium visual branding that felt credible yet personality-driven.</p>

<h2>Creative Approach</h2>
<ul>
<li>Badge-style design aesthetic combining legitimacy with irreverence</li>
<li>Strong, authoritative typography that framed rather than competed with the name</li>
<li>Timeless visual language avoiding generic music industry clichés</li>
<li>Versatile extensions designed for cultural credibility and real-world use</li>
</ul>

<h2>Deliverables</h2>
<ul>
<li>Primary logo lockup</li>
<li>Sticker variations</li>
<li>Apparel designs</li>
</ul>

<p>A logo is one thing — but when you start putting it on a t-shirt or a sticker, you\'re asking it to perform in a completely different context. The goal was merchandise people would genuinely want to wear.</p>',
        ],

        [
            'title'   => 'Viscid Surf',
            'client'  => 'Viscid Surf Co.',
            'role'    => 'Graphic Designer & Creative Director',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>A comprehensive brand-building project for an organic surf wax company based in Charleston, South Carolina. Viscid Surf Co. hand-pours organic wax using locally sourced beeswax from Johns Island — non-toxic, biodegradable, and free of petroleum-based chemicals.</p>

<h2>Scope</h2>
<p>Complete creative ownership from concept to commercial launch: brand strategy, product line naming, brand voice development, logo design, e-commerce website design and build, packaging design across four product lines, and a full suite of apparel and promotional materials.</p>

<h2>Deliverables</h2>
<ul>
<li>Brand identity and logo system</li>
<li>Packaging across four wax product lines</li>
<li>E-commerce website (mobile-first responsive)</li>
<li>Apparel and merchandise line</li>
<li>Vehicle wrap</li>
<li>Promotional materials</li>
</ul>

<p><em>Apply. Surf. Repeat.</em></p>',
        ],

        [
            'title'   => 'Your Crawlspace',
            'client'  => 'Your Crawlspace',
            'role'    => 'Graphic Designer & Creative Director',
            'year'    => '2020',
            'featured'=> '1',
            'content' => '<p>Your Crawlspace (YCS) is a crawlspace encapsulation manufacturing company based in Charleston, SC. Kevin Schmoll led a comprehensive design initiative for their product launch — spanning UX/UI, brand development, and marketing materials.</p>

<h2>Scope</h2>
<ul>
<li><strong>Mobile App Design:</strong> Full UX architecture with wireframes and page flows designed for contractors working in field conditions</li>
<li><strong>Custom Icon Library:</strong> Complete icon system balancing clarity, consistency, and professional aesthetics</li>
<li><strong>Video Production:</strong> Animated instructional videos breaking down technical installation processes into step-by-step sequences</li>
<li><strong>Marketing Materials:</strong> Rack cards, product flyers, and packaging labels for trade shows and distributors</li>
<li><strong>Brand System:</strong> Visual consistency across all digital and print touchpoints</li>
</ul>

<h2>Results</h2>
<ul>
<li>$3.6 million investment secured and 40 new jobs created</li>
<li>YCS became the leading crawlspace encapsulation system in the industry</li>
<li>Patented Wall Attachment System established new industry standard</li>
</ul>',
        ],

        [
            'title'   => 'Sticky Fingers Ribhouse',
            'client'  => 'Sticky Fingers Restaurant Group',
            'role'    => 'Graphic Designer & Art Director',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>A comprehensive brand revitalization for a Charleston-based barbecue restaurant chain founded in 1992. The project addressed years of brand drift following ownership changes by excavating the brand\'s authentic Southern roots and rebuilding its identity across digital and physical touchpoints.</p>

<h2>Scope</h2>
<ul>
<li>Brand strategy and positioning development</li>
<li>Menu redesign (dining and bar menus)</li>
<li>Food photography art direction</li>
<li>Fully responsive website design with mobile optimization</li>
<li>E-commerce platform (sauce sales, merchandise, apparel)</li>
<li>Online to-go ordering system</li>
<li>Apparel and t-shirt design</li>
<li>Email campaigns and business collateral</li>
<li>SEO implementation</li>
</ul>

<blockquote><p>"Not every brand can work #Cuegasm into a social media post, but I\'m sure glad I got to work with one that can."</p></blockquote>

<blockquote><p>"Highly creative and very easy-going — work always of the best quality." — Chad Walldorf, Co-founder</p></blockquote>',
        ],

        [
            'title'   => 'Great Wolf Lodge',
            'client'  => 'Great Wolf Lodge',
            'role'    => 'Graphic Design',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>A series of kitchen training posters for Great Wolf Lodge staff. The work featured custom illustrations depicting various equipment types and procedures, employing vibrant colors and bold graphics to align with the brand identity while remaining educational.</p>

<h2>Objective</h2>
<p>Deliver training materials that help staffers learn efficiently while staying engaged throughout the process — materials that are simultaneously visually engaging and easy to comprehend.</p>

<h2>Deliverables</h2>
<ul>
<li>Six custom kitchen training posters with original illustrations</li>
</ul>',
        ],

        [
            'title'   => 'Midnight Moon',
            'client'  => 'PDI',
            'role'    => 'Digital & Social Media Design',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Social media campaign design for Midnight Moon\'s full product flavor line. The work centered on a vibrant color scheme and dynamic design elements, with an interactive screenshot lottery mechanic encouraging users to identify their preferred flavor — driving engagement and purchase intent.</p>

<h2>Deliverables</h2>
<ul>
<li>8 social media reel artboards</li>
<li>Interactive screenshot lottery format</li>
<li>Product-focused focal point layout across all flavors</li>
</ul>',
        ],

        [
            'title'   => 'Roxbury Mercantile',
            'client'  => 'Roxbury Mercantile',
            'role'    => 'Brand Development & Logo Design',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Brand revitalization for a historic family business on Edisto Island operating since 1926. The original country store burned down decades ago; a local shrimp boat captain opened a restaurant on the same site. The rebranded Roxbury Mercantile now emphasizes fresh, local Lowcountry cuisine in a welcoming atmosphere.</p>

<h2>Brand Positioning</h2>
<p><em>Affordable. Fresh. Family Owned. Where history meets hospitality.</em></p>

<h2>Deliverables</h2>
<ul>
<li>Primary and secondary logo designs</li>
<li>Brand style guide</li>
<li>Menu design</li>
<li>Apparel</li>
<li>Promotional materials</li>
</ul>',
        ],

        [
            'title'   => 'Sweetgrass Event Center',
            'client'  => 'Sweetgrass Event Center',
            'role'    => 'Brand Development & Logo Design',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Brand built from inception for a luxury yet approachable event venue in Charleston, SC. Located between Sullivan\'s Island and historic downtown Charleston, Sweetgrass offers three distinct event spaces ranging from intimate ceremonies to 200-person corporate events.</p>

<h2>Brand Positioning</h2>
<p><em>Sweetgrass Event Center offers unique, affordable, and flexible event space to create unforgettable moments in one of the most desired cities in the world.</em></p>

<h2>Tagline</h2>
<p>Rise to any occasion.</p>

<h2>Deliverables</h2>
<ul>
<li>Logo design and brand identity</li>
<li>Print and promotional materials</li>
</ul>',
        ],

        [
            'title'   => 'Top Shelf Catering',
            'client'  => 'Top Shelf Catering Co.',
            'role'    => 'Brand Development · UX/UI · E-Commerce',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Comprehensive brand positioning and visual identity for a startup catering company specializing in weddings, corporate events, anniversaries, and celebrations. The brand emphasizes professional service, genuine southern hospitality, and outstanding Lowcountry cuisine.</p>

<h2>Brand Positioning</h2>
<p><em>Professional. Affordable. Delicious.</em></p>

<h2>Deliverables</h2>
<ul>
<li>Logo design and brand identity system</li>
<li>Website UX/UI and e-commerce platform</li>
<li>Menu design</li>
<li>Branded collateral and promotional materials</li>
<li>Package design</li>
</ul>

<p>The client noted their business has been doing very well following the rebrand and website launch.</p>',
        ],

        [
            'title'   => 'Netflix — Promotional Banners',
            'client'  => 'Media Bridge Marketing',
            'role'    => 'Graphic Design',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Promotional banner advertisements for Netflix, Amazon Prime, and Hulu created in collaboration with Media Bridge Marketing. Campaign work covered two properties: <em>The Watcher</em> series and the <em>Call Jane</em> film.</p>

<h2>Scope</h2>
<p>Worked closely with the marketing team to ensure ads aligned with platform brand standards and promoted consistency across all promotional materials.</p>

<h2>Deliverables</h2>
<ul>
<li>Promotional banner — <em>Call Jane</em></li>
<li>Promotional banner — <em>The Watcher</em></li>
</ul>',
        ],

        [
            'title'   => 'Discover Jackson County',
            'client'  => 'Jackson County',
            'role'    => 'Graphic Design & Digital Marketing',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Comprehensive tourism campaign promoting Jackson County as a travel destination. The initiative leveraged local imagery and landscape across multiple channels — billboards and newspaper ads featuring bright colors and strong lines to create an adventurous feeling.</p>

<h2>Scope</h2>
<ul>
<li>Print advertising (billboards, newspapers)</li>
<li>Digital ads with interactive elements</li>
<li>Dedicated microsite with vibrant visuals</li>
<li>Interactive map highlighting attractions, events, festivals, food, and beverage options</li>
</ul>

<h2>Goal</h2>
<p>Represent the beauty, adventure, and culture of Jackson County and establish it as an appealing destination for visitors.</p>',
        ],

        [
            'title'   => 'US78 Corridor Improvements',
            'client'  => 'County Public Works',
            'role'    => 'Branding & Identity Design',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Identity system developed to promote a corridor improvement project and generate public awareness of roadway improvements. The county needed recognizable branding to showcase safer, more efficient roadways applied consistently across all communications.</p>

<h2>Deliverables</h2>
<ul>
<li>Logo design</li>
<li>Signage system</li>
<li>Brochures and flyers</li>
<li>Promotional materials</li>
</ul>',
        ],

        [
            'title'   => 'Global Value Commerce',
            'client'  => 'Global Value Commerce, Inc.',
            'role'    => 'Digital Design & Advertising',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Social media advertising campaign targeting golf enthusiasts across all skill levels. The strategy emphasized a fun and personalized approach while highlighting essential sport aspects — pairing professional golfers demonstrating the latest products with instructional tips and engagement-driving conversation starters.</p>

<h2>Deliverables</h2>
<ul>
<li>Mizuno OMOI Putter Pro Tip post</li>
<li>Nike Apparel Overview Pro Tip post</li>
<li>Titleist SM9 Wedge Pro Tip post</li>
<li>Cobra Pre-owned Guide post</li>
</ul>

<p>All posts formatted as 1080×1080 Instagram-style ads combining product showcase, professional instruction, and engagement prompts.</p>',
        ],

        [
            'title'   => 'Ortholite',
            'client'  => 'Ortholite',
            'role'    => 'Digital & Social Media Advertising',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Digital and social media advertising campaign promoting Ortholite\'s performance insole technology. The campaign focused on consumer education, highlighting key product benefits — moisture wicking, air circulation, shock absorption, and odor control — with technical graphics to differentiate Ortholite in a competitive market.</p>

<h2>Campaign Strategy</h2>
<ul>
<li>Technical graphics showcasing performance features</li>
<li>Educational messaging about product technology</li>
<li>Competitive differentiation through clear benefit communication</li>
</ul>',
        ],

        [
            'title'   => 'Twilio + Authy',
            'client'  => 'Twilio',
            'role'    => 'UI/UX Design',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Responsive mobile UI design for Twilio\'s Owl demo brand, showcasing two-factor authentication flows powered by Authy. Twilio is a cloud communication platform trusted by Airbnb, Uber, and Facebook Messenger.</p>

<h2>Scope</h2>
<p>Multiple responsive mobile design options developed for the Owl demo brand — focusing on contemporary, adaptable interface design that clearly communicates security and simplicity for the Authy two-factor authentication product.</p>

<h2>Deliverables</h2>
<ul>
<li>Owl Bank mobile UI</li>
<li>Owl Health mobile UI (two design variants)</li>
</ul>',
        ],

        [
            'title'   => 'ATRA',
            'client'  => 'ATRA',
            'role'    => 'Graphic Design',
            'year'    => '2025',
            'featured'=> '1',
            'content' => '<p>Brand identity and merchandise design for ATRA, including logo design, apparel, and brand materials.</p>

<h2>Deliverables</h2>
<ul>
<li>Logo design</li>
<li>T-shirt design</li>
<li>Hat design</li>
<li>Brand materials</li>
</ul>',
        ],

        [
            'title'   => 'Star Taco',
            'client'  => 'Star Taco',
            'role'    => 'Brand Positioning & Logo Design',
            'year'    => '2023',
            'featured'=> '1',
            'content' => '<p>Star Taco is a restaurant getaway to enjoy simple Baja flavors in a laid-back, care-free atmosphere — fresh seafood plates and tacos prepared daily, paired with impeccable service and vibrant ambiance.</p>

<h2>Brand Positioning</h2>
<p><em>Fresh, not fancy.</em></p>
<p>Like a day at the beach, Star Taco is a much-needed break from the daily grind. An impromptu getaway in a meal.</p>

<h2>Deliverables</h2>
<ul>
<li>Logo design</li>
<li>Stickers</li>
<li>T-shirt designs (two versions)</li>
<li>Menu design</li>
<li>Brand guidelines</li>
</ul>',
        ],

    ];

    $results = [];

    foreach ( $projects as $project ) {
        $existing = get_page_by_title( $project['title'], OBJECT, 'portfolio' );
        if ( $existing ) {
            $results[] = 'Skipped (already exists): ' . $project['title'];
            continue;
        }

        $post_id = wp_insert_post( [
            'post_title'   => $project['title'],
            'post_content' => $project['content'],
            'post_status'  => 'publish',
            'post_type'    => 'portfolio',
        ] );

        if ( is_wp_error( $post_id ) ) {
            $results[] = 'Error: ' . $project['title'] . ' — ' . $post_id->get_error_message();
            continue;
        }

        update_post_meta( $post_id, '_schmoll_client',   $project['client'] );
        update_post_meta( $post_id, '_schmoll_year',     $project['year'] );
        update_post_meta( $post_id, '_schmoll_role',     $project['role'] );
        update_post_meta( $post_id, '_schmoll_featured', $project['featured'] );

        $results[] = 'Created: ' . $project['title'];
    }

    return $results;
}
