<?php

namespace App\Http\Controllers;

use App\Helpers\Kpay;
use App\Models\Fashion;
use App\Http\Requests\StoreFashionRequest;
use App\Http\Requests\UpdateFashionRequest;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOTools;

class FashionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        SEOTools::setTitle('Fashion items');
        SEOTools::setDescription('Shoes, clothes, bags, for sale at affordable prices');
        SEOTools::opengraph()->setUrl(\request()->url());
        SEOTools::setCanonical(\request()->url());
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::twitter()->setSite('@worldmarketconnect');
        SEOTools::jsonLd()->addImage(asset('images/cars.jpg'));

        $fashions = Fashion::latest()->paginate(20);

        return view('fashions_index', compact('fashions'));
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
    public function store(StoreFashionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fashion $fashion)
    {
        SEOTools::setTitle($fashion->title);
        SEOTools::setDescription(strip_tags($fashion->description));
        SEOTools::opengraph()->setUrl(\request()->url());
        SEOTools::setCanonical(\request()->url());
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::twitter()->setSite('@worldmarketconnect');
        SEOTools::twitter()->setDescription(strip_tags($fashion->description));
        SEOTools::jsonLd()->addImage(asset('storage/' . $fashion->image));
        SEOTools::addImages(asset('storage/' . $fashion->image));
        OpenGraph::addImage(asset('storage/' . $fashion->image));


        return view('fashions_show', [
            'fashion' => $fashion,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fashion $fashion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFashionRequest $request, Fashion $fashion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fashion $fashion)
    {
        //
    }
}
