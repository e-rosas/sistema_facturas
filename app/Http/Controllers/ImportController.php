<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvImportRequest;
use Carbon\Carbon;

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

        $items = [];
        $services = [];

        for ($i = 0; $i < count($csv_data); ++$i) {
            if (empty($csv_data[$i][2])) {
                array_push($items, $csv_data[$i]);
            } else {
                array_push($services, $csv_data[$i]);
            }
        }

        $test = count($items);
        $count = count($services);

        return view('import.fields', compact('items', 'test', 'services', 'count'));
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
            array_push($rates, $csv_data[$i]);
        }

        $count = count($rates);

        return view('import.fieldsRates', compact('rates', 'count'));
    }
}
