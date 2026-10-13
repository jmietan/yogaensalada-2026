# Yogensalada Color implementation

## 1. Mockup analysis
Reference: 1440 × 3520. Approximate boundaries: header 0–115; hero 115–895; practice 895–1540; latest 1540–2365; introduction 2365–2950; testimonial 2950–3280; footer 3280–3520. Measurements and colors are estimates from the reference, not original design tokens.

| Section | Blocks and layout | Spacing and typography | Responsive behavior |
| --- | --- | --- | --- |
| Header | GB Container; native Site Logo, Navigation, Search | 114px height; 16px bold navigation; wide shell | Native navigation overlay; search wraps on mobile |
| Hero | GB section; GB copy container and Text; native Image | 48/52 split; 775px desktop height; four-line serif H1; coral button | Stack below 768px; image 420px tall |
| Practice | GB section, shell, heading, five-column container, article containers | Pink; 58/72px padding; 30px grid gap; 19px sans titles | Three columns tablet, two mobile |
| Latest | GB section and heading; native Query, Post Template, featured image, terms, title, excerpt, Read More | Four articles; two-column outer grid; 48/52 image/text cards; 26px gap | One column mobile |
| Introduction | GB section, native Image, GB copy and values grid | 49/51 split; sage CTA; three values; gold edge | Stack mobile; three values stay side by side |
| Testimonial | GB section, card and Text | Pale sage; cream card; 710px maximum card width | Fluid card, smaller padding |
| Footer | GB containers; Site Logo and native Navigation | Thin divider; centered copyright | Stack on mobile |

Global palette: navy #123e60, sage #738e65, coral #e96f5b, gold #d99a3d, cream #fcf7ef, blush #fbe5e0, mist #e1e6d3, ink #244760. Exact font files were not supplied: Georgia and Arial are provisional substitutes. Heading sizes H1–H6 and spacing variables are in assets/scss/theme.scss; theme.json exposes the editor palette and font families. The desktop shell is 1310px to match the mockup's approximately 65px side margins rather than forcing 1200px.

## 2. Files and build
This is a separate block theme; the previous theme is preserved. style.css contains theme metadata, functions.php loads theme.css in the frontend and editor, theme.json defines editor settings, templates/ holds page layouts, parts/ holds header/footer, and patterns/ holds editable PHP block patterns. assets/scss/theme.scss is the source of all custom styles.

From this theme directory run `npm install` then `npm run build`; `npm run watch` rebuilds during development. In this checkout node_modules is linked to the existing theme's installed Sass dependency to avoid an unnecessary download. When distributing the theme, omit the symlink and node_modules; the compiled theme.css is included and needs no npm at runtime. The shipped package script generates theme.css as requested.

## 3. Architecture and compatibility
Inspected the installed GenerateBlocks 2.4.1 block.json files and save implementations. Modern Container/Grid is generateblocks/element, not an invented generateblocks/grid block. Text, heading and button variations use generateblocks/text. Patterns use the supported uniqueId, tagName, globalClasses and htmlAttributes attributes. Classes are serialized according to the installed save implementation (Text uses gb-text; Containers with empty styles have only supplied globalClasses).

Free plugin availability of a global style editing interface is not assumed. Theme-owned reusable CSS classes provide global styling; each is applied via the supported globalClasses attribute. Native blocks handle dynamic articles, image markup, search and accessible navigation. A GB Pro global-style workflow can replace class rules later if Pro is installed; it is not required.

PHP patterns in this folder are directly usable theme files. Their PHP asset URLs must be evaluated by WordPress; do not paste raw PHP into the block Code Editor. To reuse a section, open the editor inserter → Patterns → Yogensalada Color, then insert the named pattern. Customize an instance freely. For synchronized reuse, select its blocks and choose Create pattern with synchronization enabled. To obtain pasteable markup with actual URLs, insert a pattern in WordPress then copy it from the Code Editor.

## 4. WordPress setup
1. Restore the local WordPress database connection. CLI currently reports “Error establishing a database connection.”
2. Activate GenerateBlocks 2.4.1, then activate Yogensalada Color under Appearance → Themes. No database settings were changed by this implementation.
3. Set the real site logo in the Site Editor. The bundled logo is available under assets/images/logo.png, but import it into Media Library so Site Logo has an attachment ID.
4. Set a static homepage in Settings → Reading; the theme's front-page template supplies its sections. Edit homepage sections through Appearance → Editor → Templates → Front Page. The page body itself is intentionally not duplicated into this template.
5. Configure Home, About, Yoga, Food, Blog and Contact navigation links to actual local permalinks. Current links assume a root installation; update for a subdirectory installation. Set the Blog page as the posts page. Configure the footer menu independently if desired.
6. Publish article posts with categories, featured images and excerpts. Latest always queries the newest four published posts, so exact titles/order in the reference depend on content. Do not backdate real content just for appearance.
7. Replace temporary images through the editor using Media Library attachments. This enables WordPress responsive srcset/sizes. Existing bundled practice images are illustrations, not the mockup video thumbnails. The hero uses an existing outdoor photograph; the introduction reuses it provisionally. Headstand and Warrior imagery must be replaced with accurate images before launch.
8. Add real video links or native Video blocks for the five practices. No fake play buttons, invented video URLs or carousel controls are included. Practice cards form a responsive grid.
9. Replace the testimonial placeholder with approved content and portrait. No fabricated testimonial is included. The testimonial band is static pending real slides; add functional controls only once multiple approved entries exist.
10. Add native Social Icons with real profile URLs. The reference's botanical illustrations, handwriting over the hero, original fonts, sunset photo and portrait were not provided as individual assets. These remain visual differences; the theme does not pretend to be a pixel-exact reproduction.
11. If saved database templates override theme files, inspect and back up those edits before clearing customizations in the Site Editor. Theme activation alone does not necessarily remove template overrides.

No newsletter section exists in the provided design, so none is added. Header, hero, practice, latest, introduction, testimonial and footer patterns cover the actual mockup. The CTA is a reusable GB Text button variation embedded in the hero and introduction patterns.

## 5. Performance, accessibility and SEO
No custom JavaScript or third-party fonts. Native navigation handles the mobile overlay. All content exists server-side for accessibility and indexing. Below-fold images use native loading=lazy; the hero uses fetchpriority=high. Entire sections are not fetched on scroll because that would delay accessible content and introduce layout shifts. Native lazy images satisfy the performance intent without hiding content.

Use imported attachment images for responsive sources and appropriately sized WebP/AVIF renditions; bundled fallback images currently have no srcset. Image dimensions are intrinsic and object-fit handles visual crops. Dark CTA labels are a deliberate readability adjustment from white labels in the reference. One H1 in the homepage, H2 section titles and H3 card titles. Keep visible keyboard focus, descriptive link text and meaningful image alternative text. The theme relies on WordPress's native skip-link behavior; verify it after activation. Set site title/tagline, permalinks, article excerpts and real content. SEO metadata should come from WordPress or the site's established SEO solution, not duplicated theme tags.

## 6. Verification and launch checklist
Completed: Sass compilation; PHP syntax checks; JSON parsing; server-side block delimiter parsing and supported GB attribute-name checks. These do not prove client-side block validation or visual fidelity.

Requires working WordPress database and browser:
- Open each pattern in editor; verify no “unexpected or invalid content” recovery prompts; save and reopen.
- Compare at 1440, 768 and 375 CSS px; inspect hero wrapping, image crops, article card heights and footer alignment.
- Confirm document scroll width equals viewport; test long titles, empty categories, absent images and zero posts.
- Navigate entirely by keyboard, including skip link, menu overlay, Escape, search, post links and CTA focus.
- Check contrast, 200% text zoom, reduced motion, mobile touch targets and screen-reader landmarks.
- Verify all navigation, search, article links and final video/social links.
- Confirm logo, approved testimony, correct practice assets, real story content and original design assets before publication.
- Test actual image responsive sources, lazy loading, CLS and LCP in browser performance tools.
- Verify both logged-in editor and logged-out frontend.

Do not mix old GenerateBlocks Container/Grid v1 attributes with v2 Element attributes. Do not add className to GB blocks that disable that support; use globalClasses. Do not assume Pro-only features or edit generated theme.css directly. No live editor, frontend, responsive, accessibility audit or Core Web Vitals results are claimed while the database is unavailable.

## Header and botanical refinement — October 10, 2026
The activated frontend was inspected at http://yogaensalada-2026.local:8080/. HTTP works even though sandboxed WP-CLI reports a database error. Added a fallback vector logo when Site Logo is unset; a configured custom logo takes precedence. Added an approximate botanical SVG reused as decorative CSS backgrounds, refined desktop brand/navigation/search alignment, native Home aria-current underline, thinner serif hero type, and mobile wrapping. No database content was changed.

Browser checks after this refinement: 1440, 768 and 375px layouts inspected; final document width did not exceed the viewport at those widths. Header mobile menu opened as a dialog and closed successfully. Sass compilation and PHP syntax passed. These are focused layout checks, not a full accessibility audit. The illustrations and fallback logo are approximate vectors, and original photographs remain provisional.

## Yoga, Food and Contact pages — October 10, 2026
Created editable Page posts: Yoga 319, Food 320, Contact 321. Edit them under Pages → Edit, rather than the front-page template. Their layouts are also reusable patterns named Yoga/Food/Contact · complete editable page. Slug-specific templates wrap Post Content with the shared header and footer.

- Yoga uses native Query Loop 31: yoga category, eight posts per page, pagination.
- Food uses native Query Loop 32: food category, four posts per page, pagination and a recipe CTA.
- Filters are server-rendered `[yc_filters collection="yoga"]` and `[yc_filters collection="food"]` shortcodes. They use `?topic=...` and narrow the native query with post tags. Assign beginner, relaxation, flexibility, intermediate or all-levels to yoga posts; breakfast, lunch, dinner, snacks, drinks or plant-based to food posts. Existing relaxing, pancake, healthy-drink, green-matcha, vegan and vegetarian-related tags are also recognized where appropriate. Empty filters show a clear empty state. No original post taxonomy was modified.
- `[yc_contact_form]` renders required name/email/subject/message fields, nonce, honeypot, server validation and a per-IP one-minute throttle. Submission goes through admin-post.php and wp_mail to Settings → General → Administration Email Address. Form labels and rendering are maintained in inc/pages.php; the surrounding layout remains block-editable.
- Menu destinations now resolve to actual page permalinks, including the existing About Us page. This installation currently includes /index.php/ in page URLs.

Verified in browser: all three pages rendered; Yoga pagination page 2 showed three remaining posts; Food Drinks filter showed one matching post; mobile content widths stayed within 375px. Inspected Yoga/Food heroes and Contact form on desktop. Contact handler rejected invalid email and accepted valid input with outgoing mail intercepted. No real email was sent; inbox delivery is unverified. PHP syntax, pattern delimiter/GB attribute-name checks and Sass compilation passed. Full client-side editor save/reopen validation remains to be performed.

Visual limitations: existing site photography is used provisionally for hero/CTA/banner images because the original mockup photos were not supplied individually. Contact's public email address, signature graphic and social-profile links are not invented; replace/add those approved assets and destinations in the editor. The form sends to the configured WordPress admin email, which may differ from the address pictured in the mockup.

## About Us — October 10, 2026
Updated existing About Us Page 78 (previous content was empty) after requesting a WordPress revision. The page uses editable GB blocks with a slug-specific page-about-us template and reusable page-about-us pattern. Sections follow the supplied reference: introductory hero; My Journey story; 2011/2014/2018/Today timeline; Contact Me invitation; personal quote; shared footer. Copy and dates were transcribed from the user-provided mockup. Verify that the training date and credentials are accurate before public launch.

My Story anchors to the story section; Contact Me resolves to the actual Contact page permalink. Original portrait, meditation/Bali photographs and scenic banner were not provided individually, so existing outdoor imagery and a silhouette portrait are provisional. The contact banner uses the mockup colors and botanical edges without inventing a replacement photograph. Personal quote arrows remain disabled with one quote. Native social links still require real approved profile destinations.

Checks: Sass build and PHP pattern syntax passed. Browser confirmed About navigation underline, the four milestones, correct CTA destination, desktop rendering and a 375px mobile layout without horizontal overflow. Client-side editor save/reopen validation remains unverified.
