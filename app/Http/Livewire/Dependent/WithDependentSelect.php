<?php

namespace App\Http\Livewire\Dependent;

use App\Models\Cell;
use App\Models\District;
use App\Models\Sector;

trait WithDependentSelect
{
    public $perPage = 12;
    public $selectedProvince, $selectedDistrict, $selectedSector, $selectedCell;

    public $districts = [];
    public $sectors = [];
    public $cells = [];





    public function updatedSelectedProvince($value){
        $this->districts = [];
        $this->sectors = [];
        $this->cells = [];
        $this->selectedDistrict = null;
        $this->selectedSector = null;
        $this->selectedCell = null;
    }

    public function updatedSelectedDistrict($value){
        $this->sectors = [];
        $this->cells = [];
        $this->selectedSector = null;
        $this->selectedCell = null;
    }

    public function updatedSelectedSector($value){
        $this->cells = [];
        $this->selectedCell = null;
    }


    public function loadDistricts(): void
    {
        $this->districts = District::where('province_id', $this->selectedProvince)
            ->select(['id','district_name'])
            ->get();

    }

    public function loadSectors(): void
    {
        $this->sectors = Sector::where('district_id', $this->selectedDistrict)
            ->select(['id','sector_name'])
            ->get();
    }

    public function loadCells(): void
    {
        $this->cells = Cell::where('sector_id', $this->selectedSector)
            ->select(['id','cell_name'])
            ->get();
    }


    public function hydrate()
    {
        $this->dispatchBrowserEvent('render-select2');
    }
}
