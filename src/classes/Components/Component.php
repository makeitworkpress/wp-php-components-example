<?php
/**
 * The abstract class for our components
 */
namespace MyPHPComponents\Components;

defined( 'ABSPATH' ) or die( 'Nope...' );

abstract class Component {

  /**
   * Contains the parameters for a component
   * @access protected
   */ 
  protected $params = [];

  /**
   * Contains the public properties, used in the template
   * @access public
   */  
  public $props = [];

  /**
   * Contains the template
   * @access protected
   */  
  protected $template = '';

   /**
   * Set up our parameters and component
   * 
   * @param array     $params     The parameters for our component
   * @param boolean   $format     Query and format by default
   */
  final public function __construct( array $params = [], bool $format = true ) {

    $this->register();

    $file = strtolower( (new \ReflectionClass($this))->getShortName() );
    $this->template = PLUGIN_PATH . '/src/templates/components/' . $file . '.php';
    $this->params   = wp_parse_args( $params, $this->params );

    if( $format ) {
      $this->format();
    }

  }

  /**
   * This function registers the default parameters for the component
   * It should be used to set $this->params with the default parameters.
   */  
  abstract protected function register();

  /**
   * This function is used for formatting or querying of data based on parameters
   */
  abstract protected function format();

  /**
   * Renders a component
   * 
   * @param bool $echo Whether a template should be displayed or returned as a string
   */
  public final function render( bool $echo = true ) {

    if( ! $this->props || ! file_exists($this->template) ) {
      return;
    }

    foreach( $this->props as $key => $value ) {
      ${$key} = $value;
    }

    if( ! $echo ) {
      ob_start();
    }

    require( $this->template );

    if( ! $echo ) {
      return ob_get_clean();
    }

  }

}