<?php

namespace LouisvilleGeek\EnfoldChild;

use LouisvilleGeek\EnfoldChild\Action\ActionKernel;
use LouisvilleGeek\EnfoldChild\Filter\FilterKernel;
use LouisvilleGeek\EnfoldChild\Enqueue\EnqueueKernel;
use LouisvilleGeek\EnfoldChild\ShortCode\ShortCodeKernel;
use ObjectiveWP\Framework\Contracts\Kernel;
use ObjectiveWP\Framework\Foundation\Application as BaseApplication;

/**
 * Class Application
 *
 * @package LouisvilleGeek\EnfoldChild
 * @see     https://codex.wordpress.org/Plugin_API/Action_Reference when "setup_theme" is called in wordpress
 */
class Application extends BaseApplication
{
    /**
     * @var array
     */
    protected $env = [];

    /**
     * A list of the kernels to bootstrap
     *
     * @return Kernel[]
     */
    protected function kernels()
    {
        return [
            EnqueueKernel::class,
            ShortCodeKernel::class,
            FilterKernel::class,
            ActionKernel::class
        ];
    }


    /**
     * Get an an environment variable.
     * @param string $key     The environment key
     * @param mixed  $default The default value if the variable is not found.
     * @return bool|mixed
     */
    public function getEnv(string $key, $default = null)
    {
        if (isset($this->env[$key])) {
            if ($this->env[$key] == 'false')
                return false;
            if ($this->env[$key] == 'true')
                return true;
            return $this->env[$key];
        }
        return $default;
    }


    /**
     * Bootstrap the application
     *
     * @return void
     */
    public function bootstrap()
    {
        $envPath = $this->getFilePath(".env");
        if (file_exists($envPath)) {
            $file = file_get_contents($envPath);
            $lines = explode("\n", $file);
            foreach($lines as $line) {
                $parts = explode("=", $line);
                $this->env[trim($parts[0])] = trim($parts[1]);
            }
        }

        /**
         * Added class section Enfold Avia builder..
         */
        add_theme_support('avia_template_builder_custom_css');
        parent::bootstrap();
    }
}