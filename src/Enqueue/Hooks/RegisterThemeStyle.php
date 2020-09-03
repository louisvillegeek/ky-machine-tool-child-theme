<?php

namespace LouisvilleGeek\EnfoldChild\Enqueue\Hooks;

use ObjectiveWP\Framework\Contracts\Foundation\Application;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;

/**
 * Class RegisterThemeStyle
 * @package LouisvilleGeek\EnfoldChild\Enqueue\Hooks
 */
class RegisterThemeStyle extends EnqueueHook
{

    protected $app;

    /**
     * RegisterThemeStyle constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Enqueue scripts or styles.
     *
     * @param array ...$args The arguments passed
     * @return void
     */
    public function handle(...$args)
    {
        wp_deregister_style('avia-style');
        wp_dequeue_style('avia-style');
        wp_register_style('avia-style', $this->app->getFileUri("style.css"), [], $this->app->getVersion(), 'all');
        wp_enqueue_style('avia-style');
    }
}