# Currencies Widget for Filament

A simple Filament widget that displays real-time currency exchange rates (USD, EUR, GBP, etc.) on your dashboard. Data is fetched from a free API and cached to avoid rate limits.

## Requirements

- PHP 8.2 or higher
- Laravel 12
- Filament 4.x

## Installation

Since this package is not yet published on Packagist, you need to add it as a VCS repository in your project's `composer.json`.

1. Add the repository to your `composer.json`:
{
...
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/EddysStudio/currencies-widget"
        }
    ],
...
and add the package to section "require":
    "require": {
        ...
        "eddysstudio/currencies-widget": "^1.0"
    },

2. Register the Widget in your Filament panel.

In the /app/Providers/Filament/AdminPanelProvider.php add widget class:
...
    ->widgets([
        ...
        \EddysStudio\CurrenciesWidget\Filament\Widgets\CryptoPricesWidget::class,
    ]) 

## Usage

Once the plugin is registered, the widget will automatically appear on your Filament dashboard. It shows current exchange rates for the selected currencies.

You can customize which currencies are displayed through the widget's built-in filter form.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
