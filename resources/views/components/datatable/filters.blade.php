<div {{ $attributes->class(['lg:flex gap-2']) }}>
    <x-input.group borderless paddingless for="perPage" label="Filter dates">
        <x-input.select wire:model="filters.when" id="perPage">
            <option value="all">--Date filter--</option>
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="last_7_days">Last 7 days</option>
            <option value="last_30_days">Last 30 days</option>
            <option value="this_month">This month</option>
            <option value="last_month">Last month</option>
            <option value="this_year">This year</option>
            <option value="last_year">Last year</option>
        </x-input.select>
    </x-input.group>

    <x-date-flat-pickr wire:model="filters.date-min" id="start_date" placeholder="Start date"/>


    <x-date-flat-pickr wire:model="filters.date-max" id="end_date" placeholder="End date"/>

    <div>
        <x-button.secondary wire:click="resetFilters" class="ml-2">
            Reset Filters
        </x-button.secondary>
    </div>

</div>
