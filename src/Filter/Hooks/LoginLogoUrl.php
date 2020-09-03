<?php

namespace LouisvilleGeek\EnfoldChild\Filter\Hooks;

use ObjectiveWP\Framework\Filter\FilterHook;

class LoginLogoUrl implements FilterHook
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
        return 'https://louisvillegeek.com';
    }

    /**
     * Get the tag
     *
     * @return string
     */
    public function tag(): string
    {
        return 'login_headerurl';
    }
}