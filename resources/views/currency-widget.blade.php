<x-filament-widgets::widget>
    <x-filament::section>
        <h2 class="fi-account-widget-heading cmb-4">Currencies:</h2>
        {{-- Form with currencies select --}}
        {{ $this->form }}

        {{-- received currencies --}}
        <div class="fi-sc fi-grid fi-sc-has-gap lg:fi-grid-cols cmt-4" style="--cols-lg: repeat({{(count($this->getRates())<5?count($this->getRates()):'5')}}, minmax(0, 1fr)); --cols-default: repeat(1, minmax(0, 1fr));">
            @foreach ($this->getRates() as $currency => $rate)
                <x-filament::card>
                    <div class="space-y-2">
                        <div class="fi-account-widget-heading" style="color: var(--primary-700);">
                            {{ $currency }} / USD
                        </div>
                        <div class="rate">
                            {{ $rate}}
                        </div>
                    </div>
                </x-filament::card>
            @endforeach
        </div>    
    </x-filament::section>
</x-filament-widgets::widget>
