<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChoicesComponent extends Component
{
    public $selectedDistrict ;

    public function hydrate()
    {
        $this->dispatchBrowserEvent('render-select2');
    }

    public function testIncrement(): void
    {
        $this->selectedDistrict += 1;
    }

    public function render()
    {
        $districts = [
            '1' => 'District 1',
            '2' => 'District 2',
            '3' => 'District 3',
            '4' => 'District 4',
            '5' => 'District 5',
            '6' => 'District 6',
            '7' => 'District 7',
            '8' => 'District 8',
            '9' => 'District 9',
            '10' => 'District 10',
            '11' => 'District 11',
            '12' => 'District 12',
            'Binh Tan' => 'Binh Tan',
            'Binh Thanh' => 'Binh Thanh',
            'Go Vap' => 'Go Vap',
            'Phu Nhuan' => 'Phu Nhuan',
            'Tan Binh' => 'Tan Binh',
            'Tan Phu' => 'Tan Phu',
            'Thu Duc' => 'Thu Duc',
        ];


        return view('livewire.choices-component',[
            'districts' => $districts,

        ]);
    }
}
