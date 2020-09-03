<?php
namespace LouisvilleGeek\EnfoldChild\ShortCode;

use LouisvilleGeek\EnfoldChild\ShortCode\Hooks\AviaBreadcrumb;
use LouisvilleGeek\EnfoldChild\ShortCode\Hooks\HelloWorldReactShortCode;
use LouisvilleGeek\EnfoldChild\ShortCode\Hooks\Year;
use ObjectiveWP\Framework\ShortCode\ShortCode;
use ObjectiveWP\Framework\ShortCode\ShortCodeKernel as BaseShortCodeKernel;

/**
 * Class ShortCodesLoader
 *
 * @package LouisvilleGeek\EnfoldChild\Loaders
 */
class ShortCodeKernel extends BaseShortCodeKernel
{

    /**
     * Short codes to load
     *
     * @return ShortCode[]
     */
    public function shortCodes()
    {
        return [
            Year::class,
            AviaBreadcrumb::class,
            HelloWorldReactShortCode::class
        ];
    }
}