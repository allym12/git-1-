<x-layouts.main>
    
    @if(\App\Helpers\Kpay::hasPaid())
        @livewire('hotel-listing-component')
    @else
        @livewire('client-pay-component')
    @endif

</x-layouts.main>
