<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\UpdateServiceRequest;
use App\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Service $model)
    {
        return view('services.index', ['services' => $model->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::take(10)->get();

        return view('services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateService();

        Service::create($validated);

        return redirect()->route('services.index')->withStatus(__('Servicio registrado'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $categories = Category::get();

        return view('services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Service $service, UpdateServiceRequest $request)
    {
        $validated = $request->validated();

        $service->fill($validated);
        $service->save();

        return redirect()->route('services.index')->withStatus(__('Servicio actualizado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
    }

    protected function validateService()
    {
        return request()->validate(Service::$rules);
    }
}
