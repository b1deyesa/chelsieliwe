<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Carrier;
use App\Models\Portfolio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Carrier $carrier)
    {
        return view('dashboard.portfolio.index', [
            'carrier' => $carrier,
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
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
    
    public function download($path)
    {
        $path = urldecode($path);

        if (
            Str::contains($path, ['instagram.com', 'tiktok.com', 'youtube.com', 'youtu.be'])
        ) {
            return redirect()->away($path);
        }

        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        return Storage::disk('public')->download($path);
    }
}
