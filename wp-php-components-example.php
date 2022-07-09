<?php
/**
 * Plugin Name: WP Component Example
 * Description: PHP Component Tutorial
 * Version: 0.0.1
 */
spl_autoload_register( function($class_name) {

  if( strpos($class_name, 'MyPHPComponents') !== 0 ) {
    return;
  }

  $called_class = str_replace( ['\\', 'MyPHPComponents'], ['/', ''], $class_name );
  $class_file   = dirname(__FILE__) . '/src/classes' . $called_class . '.php'; 

  if( file_exists($class_file) ) {
    require_once( $class_file );
  }

} );

/**
 * Load our plugin
 */
add_action( 'plugins_loaded', function() {
  defined('PLUGIN_PATH') or define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ));
  defined('PLUGIN_URI') or define( 'PLUGIN_URI', plugin_dir_url( __FILE__ ));

  $plugin = MyPHPComponents\Plugin::instance();

} );

/**
 * Output our example component
 */
add_filter('the_content', function($content) {

  $component = new MyPHPComponents\Components\ExampleComponent([
    'link'  => 'https://example.com',
    'text'  => __('Text'),
    'size'  => 'large'
  ]);

  $component_string = $component->render(false);

  return $content . $component_string;

});