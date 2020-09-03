<?php
namespace LouisvilleGeek\EnfoldChild\Filter\Hooks;
use ObjectiveWP\Framework\Filter\FilterHook;


/**
 * Class PageName
 *
 * @package LouisvilleGeek\EnfoldChild\Filter
 */
class PageName implements FilterHook
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
     * @param array ...$args Handle the Shortcode
     *
     * @return mixed
     */
    public function handle(...$args)
    {
        $class = $args[0];
        global $wp_query;
        /** @noinspection SpellCheckingInspection */
        if(is_page() && !empty($wp_query->query_vars["pagename"]))
            /** @noinspection SpellCheckingInspection */
            array_push($class, "page-name-". $wp_query->query_vars["pagename"]);
        return $class;
    }



}