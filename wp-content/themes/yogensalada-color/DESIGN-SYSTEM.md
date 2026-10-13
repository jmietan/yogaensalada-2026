# Global design system

## Where to edit

| File | Purpose |
| --- | --- |
| `theme.json` | WordPress and Gutenberg font/color/size/spacing presets, standard heading sizes, native button defaults and layout widths |
| `assets/scss/_global.scss` | CSS custom properties and shared typography, links, buttons, images, spacing and responsive foundations |
| `assets/scss/_components.scss` | Approved layouts, decorative artwork, carousel/reveal interactions and presentation typography exceptions |
| `assets/scss/theme.scss` | Two-line Sass module entry point |
| `theme.css` | Generated frontend/editor CSS; do not edit directly |
| `inc/design-system.php` | Native block-style choices and GenerateBlocks 2.4.1 defaults for newly inserted Button variations |
| `assets/fonts/` | Locally hosted fonts and open-source licenses |

Run `npm run build` in the theme directory after editing Sass. `npm run watch` recompiles on save. JSON/PHP changes do not need Sass compilation. Clear browser caches after changing editor settings.

## Typography

Standard headings use Playfair Display, Georgia, serif; body/navigation/buttons use Inter, Arial, sans-serif. Standard desktop type: H1 48/700/1.2; H2 36/600/1.25; H3 28/600/1.3; H4 24/600/1.35; H5 20/600/1.4; H6 18/600/1.4. Paragraphs are 16/400/1.7 and small text is 14/400. Heading presets scale down on mobile. Existing oversized hero and section titles and compact cards retain deliberate presentation sizing from the approved mockups. Explicit saved block styles take precedence over inherited defaults.

Local font faces are declared once in theme.json so WordPress loads them in the frontend and editor. `font-display: swap` preserves readable fallback text during loading. Inter weights 400/500/600/700 cover existing body, quote, navigation and button usage. Playfair Display 400/600/700 cover regular display heroes and standard headings. No italic font is requested or downloaded. Font files are bundled TrueType files, with separate OFL license files; browsers request faces as used. No visitor requests to Google Fonts are needed. WOFF2 compression remains an optional future optimization, not a claimed completed change.

## Colors and variables

The existing navy/sage/coral/gold/cream/blush/mist/ink palette is unchanged. CSS aliases such as `--yc-navy` reference WordPress presets so Global Styles changes propagate to components. Accessible dark text on coral buttons and a darker sage secondary button provide readable controls. Body links are underlined, with a coral-dark hover and visible keyboard focus. Existing navigation/card-title links have contextual styles.

Primary tokens in `_global.scss`:

- Fonts: `--yc-font-heading`, `--yc-font-body`; sizes `--yc-font-h1` through `--yc-font-h6`, `--yc-font-body-size`, `--yc-font-small`; weights and `--yc-line-*`.
- Color roles: `--yc-color-heading`, `--yc-color-text`, `--yc-color-background`, `--yc-color-link`, `--yc-color-link-hover`, `--yc-color-border`, `--yc-color-muted`, primary/secondary background/text pairs.
- Space: `--yc-space-1`…`--yc-space-8`, `--yc-space-10`, `--yc-space-12`, representing 8–96px steps; section, gutter, heading margin, paragraph spacing, grid gap, card padding and button padding/gap roles.
- Layout: `--yc-content-width` 1200px, `--yc-width` 1310px, `--yc-reading-width` 760px. Existing theme content and wide widths are preserved.
- Shape and motion: card/image/control/button radii, `--yc-transition` and `--yc-ease`.

## Use in WordPress and GenerateBlocks

Use Appearance → Editor → Styles for fonts and palette. Use block typography/color/spacing controls and the supplied presets for new content. In GenerateBlocks style fields that accept CSS values, use tokens such as `var(--yc-grid-gap)` or `var(--yc-card-padding)` to reuse settings. Containers should use the content/wide layout settings or token-based max widths; no new page-specific classes are needed.

New GenerateBlocks Button variations use the plugin's verified `generateblocks_default_button_attributes` filter. Their real block settings contain token references for typography, padding, colors, radius, hover and focus. Existing saved button settings are preserved. For secondary/outline GB buttons, set an HTML attribute `data-button` to `secondary` or `outline`, or change the equivalent color/border token values in block settings. Primary is the default. These shared attributes avoid inventing per-page classes.

Native WordPress Buttons inherit primary styling. Choose Secondary or the native Outline style in the block Styles panel. Existing `yc-button`, `yc-green`, `yc-outline` hooks remain compatible with saved layouts. Native disabled controls and `aria-disabled="true"` links receive disabled appearance; a disabled link must also have navigation removed/disabled by its author (CSS does not disable navigation).

Native Images and Featured Images offer Landscape 16:9 and Square 1:1 styles. GB Image blocks can use the built-in aspect-ratio and object-fit controls directly. Set aspect ratio to 16/9 or 1 and object-fit to cover. Shared image rules apply max-width, display, height and radius automatically. Logos remain uncropped and without rounded corners.

## Layout preservation and class cleanup

Generic resets moved out of the component file. Removed 65 superseded exact-selector declarations while retaining cascade order for other selectors. Repeated brand colors now reference shared tokens. Existing component hooks were kept because saved pages, header parts and JavaScript reference them; renaming these would require a separate migration of user content. No mass content rewrite or new per-page class system was introduced. No `!important` declarations were added.

Existing presentation layouts keep their responsive breakpoints. Global defaults use desktop >=1024px, tablet 768–1023px and mobile <768px, with section spacing 50/40/32px. Shared controls have minimum 48px height; keyboard focus and reduced motion remain supported. The saved header's 100%-width setting is bounded to its existing offset container to prevent overflow; saved user block settings were not overwritten.

## Automatic inheritance and validation

All pages, posts, archives and reusable patterns inherit the loaded global CSS and theme.json presets. `theme.css` is also loaded by the block editor. Explicit block-level styling remains intentional and takes precedence; reset a block's typography/color override to inherit a global preset. Existing palette slugs and font family slugs (`body`/`display`) were retained to preserve references.

Checked: Sass compilation; PHP syntax; theme JSON parsing; local font paths; plugin filter implementation in installed GenerateBlocks 2.4.1; computed frontend body font 16px/1.7; post H1 48px/700/1.2; mobile homepage and Food page width without horizontal overflow. Browser-confirmed headings use Playfair Display, body uses Inter, and WordPress emits local font-face CSS. Editor UI, complete keyboard/contrast audit, every page, and every existing block override have not been exhaustively tested. Existing user Global Styles contained no custom design values at the time of inspection and were left untouched.

Backups of the prior Sass and theme.json are in `backups/theme-before-design-system.*`.
