<?php

namespace App\Http\Livewire;

use App\Models\Hotel;
use Livewire\Component;
use Livewire\WithPagination;

class HotelListingComponent extends Component
{
    use WithPagination;
    public $perPage = 12;


    public function render()
    {
        $hotels = Hotel::query()->paginate($this->perPage);
        return view('livewire.hotel-listing-component',[
            'hotels' => $hotels,
        ]);
    }
}
