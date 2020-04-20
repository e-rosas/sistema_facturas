<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvImportRequest;
use App\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    public function getImportItems()
    {
        return view('import.importItems');
    }

    public function parseImportItems(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $csv_data = array_map('str_getcsv', file($path));
        $test = count($csv_data);

        for ($i = 2000; $i < count($csv_data); ++$i) {
            $item = new Item();
            $item->code = $csv_data[$i][0];
            $item->SAT = $csv_data[$i][1];
            $item->descripcion = $csv_data[$i][3];
            $item->save();
        }

        /* $items = [];
        $services = [];

        $fp_items = fopen('items.csv', 'w');
        $fp_services = fopen('services.csv', 'w');
        for ($i = 0; $i < count($csv_data); ++$i) {
            if (empty($csv_data[$i][2])) {
                array_push($items, $csv_data[$i]);
            // fputcsv($fp_items, $csv_data[$i]);
            } else {
                array_push($services, $csv_data[$i]);
                // fputcsv($fp_services, $csv_data[$i]);
            }
        }

        $test = count($items);
        $count = count($services);

        fclose($fp_items);
        fclose($fp_services); */

        return view('import.fields', compact('csv_data', 'test'));
    }

    public function getImportRates()
    {
        return view('import.importRates');
    }

    public function parseImportRates(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $csv_data = array_map('str_getcsv', file($path));

        $rates = [];

        for ($i = 0; $i < count($csv_data); ++$i) {
            $date = Carbon::createFromFormat('d-m-Y', $csv_data[$i][0]);
            $csv_data[$i][2] = $date->format('Y-m-d');
            DB::table('rates')->insert(
                ['date' => $csv_data[$i][2], 'value' => $csv_data[$i][1]]
            );
            array_push($rates, $csv_data[$i]);
        }

        $count = count($rates);

        return view('import.fieldsRates', compact('rates', 'count'));
    }
}
