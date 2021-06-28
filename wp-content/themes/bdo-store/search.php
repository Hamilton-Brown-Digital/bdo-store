<?php

if (!class_exists('Timber')) {
    echo 'Timber not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
    return;
}

if (!class_exists('acf')) {
    echo '<p>Advanced Custom Fields not activated. Make sure you activate the plugin in <a href="/wordpress/wp-admin/plugins.php#advanced-custom-fields-pro">/wp-admin/plugins.php</a>';
    return;
}

global $wp_query;
$foundPosts = $wp_query->found_posts;
$not_singular = $foundPosts > 1 ? 'results' : 'result';

$post = new TimberPost();

$context = Timber::get_context();
$context['posts'] = new Timber\PostQuery();
$context['title'] = get_search_query();
$context['count'] = $foundPosts . ' ' . $not_singular;

$templates = array('search.twig');
Timber::render($templates, $context);