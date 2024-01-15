<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOTools;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        SEOTools::setTitle('Cars');
        SEOTools::setDescription('Cars for sale');
        SEOTools::opengraph()->setUrl(\request()->url());
        SEOTools::setCanonical(\request()->url());
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::twitter()->setSite('@worldmarketconnect');
        SEOTools::jsonLd()->addImage(asset('images/cars.jpg'));

        $cars = Car::latest()->paginate(20);

        return view('cars_index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {

        SEOTools::setTitle($car->title);
        SEOTools::setDescription(strip_tags($car->description));
        SEOTools::opengraph()->setUrl(\request()->url());
        SEOTools::setCanonical(\request()->url());
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::twitter()->setSite('@worldmarketconnect');
        SEOTools::twitter()->setDescription(strip_tags($car->description));
        SEOTools::jsonLd()->addImage(asset('storage/' . $car->image));
        SEOTools::addImages(asset('storage/' . $car->image));
        OpenGraph::addImage(asset('storage/' . $car->image));


        $allcaroptions = ['cd_player' => 'CD Player',
            'air_conditioning' => 'Air Conditioning',
            'power_steering' => 'Power Steering',
            'a/c' => 'A/C',
            'air_bag' => 'Air Bag',
            'radio' => 'Radio'
        ];


        return view('cars_show', [
            'car' => $car,
            'allcaroptions' => $allcaroptions
        ]);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
