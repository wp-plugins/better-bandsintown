<?php

add_action( 'wp_head', function(){
    wp_enqueue_style('shortcode', plugins_url('themes/shortcode.css', __FILE__ ));
    wp_enqueue_style('shortcode-dark-transparent', plugins_url('themes/shortcode-dark-transparent.css', __FILE__ ));
    wp_enqueue_style('shortcode-light-transparent', plugins_url('themes/shortcode-light-transparent.css', __FILE__ ));
});

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script('bit-initializer', 'http://widget.bandsintown.com/javascripts/bit_widget.js');
});

new BBIT_ShortCode();

class BBIT_ShortCode {
    public function __construct(){
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
            'theme' => 'dark-transparent'
        ), $atts );
        
        if($a['theme'] == 'dark-transparent')
        {
            $css_class = 'bbit-shortcode-dark-transparent';
        } else { // Light and other shit
            $css_class = 'bbit-shortcode-light-transparent';
        }

        ob_start();
        include('bbit-shortcode-view.php');
        return ob_get_clean();
    }   
}