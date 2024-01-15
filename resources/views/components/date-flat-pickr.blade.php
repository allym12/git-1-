@props(['options' => []])

@php
    $options = array_merge([
                    'dateFormat' => 'Y-m-d H:i:s',
                    'enableTime' => false,
                    'altFormat' =>  'j F Y',
                    'altInput' => true
                    ], $options);
@endphp

<div wire:ignore>
    <input

        x-data
        wire:ignore
        x-init="
            flatpickr($el, {
                dateFormat: '{{ $options['dateFormat'] }}',
                enableTime: {{ $options['enableTime'] ? 'true' : 'false' }},
                altFormat: '{{ $options['altFormat'] }}',
                onChange: function(selectedDates, dateStr, instance) {
                    $dispatch('input', dateStr);
                }
            })
        "
        x-ref="input"
        type="text"
        {{ $attributes->merge(['class' => 'form-input w-full border border-gray-300 rounded-md shadow-sm']) }}
    />
</div>
