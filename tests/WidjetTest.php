<?php

use EddysStudio\CurrenciesWidget\Filament\Widgets\CryptoPricesWidget;
use function Pest\Livewire\livewire;

it('can test', function () {
    expect(true)->toBeTrue();
});

it('widget_can_be_rendered', function () {
    livewire(CryptoPricesWidget::class)
        ->assertSuccessful();
});
