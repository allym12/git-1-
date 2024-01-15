<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Http\Requests\StoreLandRequest;
use App\Http\Requests\UpdateLandRequest;
use Artesaos\SEOTools\Facades\SEOTools;

class LandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('lands_index', [
            'lands' => Land::latest()->paginate(10)
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
    public function store(StoreLandRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Land $land)
    {
        SEOTools::setTitle($land->title);
        SEOTools::setDescription($land->description);
        SEOTools::opengraph()->setUrl(\request()->url());
        SEOTools::setCanonical(\request()->url());
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::twitter()->setSite('@worldmarketconnect');
        SEOTools::jsonLd()->addImage($land->image);
        return view('lands_show', compact('land'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Land $land)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLandRequest $request, Land $land)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Land $land)
    {
        //
    }
}
