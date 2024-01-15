<x-layouts.main>
    @if(\App\Helpers\Kpay::hasPaid())
        @livewire('car-listing-component')
    @else
        @livewire('client-pay-component')
    @endif

</x-layouts.main>
