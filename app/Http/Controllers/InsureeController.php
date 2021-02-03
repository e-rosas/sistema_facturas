<?php

namespace App\Http\Controllers;

use App\Insuree;
use App\Insurer;
use Illuminate\Http\Request;

class InsureeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function show(Insuree $insuree)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Insuree $insuree)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insuree $insuree)
    {
    }

    public function updateInsurerPhone()
    {
        $insurees = Insurer::with('insurer')->get();
        foreach ($insurees as $insuree) {
            $insuree->insurer_phone_number = $insuree->insurer->phone_number;
            $insuree->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insuree $insuree)
    {
    }
}