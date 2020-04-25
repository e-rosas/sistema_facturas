<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!is_null($request->perPage)) {
            $perPage = $request->perPage;
        } else {
            $perPage = 15;
        }

        /* $services = Service::whereLike(['description', 'descripcion', 'SAT_code', 'code'], $search)
            ->paginate($perPage)
        ; */

        return view('services.index', compact('services', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnosis $diagnosis)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnosis $diagnosis)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnosis $diagnosis)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosis $diagnosis)
    {
    }
}
