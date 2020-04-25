<?php

namespace App\Http\Controllers;

use App\Diagnosis;
use App\Http\Requests\CsvImportRequest;
use App\Item;
use App\Service;
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

        /* $not_found = fopen('not_found.csv', 'w');
        $found = fopen('found.csv', 'w'); */

        $services = [];
        $not = [];

        for ($i = 0; $i < count($csv_data); ++$i) {
            $found = false;
            $code = $csv_data[$i][2];
            $codes = explode(',', $code);
            for ($n = 0; $n < count($codes); ++$n) {
                $service = Service::where('code', $codes[$n])->first();
                if (is_null($service)) {
                    $found = false;
                    //array_push($not, $csv_data[$i]);
                    $new = new Service();
                    $new->SAT_code = $csv_data[$i][0];
                    $new->SAT = $csv_data[$i][1];
                    $new->code = $csv_data[$i][2];
                    $new->descripcion = $csv_data[$i][3];
                    $new->save();
                    $n = count($codes);
                //fputcsv($not_found, $csv_data[$i]);
                } else {
                    $found = true;
                    $csv_data[$i][2] = $codes[$n]; //correct code
                    $n = count($codes);
                    //array_push($services, $csv_data[$i]);
                    /* $service->SAT = $csv_data[$i][1];
                    $service->SAT_code = $csv_data[$i][0];
                    $service->descripcion = $csv_data[$i][3];
                    $service->save(); */
                    //array_push($services, $service);
                    //fputcsv($found, $csv_data[$i]);
                }
            }
            if ($found) {
                array_push($services, $csv_data[$i]);
            } else {
                array_push($not, $csv_data[$i]);
            }
        }

        /* for ($i = 2000; $i < count($csv_data); ++$i) {
            $item = new Item();
            $item->code = $csv_data[$i][0];
            $item->SAT = $csv_data[$i][1];
            $item->descripcion = $csv_data[$i][3];
            $item->save();
        } */

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

        $test = count($not);
        $count = count($services);

        return view('import.fields', compact('services', 'test', 'not', 'count'));
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

    public function getImportDiagnoses()
    {
        return view('import.importDiagnoses');
    }

    public function parseImportDiagnoses(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $csv_data = array_map('str_getcsv', file($path));

        for ($i = 0; $i < count($csv_data); ++$i) {
            $csv_data[$i][1] = $csv_data[$i][1].' '.$csv_data[$i][2].' '.$csv_data[$i][3];
        }

        $diagnoses = [];

        for ($i = 0; $i < count($csv_data); ++$i) {
            $diagnosis = new Diagnosis();
            $diagnosis->code = $csv_data[$i][0];
            $diagnosis->name = $csv_data[$i][1];
            $diagnosis->nombre = 'Pendiente';
            $diagnosis->save();
            array_push($diagnoses, $diagnosis);
        }

        $count = count($diagnoses);

        return view('import.fieldsDiagnoses', compact('diagnoses', 'count'));
    }
}
