<?php

namespace LouisvilleGeek\EnfoldChild\Filter\Hooks;

use ObjectiveWP\Framework\Contracts\Hooks\HasArguments;
use ObjectiveWP\Framework\Filter\FilterHook;

class DisablePluginDeactivation implements FilterHook, HasArguments
{
    public function acceptedArgs(): int
    {
        return 2;
    }

    /**
     * Get the tag
     *
     * @return string
     */
    public function tag(): string
    {
        return 'plugin_action_links';
    }

    /**
     * Handle the data given
     *
     * @param array ...$args The arguments passed
     *
     * @return mixed|void
     */
    public function handle(...$args)
    {
        $actions = $args[0];
        $plugin_file = $args[1];

        $is_required_plugin = in_array($plugin_file, array(
            'blogvault-real-time-backup/blogvault.php',
            'gravityforms/gravityforms.php',
            'updraftplus/updraftplus.php',
            'goodbye-captcha/goodbye-captcha.php',
            'wp-bruiser-gravityforms/wp-bruiser-gravityforms.php',
            'contact-form-7/contact-form-7.php',
            'wp-bruiser-contactform7/wp-bruiser-contactform7.php'
        ));

        if (array_key_exists('deactivate', $actions) && $is_required_plugin) {
            unset($actions['deactivate']);
        }

        return $actions;
    }

}