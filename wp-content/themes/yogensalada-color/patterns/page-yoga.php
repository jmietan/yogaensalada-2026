<?php
/**
 * Title: Yoga · complete editable page
 * Slug: yogensalada-color/page-yoga
 * Categories: yogensalada-color
 * Inserter: yes
 */
?>
<!-- wp:generateblocks/element {"uniqueId":"c8602953","tagName":"section","globalClasses":["yc-inner-hero","yc-inner-yoga"]} -->
<section class="yc-inner-hero yc-inner-yoga"><!-- wp:generateblocks/element {"uniqueId":"3c0e2d47","tagName":"div","globalClasses":["yc-inner-copy"]} -->
<div class="yc-inner-copy"><!-- wp:generateblocks/text {"uniqueId":"5307c150","tagName":"p","globalClasses":["yc-eyebrow"]} -->
<p class="gb-text yc-eyebrow">YOGA PRACTICES</p>
<!-- /wp:generateblocks/text -->
<!-- wp:generateblocks/text {"uniqueId":"c984b73f","tagName":"h1","globalClasses":["yc-inner-title"]} -->
<h1 class="gb-text yc-inner-title"><span>Move</span><span>with</span><span>Intention</span></h1>
<!-- /wp:generateblocks/text -->
<!-- wp:generateblocks/text {"uniqueId":"1e6332bf","tagName":"p"} -->
<p class="gb-text ">Explore yoga practices for every level —<br>from mindful beginnings to energizing flows.<br>Move, breathe, and feel good.</p>
<!-- /wp:generateblocks/text -->
</div>
<!-- /wp:generateblocks/element -->
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/hero.png' ) ); ?>" alt="Yoga practice outdoors" loading="lazy" decoding="async" width="1024" height="638"/></figure>
<!-- /wp:image -->
</section>
<!-- /wp:generateblocks/element -->
<!-- wp:generateblocks/element {"uniqueId":"5dde5b84","tagName":"section","globalClasses":["yc-listing","yc-shell"]} -->
<section class="yc-listing yc-shell"><!-- wp:shortcode -->[yc_filters collection="yoga"]<!-- /wp:shortcode --><!-- wp:query {"queryId": 31, "query": {"perPage": 8, "pages": 0, "offset": 0, "postType": "post", "order": "desc", "orderBy": "date", "inherit": false, "taxQuery": {"category": [8]}}, "className": "yc-collection yc-collection-yoga"} --><div class="wp-block-query yc-collection yc-collection-yoga"><!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} --><!-- wp:generateblocks/element {"uniqueId":"8df6590e","tagName":"article","globalClasses":["yc-collection-card"]} -->
<article class="yc-collection-card"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1.65","sizeSlug":"medium_large"} /--><!-- wp:generateblocks/element {"uniqueId":"326de08f","tagName":"div","globalClasses":["yc-collection-copy"]} -->
<div class="yc-collection-copy"><!-- wp:post-terms {"term":"category"} /--><!-- wp:post-title {"isLink":true,"level":2} /--><!-- wp:post-excerpt {"moreText":"","excerptLength":20} /--><!-- wp:read-more {"content":"Read More →"} /--></div>
<!-- /wp:generateblocks/element -->
</article>
<!-- /wp:generateblocks/element -->
<!-- /wp:post-template --><!-- wp:query-no-results --><!-- wp:paragraph --><p>No articles match this filter yet. Choose All to explore more.</p><!-- /wp:paragraph --><!-- /wp:query-no-results --><!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} --><!-- wp:query-pagination-previous {"label":"←"} /--><!-- wp:query-pagination-numbers /--><!-- wp:query-pagination-next {"label":"→"} /--><!-- /wp:query-pagination --></div><!-- /wp:query --></section>
<!-- /wp:generateblocks/element -->
