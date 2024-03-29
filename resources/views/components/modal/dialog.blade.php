@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg">
            {{ $title }}
        </div>

        <div class="mt-4 overflow-x-auto z-20">
            {{ $content }}
        </div>
    </div>

    <div class="px-6 py-4 dark:bg-gray-800  text-right z-0 ">
        {{ $footer }}
    </div>
</x-modal>
