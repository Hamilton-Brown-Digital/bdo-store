<?php

if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

if (!class_exists('acf')) {
    echo '<p>Advanced Custom Fields not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#advanced-custom-fields-pro">/wp-admin/plugins.php</a>';
    return;
}

$query = new WP_Query( array(
    's' => get_search_query(),
    'post_type' => array( 'page', 'product' )
) );

$foundPosts = $query->found_posts;
$not_singular = $foundPosts > 1 ? 'results' : 'result';

$context = Timber::get_context();
$context['posts'] = new Timber\PostQuery($query);
$context['title'] = get_search_query();
$context['count'] = $foundPosts . ' ' . $not_singular;

$templates = array('search.twig');
Timber::render($templates, $context);

wp_reset_postdata();