@if(session()->has('message'))
    <div {{ $attributes->class(['absolute cursor-not-allowed pointer-events-none  text-red-600 px-4 py-2 bg-red-100 rounded-lg shadow-lg border border-red-500 alert-success']) }}>
        {{ session('message') }}
    </div>
@endif
