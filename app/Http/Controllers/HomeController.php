<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        SEOTools::setTitle('Latest rent, sale properties, apartments, cars and many more in Rwanda!');
        SEOTools::setDescription('The first platform for selling and buying anything in Rwanda');
        SEOTools::opengraph()->setUrl(\request()->url());
        SEOTools::setCanonical(\request()->url());
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::twitter()->setSite('@worldmarketconnect');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');


        $topfourhouses = \App\Models\House::orderBy('created_at', 'desc')
            ->take(4)->active()
            ->with('provinces')->get();
//        dd($topfourhouses);


        $topfourcars = \App\Models\Car::query()
            ->orderBy('created_at', 'desc')
            ->take(4)->active()
            ->get();

        $topfourlands = \App\Models\Land::query()
            ->orderBy('created_at', 'desc')
            ->take(4)->active()
            ->get();


        $topfourhotels = \App\Models\Hotel::query()
            ->orderBy('created_at', 'desc')
            ->take(4)->active()
            ->get();


        $topfourfashions = \App\Models\Fashion::query()
            ->orderBy('created_at', 'desc')
            ->take(4)->active()
            ->get();


        return view('welcome', [
            'topfourhouses' => $topfourhouses,
            'topfourcars' => $topfourcars,
            'topfourlands' => $topfourlands,
            'topfourhotels' => $topfourhotels,
            'topfourfashions' => $topfourfashions,
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function about(){
        return view('about');
    }
    
     public function terms(){
        return view('terms');
    }
    
    public function contact(){
        return view('contact');
    }
    
    public function footer(){
         return view('footer');
    }
    
}
