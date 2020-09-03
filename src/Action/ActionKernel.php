<?php
namespace LouisvilleGeek\EnfoldChild\Action;

use LouisvilleGeek\EnfoldChild\Action\Hooks\NoIndexTag;
use LouisvilleGeek\EnfoldChild\Action\Hooks\StyleLoginPage;
use ObjectiveWP\Framework\Action\ActionHook;
use ObjectiveWP\Framework\Action\ActionKernel as ActionKernelBase;

/**
 * Class ActionLoader
 * Loads Action
 *
 * @package LouisvilleGeek\EnfoldChild\Loaders
 */
class ActionKernel extends ActionKernelBase
{

    /**
     * The actions to load
     *
     * @return ActionHook[]
     */
    protected function actions(): array
    {
        return [
            StyleLoginPage::class,
            NoIndexTag::class
        ];
    }

}