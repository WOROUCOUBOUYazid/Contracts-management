<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use Illuminate\Http\Request;

class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ressources.index', [
            'ressources' => Ressource::all(),
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
    public function show(ressource $ressource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ressource $ressource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ressource $ressource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ressource $ressource)
    {
        //
    }

    /**
     * Get all ressources of my application.
     */
    public function list(){
        $routes = app('router')->getRoutes();
        foreach ($routes as $route) {
            Ressource::create([
                'name' => is_null($route->getName()) ? "zap" : $route->getName(),
                'uri' => $route->uri(),
                'http_method' => $route->methods()[0],
            ]);
        }
        return Ressource::all();
    }
}
