<?php

add_action( 'wp_head', function(){
    wp_enqueue_style('shortcode-transparent', plugins_url('themes/shortcode-transparent.css', __FILE__ ));
});

new BBIT_ShortCode();

class BBIT_ShortCode {
    public function __construct(){
        wp_enqueue_script('bit-initializer', 'http://widget.bandsintown.com/javascripts/bit_widget.js');
        $this->setup_shortcode();
    }
    
    public function setup_shortcode(){
        add_action('init', function(){
            add_shortcode('bbit', array($this, 'shortcode_handler'));
        });
    }
    
    public function shortcode_handler( $atts ) {
        $a = shortcode_atts( array(
            'bandname' => 'something',
        ), $atts );

        ob_start();
        include('bbit-shortcode-view.php');
        return ob_get_clean();
    }   
}