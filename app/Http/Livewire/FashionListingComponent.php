<?php

namespace App\Http\Livewire;

use App\Models\Fashion;
use Livewire\Component;
use Livewire\WithPagination;

class FashionListingComponent extends Component
{
    use WithPagination;

    public $perPage = 12;

    public function render()
    {
        $fashions = Fashion::query()->paginate($this->perPage);
        return view('livewire.fashion-listing-component',[
            'fashions' => $fashions,
        ]);
    }
}
