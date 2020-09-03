<?php

namespace LouisvilleGeek\EnfoldChild\ShortCode\Hooks;

use ObjectiveWP\Framework\ShortCode\ShortCode;

/**
 * Class HelloWorldReactShortCode
 * Example usage of react components
 * @package LouisvilleGeek\EnfoldChild\ShortCode\Hooks
 */
class HelloWorldReactShortCode extends ShortCode
{

    /**
     * Get the tag of the short code
     *
     * @return string
     */
    public function tag(): string
    {
        return 'test';
    }

    /**
     * Used for adding the short code function in.
     *
     * @param array $attributes
     * @return string
     */
    public function handle($attributes): string
    {
        return "
            <div class='HelloWorldComponent' data-name='World'></div>
        ";
    }
}