<?php
namespace LouisvilleGeek\EnfoldChild\Filter\Hooks;

use ObjectiveWP\Framework\Filter\FilterHook;

/**
 * Class RemoveFooterBacklink
 *
 * @package LouisvilleGeek\EnfoldChild\Filter
 */
class RemoveFooterBacklink implements FilterHook
{

    /**
     * Get the tag
     *
     * @return string
     */
    public function tag(): string
    {
        return 'kriesi_backlink';
    }

    /**
     * Handle the data given
     *
     * @param array ...$args The arguments passed
     *
     * @return string An empty string.
     */
    public function handle(...$args)
    {
        return "";
    }
}