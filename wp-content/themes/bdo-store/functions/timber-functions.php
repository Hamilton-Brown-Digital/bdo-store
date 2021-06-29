<?php

class CustomTimber extends TimberSite
{

  function __construct() {
    add_filter('timber_context', array($this, 'add_to_context'));
    add_filter('get_twig', array($this, 'add_to_twig'));
    add_filter( 'wpseo_metabox_prio', function() { return 'low';});
    parent::__construct();
  }

  function add_to_context($context) {

    if (has_nav_menu('navigation_primary')) {
      $context['navigation_primary'] = new TimberMenu('navigation_primary', array(
        'depth' => 1
      ));
    }

    if (has_nav_menu('navigation_utility')) {
      $context['navigation_utility'] = new TimberMenu('navigation_utility', array(
        'depth' => 1
      ));
    }

    if (has_nav_menu('navigation_legal')) {
      $context['navigation_legal'] = new TimberMenu('navigation_legal');
    }

    $context['site'] = $this;

    $context['options'] = get_fields('options');

    return $context;
  }
  function add_to_twig($twig) {
    $twig->addExtension(new Twig_Extension_StringLoader());

    $twig->addFunction( new Timber\Twig_Function( 'get_accordion', function ( $id ) {
      $page = get_posts(array(
        'numberposts'	=> 1,
        'post_type'		=> 'page',
        'meta_key'		=> 'product_category',
        'meta_value'	=> $id
      ));

      if ( $page ) {
        $result['accordionColour'] = get_field('colour', 'product_cat_'.$id);

        $results = get_field('page_modules', $page[0]);
        foreach ($results as $key => $val) {
          if ($val['acf_fc_layout'] === 'accordion') {
            $result['accordionContent'] = $results[$key]['accordion_lists'];
          }
        }

        return $result;
      }
    } ) );

    $twig->addFunction( new Timber\Twig_Function( 'get_prod_cat_pages', function ( $id ) {
      $page = get_posts(array(
        'numberposts'	=> 1,
        'post_type'		=> 'page',
        'meta_key'		=> 'product_category',
        'meta_value'	=> $id
      ));

      if ( $page ) {
        return $page[0];
      }
    } ) );

    return $twig;
  }
}

new CustomTimber();
