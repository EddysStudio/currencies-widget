<?php

namespace EddysStudio\CurrenciesWidget\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EddysStudio\CurrenciesWidget\CurrenciesWidget
 */
class CurrenciesWidget extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \EddysStudio\CurrenciesWidget\CurrenciesWidget::class;
    }
}
