<?php

namespace App\Http\Controllers;

use App\Item;
use App\Service;
use Illuminate\Http\Request;

class SearchProductController extends Controller
{
    public function searchService(Request $request)
    {
        $search = $request->search;
        $services = Service::query()
            ->whereLike(['code', 'description'], $search)
            ->get()->take(8)
        ;
        $response = [];
        foreach ($services as $service) {
            $response[] = [
                'id' => $service->id,
                'text' => $service->code.' '.$service->description,
                'price' => $service->price,
                'discounted_price' => $service->discounted_price,
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function findService(Request $request)
    {
        $service_id = $request->service_id;
        $service = Service::find($service_id)
        ;

        echo json_encode($service);
        exit;
    }

    public function searchItem(Request $request)
    {
        $search = $request->search;
        $items = Item::query()
            ->whereLike(['code', 'description', 'descripcion'], $search)
            ->get()->take(5)
        ;
        $response = [];
        foreach ($items as $item) {
            $response[] = [
                'id' => $item->id,
                'text' => $item->code.' '.$item->descripcion,
                'price' => $item->price,
                'discounted_price' => $item->discounted_price,
                'tax' => $item->tax,
            ];
        }
        echo json_encode($response);
        exit;
    }

    public function findItem(Request $request)
    {
        $item_id = $request->item_id;
        $item = Item::find($item_id)
        ;

        echo json_encode($item);
        exit;
    }

    public function searchServiceIndex(Request $request)
    {
        $search = $request->search;

        /* $services = Service::whereLike(['description', 'descripcion', 'SAT_code', 'code'], $search)
            ->paginate()
        ; */

        $services = Service::where('code', $search)
            ->orWhere('SAT_code', $search)->paginate();

        return view('services.index', compact('services'));
    }

    public function searchItemIndex(Request $request)
    {
        $search = $request->search;

        /* $items = Item::whereLike(['description', 'descripcion', 'SAT', 'code'], $search)
            ->paginate()
        ; */

        $items = Item::where('code', $search)->paginate();

        return view('items.index', compact('items'));
    }
}
