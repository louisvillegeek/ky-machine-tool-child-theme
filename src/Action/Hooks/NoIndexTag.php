<?php
namespace LouisvilleGeek\EnfoldChild\Action\Hooks;
use ObjectiveWP\Framework\Action\ActionHook;

class NoIndexTag implements ActionHook
{

    /**
     * Handle the data given
     *
     * @param array ...$args The arguments passed
     *
     * @return mixed|void
     */
    public function handle(...$args)
    {
        if (strpos(get_site_url(), 'lougcloud') !== false) {
            echo '<meta name="robots" content="noindex">';
        }

        return;
    }

    /**
     * Get the tag
     *
     * @return string
     */
    public function tag(): string
    {
        return 'wp_head';
    }
}