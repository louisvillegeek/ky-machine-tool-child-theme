<?php
namespace LouisvilleGeek\EnfoldChild\Filter\Hooks;

use ObjectiveWP\Framework\Filter\FilterHook;

/**
 * Class ParentPageName
 *
 * @package LouisvilleGeek\EnfoldChild\Filter
 */
class ParentPageName implements FilterHook
{

    /**
     * Get the tag
     *
     * @return string
     */
    public function tag(): string
    {
        return 'body_class';
    }

    /**
     * Used for adding the short code function in.
     *
     * @param array ...$args Handle shortcode passed to it.
     *
     * @return mixed
     */
    public function handle(...$args)
    {
        $classes = $args[0];
        global $post;
        if (is_page()) {
            // Has parent / is sub-page
            if ($post->post_parent) {
                // Parent post name/slug
                $parent = get_post($post->post_parent);
                $classes[] = 'parent-slug-'.$parent->post_name;
                // Parent template name
                $parent_template = get_post_meta($parent->ID, '_wp_page_template', true);
                if (!empty($parent_template)) {
                    $classes[] = 'parent-template-' . sanitize_html_class(str_replace('.', '-', $parent_template));
                }
            }
        }
        return $classes;
    }


}