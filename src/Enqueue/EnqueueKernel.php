<?php
namespace LouisvilleGeek\EnfoldChild\Enqueue;

use LouisvilleGeek\EnfoldChild\Enqueue\Hooks\JsApplication;
use LouisvilleGeek\EnfoldChild\Enqueue\Hooks\RegisterThemeStyle;
use ObjectiveWP\Framework\Enqueue\EnqueueHook;
use ObjectiveWP\Framework\Enqueue\EnqueueKernel as BaseEnqueueKernel;


/**
 * Class EnqueueLoader
 * Loads script and style enqueues
 *
 * @package LouisvilleGeek\EnfoldChild\Loaders
 */
class EnqueueKernel extends BaseEnqueueKernel
{
    /**
     * The enqueues to load
     *
     * @var EnqueueHook[]
     * @return array
     */
    public function enqueues()
    {
        return  [
            JsApplication::class,
            RegisterThemeStyle::class
        ];
    }
}