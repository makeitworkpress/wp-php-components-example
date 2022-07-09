<?php
/**
 * The abstract class for our components
 */
namespace MyPHPComponents\Components;

defined( 'ABSPATH' ) or die( 'Nope...' );

class ExampleComponent extends Component {

  /**
   * Register our default parameters
   */
  protected function register() {
    $this->params = [
      'link'  => '#',
      'size'  => 'regular', 
      'text'  => ''
    ];
  }

  /**
   * Format our properties
   */
  protected function format() {

    foreach($this->params as $key => $value) {
      $this->props[$key] = esc_html($value);
    }
    
  }  

}