@props(
    [
        'color' => 'gray',

    ]
)

<span {{ $attributes->class(["bg-$color-100 text-$color-800 cursor-pointer border border-$color-300 text-xs font-semibold mr-2 px-2.5 whitespace-nowrap py-0.5 rounded dark:bg-$color-200 dark:text-$color-900"]) }}>
    {{ $slot }}
</span>
