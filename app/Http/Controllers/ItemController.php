<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        if (is_null($request['search'])) {
            $search = '';
            $items = Item::with('category')
                ->paginate($perPage)
        ;
        } else {
            $search = $request->search;
            $items = Item::with('category')->where('code', $search)
                ->paginate($perPage)
        ;
        }

        /* $services = Service::whereLike(['description', 'descripcion', 'SAT_code', 'code'], $search)
            ->paginate($perPage)
        ; */

        return view('items.index', compact('items', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::take(10)->get();

        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validateItem();
        if (isset($request['tax'])) {
            $validated['tax'] = 1;
        }
        Item::create($validated);

        return redirect()->route('items.index')->withStatus(__('Producto registrado exitosamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::get();

        return view('items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validated = $this->validateItem();
        if (isset($request['tax'])) {
            $validated['tax'] = 1;
        }
        $item->fill($validated);
        $item->save();

        return redirect()->route('items.index')->withStatus(__('Producto actualizado'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
    }

    protected function validateItem()
    {
        return request()->validate(Item::$rules);
    }
}
