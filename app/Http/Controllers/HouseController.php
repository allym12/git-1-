<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use Artesaos\SEOTools\Facades\SEOTools;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('houses_index', [
            'houses' => House::latest()->paginate(10)
        ]);
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
    public function store(StoreHouseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        SEOTools::setTitle($house->title);
        SEOTools::setDescription($house->description);
        SEOTools::opengraph()->setUrl(\request()->url());
        SEOTools::setCanonical(\request()->url());
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::twitter()->setSite('@worldmarketconnect');
        SEOTools::jsonLd()->addImage($house->main_photo);

        return view('houses_show', [
            'house' => $house
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHouseRequest $request, House $house)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        //
    }
}
