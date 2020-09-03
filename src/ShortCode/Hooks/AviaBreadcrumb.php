<?php
namespace LouisvilleGeek\EnfoldChild\ShortCode\Hooks;

use ObjectiveWP\Framework\ShortCode\ShortCode;

/**
 * Class AviaBreadcrumb
 *
 * @package LouisvilleGeek\EnfoldChild\ShortCode\Hooks
 */
class AviaBreadcrumb extends ShortCode
{
    /**
     * Avia Bread Crumb options.
     * @var array
     */
    protected $options;

    /**
     * Get the tag of the short code
     *
     * @return string
     */
    public function tag(): string
    {
        return 'bread_crumb';
    }


    /**
     * Tracking the page name and create breadcrumb
     *
     * @param string $options Output of scheme
     *
     * @return string
     */
    function AviaBreadcrumb($options = "")
    {
        $this->options = [  //change this array if you want another output scheme
            'before' => '<span class="arrow"> ',
            'after' => ' </span>',
            'delimiter' => '>'
        ];

        if (is_array($options)) {
            $this->options = array_merge($this->options, $options);
        }


        $markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
        $returnString = "";
        global $post;
        $returnString .= '<p class="breadcrumb">'.
            '<span class="breadcrumb_info">'.'</span> <a href="'.get_bloginfo('url').'">';
        $returnString .= "Home";
        $returnString .= "</a>";
        if (!is_front_page()) {
            $returnString .= $markup;
        }

        $output = $this->_simpleBreadCrumbCase($post);

        $returnString .= $output;

        $returnString .= get_the_title();

        $returnString .= " </span></p>";

        return $returnString;
    }

    /**
     * Gets the parent post and added link to breadcrumb
     *
     * @param \WP_Post $thePost this is post for breadcrumb generated.
     *
     * @return false|int|string
     */
    private function _simpleBreadCrumbCase($thePost)
    {
        $returnString = "";
        global $post;

        $markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
        if (is_page()) {
            if ($thePost->post_parent) {
                $my_query = get_post($thePost->post_parent);
                $this->_simpleBreadCrumbCase($my_query);
                $link = '<a href="';
                $link .= get_permalink($my_query->ID);
                $link .= '">';
                $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
                $returnString .= $link;
            }
            return $returnString;
        }

        if (is_single()) {
            $category = get_the_category();
            if (is_attachment()) {

                $my_query = get_post($thePost->post_parent);
                $category = get_the_category($my_query->ID);

                if (isset($category[0])) {
                    $ID = $category[0]->cat_ID;
                    $parents = get_category_parents($ID, true, $markup, false);
                    if(!is_object($parents)) $returnString .= $parents;
                    previous_post_link("%link $markup");
                }

            } else {

                $postType = get_post_type();

                if ($postType == 'post') {
                    $ID = $category[0]->cat_ID;
                    $returnString.= get_category_parents($ID, true, $markup, false);
                } else if ($postType == 'portfolio') {
                    $terms = get_the_term_list($post->ID, 'portfolio_entries', '', '$$$', '');
                    $terms = explode('$$$', $terms);
                    $returnString .= $terms[0].$markup;
                }
            }
            return $returnString;
        }

        if (is_tax()) {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            return $term->name;
        }


        if (is_category()) {
            $category = get_the_category();
            $i = $category[0]->cat_ID;
            $parent = $category[0]-> category_parent;

            if ($parent > 0 && $category[0]->cat_name == single_cat_title("", false)) {
                $returnString .= get_category_parents($parent, true, $markup, false);
            }
            return single_cat_title('', false);
        }


        if (is_author()) {
            $curauth = get_userdatabylogin(get_query_var('author_name'));
            return "Author: ".$curauth->nickname;
        }
        if (is_tag()) {
            return "Tag: " . single_tag_title('', false);
        }

        if (is_404()) {
            return __("404 - Page not Found", 'avia_framework');
        }

        if (is_search()) {
            return __("Search", 'avia_framework');
        }

        if (is_year()) {
            return get_the_time('Y');
        }

        if (is_month()) {
            $k_year = get_the_time('Y');
            $returnString .= "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
            return get_the_time('F');
        }

        if (is_day() || is_time()) {
            $k_year = get_the_time('Y');
            $k_month = get_the_time('m');
            $k_month_display = get_the_time('F');
            $returnString .= "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
            $returnString .= "<a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a>".$markup;

            return get_the_time('jS (l)');
        }
        return null;

    }


    /**
     * Get the name of the short code
     *
     * @return string
     */
    public function name(): string
    {
        return 'bread_crumb';
    }

    /**
     * Used for adding the short code function in.
     *
     * @param array $attributes
     * @return string
     */
    public function handle($attributes): string
    {
        return $this->AviaBreadcrumb();
    }


}