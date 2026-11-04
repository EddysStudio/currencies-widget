<?php

namespace EddysStudio\CurrenciesWidget\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class CryptoPricesWidget extends StatsOverviewWidget implements HasSchemas
{
    use InteractsWithSchemas;
   
    public ?array $data1 = []; 
    protected array $ar_currencies = [
        'EUR' => 'Euro',
        'GBP' => 'Pound Sterling',
        'JPY' => 'Japanese Yen',
        'CNY' => 'Chinese Yuan',
        'CHF' => 'Swiss Franc',
        'CAD' => 'Canadian Dollar',
        'TRY' => 'Turkish Lira',
        'INR' => 'CIndian Rupee',
        'BRL' => 'Brazilian real',
    ];

    protected ?string $heading = "Exchange rates";
    protected string $view = 'currencies-widget::currency-widget';

    public function saveCurrencies(): void
    {
        $currencies = $this->data1['currencies'] ?? [];
        
        Storage::put('currencies-widget/settings.json', json_encode([
            'currencies' => $currencies,
        ]));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data1')
            ->components([ 
                \Filament\Forms\Components\Select::make('currencies')
                    ->hiddenLabel()
                    ->multiple()
                    ->options($this->ar_currencies)
                    ->default(['EUR'])
                    ->afterStateUpdated(fn () => $this->saveCurrencies())->live(),
            ]);
    }

    public function mount(): void
    {
        $default = ['EUR', 'GBP'];
        if (Storage::exists('currencies-widget/settings.json')) {
            $saved = json_decode(Storage::get('currencies-widget/settings.json'), true);
            $default = $saved['currencies'] ?? $default;
        }
        
        $this->form->fill([
            'currencies' => $default, // Начальные значения
        ]);
    }
    protected function getAllRates(): array
    {
        return Cache::remember(class_basename(static::class) . '-currates', now()->addHour(), function () {
            $response = Http::get('https://api.frankfurter.dev/v1/latest', ['base' => 'USD']);
            $data = $response->json();
            return $data;
        });
    }

    protected function getRates(): array
    {
        $selectedCurrencies = $this->data1['currencies'] ?? ['EUR', 'GBP'];

        $data = $this->getAllRates();
        $rates = [];
        foreach($data['rates'] as $k=>$val) {
            if(in_array($k,$selectedCurrencies)) $rates[$k] = number_format(1/$val, 4)."$";
        }
        return $rates;
    }
}