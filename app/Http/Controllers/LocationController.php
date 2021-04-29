<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Invoice;
use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::paginate(20);

        return view('locations.index', compact(['locations']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        $validated = $request->validated();
        Location::create($validated);

        return redirect()->route('locations.index')->withStatus(__('Ubicación registrada.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        $invoices = Invoice::where('location_id', $location->id)->paginate(20);
        return view('locations.show', compact('location', 'invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        $validated = $request->validated();
        $location->fill(($validated));
        $location->save();

        return redirect()->route('locations.index')->withStatus(__('Ubicación actualizada.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return redirect()->route('locations.index')->withStatus(__('Ubicación eliminada exitosamente.'));
    }

    public function searchLocation(Request $request)
    {
        $search = $request->search;
        $locations = Location::query()
            ->whereLike(['name'], $search)
            ->get()->take(8)
        ;
        $response = [];
        foreach ($locations as $location) {
            $response[] = [
                'id' => $location->id,
                'text' => $location->name,
            ];
        }
        echo json_encode($response);

        exit;
    }
}