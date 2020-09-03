<?php
namespace LouisvilleGeek\EnfoldChild\Action\Hooks;
use ObjectiveWP\Framework\Action\ActionHook;

class StyleLoginPage implements ActionHook
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
        wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/assets/login-page/style-login.css' );
    }

    /**
     * Get the tag
     *
     * @return string
     */
    public function tag(): string
    {
        return 'login_enqueue_scripts';
    }
}