<?php

namespace App\Http\Livewire;

use App\Models\Car;
use Livewire\Component;
use Livewire\WithPagination;

class CarListingComponent extends Component
{
    use WithPagination;

    public $perPage = 12;

    public function render()
    {
        $cars = Car::query()->paginate($this->perPage);
        return view('livewire.car-listing-component',[
            'cars' => $cars,
        ]);
    }
}
