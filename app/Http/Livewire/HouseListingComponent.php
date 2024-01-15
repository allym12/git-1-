<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Dependent\WithDependentSelect;
use App\Models\House;
use App\Models\Province;
use Livewire\Component;
use Livewire\WithPagination;

class HouseListingComponent extends Component
{
    use WithPagination;
    use WithDependentSelect;

    use WithClientPayment;

    public $isAllowed = true;


    public function checkPayment(): void
    {
        \App\Helpers\Kpay::hasPaid()
            ? $this->isAllowed = true : $this->isAllowed = false;
    }

    protected $listeners = [
        'getDistricts' => 'loadDistricts',
        'getSectors' => 'loadSectors',
        'getCells' => 'loadCells',
    ];



    public function mount()
    {
        $this->perPage = 12;

    }


    public function render()
    {
        $houses = House::query()
            ->when($this->selectedProvince, function ($query) {
                return $query->where('province', $this->selectedProvince);
            })
            ->when($this->selectedDistrict, function ($query) {
                return $query->where('district', $this->selectedDistrict);
            })
            ->when($this->selectedSector, function ($query) {
                return $query->where('sector', $this->selectedSector);
            })
            ->when($this->selectedCell, function ($query) {
                return $query->where('cell', $this->selectedCell);
            })
            ->paginate($this->perPage);
        return view('livewire.house-listing-component', [
            'houses' => $houses,
            'provinces' => Province::select(['id','province_name'])->get(),
        ])->layout('components.layouts.main');
    }
}
