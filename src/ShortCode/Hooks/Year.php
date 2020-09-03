<?php
namespace LouisvilleGeek\EnfoldChild\ShortCode\Hooks;

use ObjectiveWP\Framework\ShortCode\ShortCode;

/**
 * Class Year Auto Update the year with short-code.
 *
 * @package LouisvilleGeek\EnfoldChild
 */

class Year extends ShortCode
{

    /**
     * Get the tag of the short code
     *
     * @return string
     */
    public function tag(): string
    {
        return 'year';
    }

    /**
     * Returns the current year.
     *
     * @param array $attributes
     * @return false|string
     */
    public function handle($attributes): string
    {
        return date('Y');
    }

}