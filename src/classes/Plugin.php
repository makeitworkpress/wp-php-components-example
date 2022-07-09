<?php
/**
 * Boots the plugin
 */
namespace MyPHPComponents;

defined( 'ABSPATH' ) or die('Nope...');

class Plugin {

  private static $instance = null;

  private function __construct() {
    $this->enqueue_scripts();
  }

  public static function instance() {
    if( ! isset(self::$instance) ) {
      self::$instance = new self();
    } 

    return self::$instance;
  }

  private function enqueue_scripts() {
    add_action('wp_enqueue_scripts', function() {
      wp_enqueue_style('component-styles', PLUGIN_URI . '/public/css/styles.css');
      wp_enqueue_script('component-scripts', PLUGIN_URI . '/public/js/scripts.js', [], false, true);
    });
  }

}
