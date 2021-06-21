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
        'depth' => 2
      ));
    }

    if (has_nav_menu('navigation_footer')) {
      $context['navigation_footer'] = new TimberMenu('navigation_footer');
    }

    $context['site'] = $this;

    $context['options'] = get_fields('options');

    return $context;
  }

  function add_to_twig($twig) {
    $twig->addExtension(new Twig_Extension_StringLoader());
    return $twig;
  }
}

new CustomTimber();
