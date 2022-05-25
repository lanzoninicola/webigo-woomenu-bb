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

        $taxonomy     = 'product_cat';
        $orderby      = 'menu_order';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;

        $show_sub_cat_image = 0;

        $uncategorized_label = 'Uncategorized';

        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories($args);

        echo '<nav class="product-cats-nav-menu bricks-nav-menu-wrapper" data-mobile-visibility="hidden">';

        echo '<i class="ion-md-close" data-mobile-visibility="hidden"></i>'; // close mobile menu

        echo '<ul class="product-cats-nav bricks-nav-menu">';

        foreach ($all_categories as $cat) {

            if ($cat->category_parent == 0) {
                $category_id = $cat->term_id;

                if ($cat->name != $uncategorized_label) {

                    echo '<li class="product-cat menu-item" data-entity="product_cat" data-product-cat="' . $cat->term_id . '">';
                    // get the link of category
                    echo '<span>' . $cat->name . '</span>';

                    // extracting the subcategories 
                    $args2 = array(
                        'taxonomy'     => $taxonomy,
                        'child_of'     => 0,
                        'parent'       => $category_id,
                        'orderby'      => $orderby,
                        'show_count'   => $show_count,
                        'pad_counts'   => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li'     => $title,
                        'hide_empty'   => $empty
                    );

                    $sub_cats = get_categories($args2);

                    echo '<ul class="product-subcats bricks-nav-menu" data-entity="product_subcat" data-product-cat="' . $category_id . '" data-visibility="hidden">';

                    echo '<li class="product-subcat all menu-item ">';
                    echo '<a href="' . get_term_link($cat->slug, 'product_cat') . '"> Todos ' . $cat->name . '</a>';
                    echo '</li>';

                    if ($sub_cats) {
                        foreach ($sub_cats as $sub_category) {

                            echo '<li class="product-subcat menu-item">';

                            // get the link of sub-category
                            echo '<a href="' . get_term_link($sub_category->slug, 'product_cat') . '">' . $sub_category->name . '</a>';

                            // sub category image
                            if ($show_sub_cat_image === 1) {
                                $thumbnail_id = get_term_meta($sub_category->term_id, 'thumbnail_id', true);
                                $image = wp_get_attachment_url($thumbnail_id);
                                echo  '<img src="' . $image . '" alt="" height="20" width="20">';
                                //add other code here to display child details
                            }

                            echo '</li>'; // closing sub-category single
                        }
                    }
                    echo '</ul>'; // closing sub-categories
                    echo '</li>'; // closing product-cat  
                }
            }
        }
        echo '</ul>';
        echo '</nav>'; // closing product-cats-wrapper

    }
}
