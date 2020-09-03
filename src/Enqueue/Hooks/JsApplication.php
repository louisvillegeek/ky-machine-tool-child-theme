<?php
namespace LouisvilleGeek\EnfoldChild\Enqueue\Hooks;

use LouisvilleGeek\EnfoldChild\Application;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;

/**
 * Class EnqueueLoader
 * Loads the webpack build
 *
 * @package LouisvilleGeek\EnfoldChild\Loaders
 */
class JsApplication extends EnqueueHook
{
    /** @var Application  */
    protected $app;

    /**
     * JsApplication constructor.
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
        $part = $this->app->getEnv('APP_DEBUG', false) ? 'development' : 'production.min';
        $this->enqueueScript('react', $this->app->getFileUri('assets/node_modules/react/umd/react.' . $part . '.js'), [], $this->app->getVersion());
        $this->enqueueScript('react-dom', $this->app->getFileUri('assets/node_modules/react-dom/umd/react-dom.' . $part . '.js'), [], $this->app->getVersion());
        $this->enqueueScript($this->app->prefix('application'), $this->app->getFileUri('assets/ts/dist/app.bundle.js'), ['jquery', 'react', 'react-dom'], $this->app->getVersion());
    }
}