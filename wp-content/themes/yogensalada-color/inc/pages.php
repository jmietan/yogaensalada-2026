<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
function yc_collection_topics( $collection ) {
 return $collection === 'yoga' ? array( 'beginner'=>'Beginner', 'relaxation'=>'Relaxation', 'flexibility'=>'Flexibility', 'intermediate'=>'Intermediate', 'all-levels'=>'All Levels' ) : array( 'breakfast'=>'Breakfast', 'lunch'=>'Lunch', 'dinner'=>'Dinner', 'snacks'=>'Snacks', 'drinks'=>'Drinks', 'plant-based'=>'Plant-Based' );
}
function yc_selected_topic( $collection ) {
 $topic = isset( $_GET['topic'] ) && is_string( $_GET['topic'] ) ? sanitize_key( wp_unslash( $_GET['topic'] ) ) : '';
 return isset( yc_collection_topics( $collection )[$topic] ) ? $topic : '';
}
add_shortcode( 'yc_filters', function( $atts ) {
 $collection = shortcode_atts( array( 'collection'=>'yoga' ), $atts )['collection'];
 $collection = $collection === 'food' ? 'food' : 'yoga';
 $selected = yc_selected_topic( $collection );
 $html = '<nav class="yc-filter-list" aria-label="' . esc_attr( ucfirst( $collection ) . ' article filters' ) . '" id="recipes">';
 foreach ( array_merge( array( ''=>'All' ), yc_collection_topics( $collection ) ) as $slug=>$label ) {
  $url = $slug ? add_query_arg( 'topic', $slug, get_permalink() ) : get_permalink();
  $html .= '<a class="yc-filter' . ( $selected === $slug ? ' is-active' : '' ) . '" href="' . esc_url( $url ) . '"' . ( $selected === $slug ? ' aria-current="true"' : '' ) . '>' . esc_html( $label ) . '</a>';
 }
 return $html . '</nav>';
} );
add_filter( 'query_loop_block_query_vars', function( $query, $block ) {
 $id = (int) ( $block->context['queryId'] ?? 0 );
 if ( ! in_array( $id, array( 31,32 ), true ) ) { return $query; }
 $collection = $id === 31 ? 'yoga' : 'food';
 $category = get_term_by( 'slug', $collection, 'category' );
 if ( ! $category ) { $query['post__in'] = array(0); return $query; }
 $query['tax_query'] = array( 'relation'=>'AND', array( 'taxonomy'=>'category', 'field'=>'term_id', 'terms'=>array($category->term_id) ) );
 $topic = yc_selected_topic( $collection );
 if ( $topic ) { $query['tax_query'][] = array( 'taxonomy'=>'post_tag', 'field'=>'slug', 'terms'=>yc_topic_tags($topic) ); }
 return $query;
}, 10, 2 );
add_filter( 'render_block_core/navigation-link', function( $content, $block ) {
 $path = trim( (string) wp_parse_url( $block['attrs']['url'] ?? '', PHP_URL_PATH ), '/' );
 if ( $path && is_page( basename( $path ) ) && strpos( $content, 'aria-current=' ) === false ) {
  $content = str_replace( 'class="wp-block-navigation-item__content"', 'aria-current="page" class="wp-block-navigation-item__content"', $content );
 }
 return $content;
}, 10, 2 );
add_shortcode( 'yc_contact_form', function() {
 $status = isset($_GET['message-status']) && is_string($_GET['message-status']) ? sanitize_key(wp_unslash($_GET['message-status'])) : '';
 $messages = array('sent'=>'Thank you! Your message was submitted.', 'error'=>'Your message could not be sent. Please try again later.', 'invalid'=>'Please complete all required fields with a valid email address.', 'wait'=>'Please wait a minute before sending another message.');
 ob_start();
 if (isset($messages[$status])) { echo '<p class="yc-form-notice" role="status">'.esc_html($messages[$status]).'</p>'; }
 ?>
 <form class="yc-contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
 <input type="hidden" name="action" value="yc_contact">
 <?php wp_nonce_field('yc_contact','yc_nonce'); ?>
 <p class="yc-honeypot" aria-hidden="true"><label>Leave this field empty<input name="website" tabindex="-1" autocomplete="off"></label></p>
 <label for="yc-name">Name <span aria-hidden="true">*</span></label><input id="yc-name" name="sender_name" placeholder="Your name" required maxlength="120" autocomplete="name">
 <label for="yc-email">Email <span aria-hidden="true">*</span></label><input id="yc-email" name="sender_email" type="email" placeholder="Your email address" required maxlength="254" autocomplete="email">
 <label for="yc-subject">Subject <span aria-hidden="true">*</span></label><select id="yc-subject" name="subject" required><option value="">Select a subject</option><option>General question</option><option>Yoga lessons</option><option>Collaboration</option></select>
 <label for="yc-message">Message <span aria-hidden="true">*</span></label><textarea id="yc-message" name="message" placeholder="Your message…" required maxlength="5000" rows="6"></textarea>
 <button class="yc-button" type="submit">Send Message <span aria-hidden="true">→</span></button>
 </form>
 <?php return ob_get_clean();
} );
function yc_handle_contact() {
 $page = get_page_by_path('contact');
 $redirect = $page ? get_permalink($page) : home_url('/contact/');
 $finish = function($status) use($redirect) { wp_safe_redirect(add_query_arg('message-status',$status,$redirect)); exit; };
 if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $finish('invalid'); }
 $value = function($key) { return isset($_POST[$key]) && is_string($_POST[$key]) ? wp_unslash($_POST[$key]) : ''; };
 if (!wp_verify_nonce($value('yc_nonce'),'yc_contact') || $value('website') !== '') { $finish('invalid'); }
 $name = sanitize_text_field($value('sender_name')); $email = sanitize_email($value('sender_email')); $subject = sanitize_text_field($value('subject')); $message = sanitize_textarea_field($value('message'));
 if (!$name || strlen($name)>120 || !is_email($email) || !in_array($subject,array('General question','Yoga lessons','Collaboration'),true) || !$message || strlen($message)>5000) { $finish('invalid'); }
 $key='yc_contact_'.hash('sha256',($_SERVER['REMOTE_ADDR'] ?? '').wp_salt());
 if(get_transient($key)) { $finish('wait'); }
 set_transient($key,1,MINUTE_IN_SECONDS);
 $sent = wp_mail(get_option('admin_email'),'Yoga Ensalada: '.$subject,"From: $name\nEmail: $email\n\n$message",array('Reply-To: '.$email));
 $finish($sent ? 'sent' : 'error');
}
add_action('admin_post_yc_contact','yc_handle_contact');
add_action('admin_post_nopriv_yc_contact','yc_handle_contact');

// Resolve menu destinations against WordPress's current permalink structure.
add_filter('render_block_data',function($block){
 if(($block['blockName'] ?? '') !== 'core/navigation-link'){return $block;}
 $url=$block['attrs']['url'] ?? '';
 if(strpos($url,'/')!==0 || strpos($url,'//')===0){return $block;}
 $slug=trim($url,'/');
 if(!$slug){$block['attrs']['url']=home_url('/');return $block;}
 $page=get_page_by_path($slug==='about'?'about-us':$slug);
 if($page){$block['attrs']['url']=get_permalink($page);}
 return $block;
});

// Match existing editorial tags as well as the filter's own tag.
function yc_topic_tags($topic) {
 $aliases=array('relaxation'=>array('relaxing'),'breakfast'=>array('pancake'),'drinks'=>array('healthy-drink','green-matcha'),'plant-based'=>array('vegan','vegetarian','plant-based-alternatives','plant-based-burger','vegetarian-siomai'));
 return array_merge(array($topic),$aliases[$topic] ?? array());
}
