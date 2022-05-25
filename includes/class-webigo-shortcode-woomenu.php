<?php

/**
 * This class works with the Webigo_Woomenu_Public class to create the shortcode
 * The Webigo_Woomenu_Public is responsible for defining which css and js are involved
 * 
 *  css: webigo-woomenu-public.css
 *  js: webigo-woomenu-public.js
 * 
 * This class is responsible for the logic of the shortcode
 */

class Webigo_Shortcode_Woomenu
{


    public $shortcode_name = 'webigo_woomenu';


    public function add_shortcode()
    {
        add_shortcode($this->shortcode_name, array($this, 'output'));
    }


    /**
     * Shortcode Wrapper.
     *
     * @param string[] $function Callback function.
     * @param array    $atts     Attributes. Default to empty array.
     * @param array    $wrapper  Customer wrapper data.
     *
     * @return string
     */
    public static function shortcode_wrapper(
        $function,
        $atts = array(),
        $wrapper = array(
            'class'  => 'wbg-woo-menu',
            'before' => null,
            'after'  => null,
        )
    ) {
        ob_start();

        // @codingStandardsIgnoreStart
        echo empty($wrapper['before']) ? '<div class="' . esc_attr($wrapper['class']) . '">' : $wrapper['before'];
        call_user_func($function, $atts);
        echo empty($wrapper['after']) ? '</div>' : $wrapper['after'];
        // @codingStandardsIgnoreEnd

        return ob_get_clean();
    }


    public function output($atts)
    {
        return $this->shortcode_wrapper(array($this, 'woomenu_shortcode'), $atts);
    }


    public function woomenu_shortcode($atts)
    {
        $atts = shortcode_atts(array(), $atts, $this->shortcode_name);
?>

        <h1 id="helloworld">Hello World</h1>

<?php
    }
}
