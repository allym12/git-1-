@props([
    'type'
])

@php
    if ($type == 'primary') {
        $type = 'hover:bg-violet-700 hover:text-white border border-violet-700 text-violet-700';
    }elseif ($type == 'secondary') {
        $type = 'hover:bg-gray-700 hover:text-white border border-gray-700 text-gray-700';
    }elseif ($type == 'danger') {
        $type = 'hover:bg-red-700 hover:text-white border border-red-700 text-red-700';
    }elseif ($type == 'warning') {
        $type = 'hover:bg-orange-700 hover:text-white border border-orange-700 text-orange-700';
        }elseif ($type == 'success') {
        $type = 'hover:bg-green-700 hover:text-white border border-green-700 text-green-700';
        }
@endphp

<a {{ $attributes->merge(['class' => 'inline-flex cursor-pointer items-center px-2 py-1  rounded-md shadow-sm hover:shadow-md duration-800 text-xs font-medium transition-all  ' . $type]) }}>
    {{ $slot }}
</a>
