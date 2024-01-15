@props(['active'])
<li class="relative px-6 py-3 {{ $active ? 'bg-purple-50 text-white' : '' }}">
    @if($active)
        <span
            class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
            aria-hidden="true"
        ></span>
    @endif
    <a {{ $attributes->merge(['class' => ' inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800']) }}>
        {{ $icon ?? '' }}
        <span class="ml-4">{{ $slot }}</span>
    </a>
</li>
