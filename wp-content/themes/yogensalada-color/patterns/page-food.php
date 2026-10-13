<?php
/**
 * Title: Food · complete editable page
 * Slug: yogensalada-color/page-food
 * Categories: yogensalada-color
 * Inserter: yes
 */
?>
<!-- wp:generateblocks/element {"uniqueId":"967d0adf","tagName":"section","globalClasses":["yc-inner-hero","yc-inner-food"]} -->
<section class="yc-inner-hero yc-inner-food"><!-- wp:generateblocks/element {"uniqueId":"a9b2bb2f","tagName":"div","globalClasses":["yc-inner-copy"]} -->
<div class="yc-inner-copy"><!-- wp:generateblocks/text {"uniqueId":"f9b3db29","tagName":"p","globalClasses":["yc-eyebrow"]} -->
<p class="gb-text yc-eyebrow">HEALTHY RECIPES</p>
<!-- /wp:generateblocks/text -->
<!-- wp:generateblocks/text {"uniqueId":"60f79d7d","tagName":"h1","globalClasses":["yc-inner-title"]} -->
<h1 class="gb-text yc-inner-title"><span>Nourish</span><span>Your</span><span>Body</span></h1>
<!-- /wp:generateblocks/text -->
<!-- wp:generateblocks/text {"uniqueId":"a230d858","tagName":"p"} -->
<p class="gb-text ">Delicious, wholesome recipes to fuel<br>your body and support your well-being.<br>Simple ingredients, big benefits.</p>
<!-- /wp:generateblocks/text -->
</div>
<!-- /wp:generateblocks/element -->
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/food.jpg' ) ); ?>" alt="Plant-based tofu and mushroom siomai" loading="lazy" decoding="async" width="768" height="762"/></figure>
<!-- /wp:image -->
</section>
<!-- /wp:generateblocks/element -->
<!-- wp:generateblocks/element {"uniqueId":"e690f453","tagName":"section","globalClasses":["yc-listing","yc-shell"]} -->
<section class="yc-listing yc-shell"><!-- wp:shortcode -->[yc_filters collection="food"]<!-- /wp:shortcode --><!-- wp:query {"queryId": 32, "query": {"perPage": 4, "pages": 0, "offset": 0, "postType": "post", "order": "desc", "orderBy": "date", "inherit": false, "taxQuery": {"category": [39]}}, "className": "yc-collection yc-collection-food"} --><div class="wp-block-query yc-collection yc-collection-food"><!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} --><!-- wp:generateblocks/element {"uniqueId":"8df6590e","tagName":"article","globalClasses":["yc-collection-card"]} -->
<article class="yc-collection-card"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1.65","sizeSlug":"medium_large"} /--><!-- wp:generateblocks/element {"uniqueId":"326de08f","tagName":"div","globalClasses":["yc-collection-copy"]} -->
<div class="yc-collection-copy"><!-- wp:post-terms {"term":"category"} /--><!-- wp:post-title {"isLink":true,"level":2} /--><!-- wp:post-excerpt {"moreText":"","excerptLength":20} /--><!-- wp:read-more {"content":"Read More →"} /--></div>
<!-- /wp:generateblocks/element -->
</article>
<!-- /wp:generateblocks/element -->
<!-- /wp:post-template --><!-- wp:query-no-results --><!-- wp:paragraph --><p>No articles match this filter yet. Choose All to explore more.</p><!-- /wp:paragraph --><!-- /wp:query-no-results --><!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} --><!-- wp:query-pagination-previous {"label":"←"} /--><!-- wp:query-pagination-numbers /--><!-- wp:query-pagination-next {"label":"→"} /--><!-- /wp:query-pagination --></div><!-- /wp:query --></section>
<!-- /wp:generateblocks/element -->
<!-- wp:generateblocks/element {"uniqueId":"e53dbb2f","tagName":"section","globalClasses":["yc-food-cta"]} -->
<section class="yc-food-cta"><!-- wp:generateblocks/element {"uniqueId":"9abd56e9","tagName":"div","globalClasses":["yc-food-cta-copy"]} -->
<div class="yc-food-cta-copy"><!-- wp:generateblocks/text {"uniqueId":"592ff4c5","tagName":"h2"} -->
<h2 class="gb-text ">Good Food<br><span>Happier You</span></h2>
<!-- /wp:generateblocks/text -->
<!-- wp:generateblocks/text {"uniqueId":"330041b7","tagName":"p"} -->
<p class="gb-text ">Wholesome meals, simple ingredients,<br>a healthier, happier life.</p>
<!-- /wp:generateblocks/text -->
<!-- wp:generateblocks/text {"uniqueId":"36c7c4a7","tagName":"a","globalClasses":["yc-button","yc-green"],"htmlAttributes":{"href":"#recipes"}} -->
<a class="gb-text yc-button yc-green" href="#recipes">View All Recipes <span aria-hidden="true">→</span></a>
<!-- /wp:generateblocks/text -->
</div>
<!-- /wp:generateblocks/element -->
<!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
<figure class="wp-block-image size-large"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/food.jpg' ) ); ?>" alt="Plant-based siomai" loading="lazy" decoding="async" width="768" height="762"/></figure>
<!-- /wp:image -->
</section>
<!-- /wp:generateblocks/element -->
