<div>
    <select wire:model="selectedDistrict" id="district" class="select2 form-control"
            style="width: 100%"
            multiple
            wire:model.lazy="selectedDistrict">

        @foreach($districts as $key => $district)
            <option value="{{ $key }}">{{ $district }}</option>
        @endforeach

    </select>


    <button wire:click="testIncrement">Submit</button>

    @json($selectedDistrict)
</div>
