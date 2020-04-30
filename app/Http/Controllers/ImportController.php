<?php

namespace App\Http\Controllers;

use App\Actions\VerifyPaymentAmount;
use App\Credit;
use App\Dependent;
use App\Diagnosis;
use App\Http\Requests\CsvImportRequest;
use App\Insuree;
use App\Invoice;
use App\Item;
use App\Patient;
use App\Payment;
use App\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function getImportPatients()
    {
        return view('import.importPatients');
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

    public function parseImportPatients(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $csv_data = array_map('str_getcsv', file($path));

        $patients = [];

        $date = Carbon::today();
        for ($i = 1455; $i < count($csv_data); ++$i) { //1455
            $patient = new Patient();
            $patient->last_name = $csv_data[$i][2];
            $patient->name = $csv_data[$i][3];
            $patient->full_name = $patient->last_name.' '.$patient->name;
            $patient->phone_number = $csv_data[$i][4];
            $patient->gender = $this->gender($csv_data[$i][5]);
            $patient->insured = 0;
            $patient->birth_date = $date;
            $patient->street = 'Calle pendiente';
            $patient->street_number = 'No. de calle pendiente';
            $patient->city = 'Ciudad pendiente';
            $patient->state = 'CA';
            $patient->zip_code = 00000;
            $patient->email = 'Correo pendiente';
            //$patient->save();

            $insuree = Insuree::where('nss', $csv_data[$i][6])->first();
            if (!is_null($insuree)) {
                $dependent = new Dependent();
                $dependent->patient_id = $patient->id;
                $dependent->insuree_id = $insuree->patient_id;
                $dependent->relationship = 3;
                $patient->nss = $insuree->nss;
                //$dependent->save();
                array_push($patients, $patient);
            }

            /* $insuree = new Insuree();
            $insuree->patient_id = $patient->id;
            $insuree->insurer_id = 5;
            $insuree->insurance_id = 'PENDIENTE'.$patient->name.$csv_data[$i][1];
            $insuree->nss = $csv_data[$i][6];
            $insuree->save(); */
        }
        /* $all_names = [];
        for ($i = 0; $i < 685; ++$i) {
            $name = $csv_data[$i][4];
            if (!empty($name)) {
                array_push($all_names, $name);
            }
        }
        $names = array_unique($all_names);
        //array_push($names, $csv_data[1][4]);
        //credito
        for ($i = 0; $i < 685; ++$i) {
            $name = $csv_data[$i][0];
            array_push($names, $name);
        }
        //contado, con fecha
        for ($i = 686; $i < 765; ++$i) {
            $name = $csv_data[$i][4];
            array_push($names, $name);
        }
        //contado, sin fecha
        for ($i = 765; $i < 823; ++$i) {
            $name = $csv_data[$i][3];
            array_push($names, $name);
        }
        //contado, con fecha de nuevo
        for ($i = 823; $i < 842; ++$i) {
            $name = $csv_data[$i][4];
            array_push($names, $name);
        } */
        $count = count($patients);

        return view('import.fieldsPatients', compact('patients', 'count'));
    }

    public function getImportInvoices()
    {
        return view('import.importInvoices');
    }

    public function parseImportInvoices(CsvImportRequest $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $csv_data = array_map('str_getcsv', file($path));

        $invoices = [];
        $not_found_credito = [];
        $not_found_contado = [];
        $not_found_contado_e = [];
        $not_found_contado_f = [];
        $not_found_contado_m = [];
        //$all_names = [];
        /* for ($i = 0; $i < 685; ++$i) {
            $name = $csv_data[$i][4];
            if (!empty($name)) {
                $patientss = Patient::where('full_name', $name)->get();
                if (1 == count($patientss)) {
                    $invoice = new Invoice();
                    $invoice->person = $patientss[0];
                    $invoice->series = $csv_data[$i][1];
                    $invoice->number = $csv_data[$i][2];
                    $invoice->code = 'PENDING'.$csv_data[$i][2];
                    $invoice->concept = $csv_data[$i][3];
                    $invoice->currency = 'USD';
                    $invoice->comments = 'Importada';
                    $invoice->status = 3;
                    $invoice->type = 0;
                    $invoice->patient_id = $patientss[0]->id;
                    $invoice->date = Carbon::createFromFormat('d/m/Y', $csv_data[$i][0]);
                    if (!empty($csv_data[$i][6])) { //total in thousands
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][5].$csv_data[$i][6]);
                        if (strlen($csv_data[$i][9]) <= 6) {
                            $invoice->exchange_rate = (float) str_replace(',', '', $csv_data[$i][11]);
                        } else {
                            $invoice->exchange_rate = (float) str_replace(',', '', $csv_data[$i][10]);
                        }
                    } else {
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][5]);
                        $invoice->exchange_rate = (float) str_replace(',', '', $csv_data[$i][9]);
                    }
                    $invoice->amount_due = (float) str_replace(',', '', $invoice->total_with_discounts);
                    $invoice->save();
                    $n = $i + 1;
                    $next_concept = $csv_data[$n][3];

                    $length = strlen($next_concept);
                    while ($length < 27) {
                        //Log::debug($csv_data[$n]);
                        $date = Carbon::createFromFormat('d/m/Y', $csv_data[$n][0]);
                        if (1 == strlen($csv_data[$n][6])) {
                            $amount = (float) str_replace(',', '', $csv_data[$n][6].$csv_data[$n][7]);
                            $rate = (float) str_replace(',', '', $csv_data[$n][8]);
                        } else {
                            $amount = (float) str_replace(',', '', $csv_data[$n][6]);
                            $rate = (float) str_replace(',', '', $csv_data[$n][7]);
                        }
                        if (26 == $length) {
                            //payment
                            $validatePayment = new VerifyPaymentAmount($amount, $invoice->id);
                            $concept = $validatePayment->verifyPayment();
                            if ($concept < 2) {
                                $payment = new Payment();
                                $payment->invoice_id = $invoice->id;
                                $payment->date = $date;
                                $payment->amount_paid = $amount;
                                $payment->exchange_rate = $rate;
                                $payment->method = 0;
                                $payment->concept = $concept;
                                $payment->number = $invoice->number.'- P'.rand(1, 1000);
                                $payment->comments = 'importado';
                                $payment->save();
                                $invoice->pagos[] = $payment;
                            }
                        } else {
                            $credit = new Credit();
                            $credit->invoice_id = $invoice->id;
                            $credit->date = $date;
                            $credit->amount_due = $amount;
                            $credit->comments = 'importado';
                            $credit->exchange_rate = $rate;
                            $credit->number = $invoice->number.'- NC'.rand(1, 1000);
                            $credit->series = 'NC';
                            $credit->save();
                            $invoice->nota = $credit;
                        }

                        //credit
                        ++$n;
                        $next_concept = $csv_data[$n][3];
                        $length = strlen($next_concept);
                    }
                    //R: 26
                    //c: 20
                    array_push($invoices, $invoice);
                } else {
                    array_push($not_found_credito, $csv_data[$i]);
                }
            }
        } */
        //de contado
        for ($i = 686; $i < 763; ++$i) {
            $name = $csv_data[$i][4];
            if (!empty($name)) {
                $patientss = Patient::where('full_name', $name)->get();
                if (1 == count($patientss)) {
                    $invoice = new Invoice();
                    $invoice->person = $patientss[0];
                    $invoice->series = $csv_data[$i][1];
                    $invoice->number = $csv_data[$i][2];
                    $invoice->code = 'PENDING'.$csv_data[$i][2];
                    $invoice->concept = $csv_data[$i][3];
                    $invoice->currency = 'USD';
                    $invoice->comments = 'Importada';
                    $invoice->status = 3;
                    $invoice->type = 1;
                    $invoice->patient_id = $patientss[0]->id;
                    $invoice->date = Carbon::createFromFormat('d/m/Y', $csv_data[$i][0]);
                    if (!empty($csv_data[$i][6])) { //total in thousands
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][5].$csv_data[$i][6]);
                        if (strlen($csv_data[$i][9]) <= 6) {
                            $invoice->exchange_rate = (float) str_replace(',', '', $csv_data[$i][11]);
                        } else {
                            $invoice->exchange_rate = (float) str_replace(',', '', $csv_data[$i][10]);
                        }
                    } else {
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][5]);
                        $invoice->exchange_rate = (float) str_replace(',', '', $csv_data[$i][9]);
                    }
                    $invoice->amount_due = (float) str_replace(',', '', $invoice->total_with_discounts);
                    $invoice->save();
                    //payment
                    $validatePayment = new VerifyPaymentAmount((float) str_replace(',', '', $invoice->total_with_discounts), $invoice->id);
                    $concept = $validatePayment->verifyPayment();
                    if ($concept < 2) {
                        $payment = new Payment();
                        $payment->invoice_id = $invoice->id;
                        $payment->date = $invoice->date;
                        $payment->amount_paid = (float) str_replace(',', '', $invoice->total_with_discounts);
                        $payment->exchange_rate = (float) str_replace(',', '', $invoice->exchange_rate);
                        $payment->method = 0;
                        $payment->concept = $concept;
                        $payment->number = $invoice->number.'- P'.rand(1, 1000);
                        $payment->comments = 'importado';
                        $payment->save();
                        $invoice->pagos[] = $payment;
                    }
                    array_push($invoices, $invoice);
                } else {
                    array_push($not_found_contado, $csv_data[$i]);
                }
            }
        }
        //sin fecha, enero
        for ($i = 763; $i < 801; ++$i) {
            $name = $csv_data[$i][3];
            if (!empty($name)) {
                $patientss = Patient::where('full_name', $name)->get();
                if (1 == count($patientss)) {
                    $invoice = new Invoice();
                    $invoice->person = $patientss[0];
                    $invoice->series = $csv_data[$i][0];
                    $invoice->number = $csv_data[$i][1];
                    $invoice->code = 'PENDING'.$csv_data[$i][1];
                    $invoice->concept = $csv_data[$i][2];
                    $invoice->currency = 'USD';
                    $invoice->comments = 'Importada, sin fecha, tipo de cambio, ENERO';
                    $invoice->status = 3;
                    $invoice->type = 1;
                    $invoice->patient_id = $patientss[0]->id;
                    $invoice->date = Carbon::createFromFormat('d/m/Y', '02/01/2020');
                    $rate = DB::table('rates')->select('value')->where('date', $invoice->date)->first();
                    $invoice->exchange_rate = $rate->value;
                    if (!empty($csv_data[$i][5])) { //total in thousands
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][4].$csv_data[$i][5]);
                    } else {
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][4]);
                    }
                    $invoice->amount_due = (float) str_replace(',', '', $invoice->total_with_discounts);
                    $invoice->save();
                    //payment
                    $validatePayment = new VerifyPaymentAmount((float) str_replace(',', '', $invoice->total_with_discounts), $invoice->id);
                    $concept = $validatePayment->verifyPayment();
                    if ($concept < 2) {
                        $payment = new Payment();
                        $payment->invoice_id = $invoice->id;
                        $payment->date = $invoice->date;
                        $payment->amount_paid = (float) str_replace(',', '', $invoice->total_with_discounts);
                        $payment->exchange_rate = (float) str_replace(',', '', $invoice->exchange_rate);
                        $payment->method = 0;
                        $payment->concept = $concept;
                        $payment->number = $invoice->number.'- P'.rand(1, 1000);
                        $payment->comments = 'importado, sin fecha / tipo de cambio';
                        $payment->save();
                        $invoice->pagos[] = $payment;
                    }

                    array_push($invoices, $invoice);
                } else {
                    array_push($not_found_contado_e, $csv_data[$i]);
                }
            }
        }
        //sin fecha, FEBRERO
        for ($i = 801; $i < 821; ++$i) {
            $name = $csv_data[$i][2];
            if (!empty($name)) {
                $patientss = Patient::where('full_name', $name)->get();
                if (1 == count($patientss)) {
                    $invoice = new Invoice();
                    $invoice->person = $patientss[0];
                    $invoice->series = 'D';
                    $invoice->number = $csv_data[$i][0];
                    $invoice->code = 'PENDING'.$csv_data[$i][0];
                    $invoice->concept = $csv_data[$i][1];
                    $invoice->currency = 'USD';
                    $invoice->comments = 'Importada, sin fecha, tipo de cambio, FEBRERO';
                    $invoice->status = 3;
                    $invoice->type = 1;
                    $invoice->patient_id = $patientss[0]->id;
                    $invoice->date = Carbon::createFromFormat('d/m/Y', '04/02/2020');
                    $rate = DB::table('rates')->select('value')->where('date', $invoice->date)->first();
                    $invoice->exchange_rate = $rate->value;
                    if (!empty($csv_data[$i][4])) { //total in thousands
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][3].$csv_data[$i][4]);
                    } else {
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][3]);
                    }
                    $invoice->amount_due = (float) str_replace(',', '', $invoice->total_with_discounts);
                    $invoice->save();
                    //payment
                    $validatePayment = new VerifyPaymentAmount((float) str_replace(',', '', $invoice->total_with_discounts), $invoice->id);
                    $concept = $validatePayment->verifyPayment();
                    if ($concept < 2) {
                        $payment = new Payment();
                        $payment->invoice_id = $invoice->id;
                        $payment->date = $invoice->date;
                        $payment->amount_paid = (float) str_replace(',', '', $invoice->total_with_discounts);
                        $payment->exchange_rate = (float) str_replace(',', '', $invoice->exchange_rate);
                        $payment->method = 0;
                        $payment->concept = $concept;
                        $payment->number = $invoice->number.'- P'.rand(1, 1000);
                        $payment->comments = 'importado, sin fecha / tipo de cambio';
                        $payment->save();
                        $invoice->pagos[] = $payment;
                    }
                    array_push($invoices, $invoice);
                } else {
                    array_push($not_found_contado_f, $csv_data[$i]);
                }
            }
        }
        for ($i = 821; $i < 841; ++$i) {
            $name = $csv_data[$i][4];
            if (!empty($name)) {
                $patientss = Patient::where('full_name', $name)->get();
                if (1 == count($patientss)) {
                    $invoice = new Invoice();
                    $invoice->person = $patientss[0];
                    $invoice->series = $csv_data[$i][1];
                    $invoice->number = $csv_data[$i][2];
                    $invoice->code = 'PENDING'.$csv_data[$i][2];
                    $invoice->concept = $csv_data[$i][3];
                    $invoice->currency = 'USD';
                    $invoice->comments = 'Importada';
                    $invoice->status = 3;
                    $invoice->type = 1;
                    $invoice->patient_id = $patientss[0]->id;
                    $invoice->date = Carbon::createFromFormat('d/m/Y', $csv_data[$i][0]);
                    $rate = DB::table('rates')->select('value')->where('date', $invoice->date)->first();
                    $invoice->exchange_rate = $rate->value;

                    if (!empty($csv_data[$i][6])) { //total in thousands
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][5].$csv_data[$i][6]);
                    } else {
                        $invoice->total_with_discounts = (float) str_replace(',', '', $csv_data[$i][5]);
                    }
                    $invoice->amount_due = (float) str_replace(',', '', $invoice->total_with_discounts);
                    $invoice->save();
                    //payment
                    $validatePayment = new VerifyPaymentAmount((float) str_replace(',', '', $invoice->total_with_discounts), $invoice->id);
                    $concept = $validatePayment->verifyPayment();
                    if ($concept < 2) {
                        $payment = new Payment();
                        $payment->invoice_id = $invoice->id;
                        $payment->date = $invoice->date;
                        $payment->amount_paid = (float) str_replace(',', '', $invoice->total_with_discounts);
                        $payment->exchange_rate = (float) str_replace(',', '', $invoice->exchange_rate);
                        $payment->method = 0;
                        $payment->concept = $concept;
                        $payment->number = $invoice->number.'- P'.rand(1, 1000);
                        $payment->comments = 'importado';
                        $payment->save();
                        $invoice->pagos[] = $payment;
                    }
                } else {
                    array_push($not_found_contado_m, $csv_data[$i]);
                }
            }
        }
        /* $patients = [];
        $names = array_unique($all_names);
        $not_found = [];
        foreach ($names as $name) {
            $patientss = Patient::where('full_name', $name)->get();
            if (1 == count($patientss)) {
                array_push($patients, $patientss[0]);
            } else {
                array_push($not_found, $name)H;
            }
            if (!is_null($patient)) {
                //array_push($patient_names, $patient->full_name);
                array_push($patients, $patient);
            } else {
                array_push($not_found, $name)H;
            }
        } */
        //$not_found = array_diff_assoc($names, $patient_names);
        /* $all_names = [];
        for ($i = 0; $i < 685; ++$i) {
            $name = $csv_data[$i][4];
            if (!empty($name)) {
                array_push($all_names, $name);
            }
        }
        $names = array_unique($all_names);
        //array_push($names, $csv_data[1][4]);
        //credito
        for ($i = 0; $i < 685; ++$i) {
            $name = $csv_data[$i][0];
            array_push($names, $name);
        }
        //contado, con fecha
        for ($i = 686; $i < 765; ++$i) {
            $name = $csv_data[$i][4];
            array_push($names, $name);
        }
        //contado, sin fecha
        for ($i = 765; $i < 823; ++$i) {
            $name = $csv_data[$i][3];
            array_push($names, $name);
        }
        //contado, con fecha de nuevo
        for ($i = 823; $i < 842; ++$i) {
            $name = $csv_data[$i][4];
            array_push($names, $name);
        } */

        $count = count($invoices);
        $count2 = count($not_found_credito);

        return view('import.fieldsInvoices', compact('invoices', 'count', 'not_found_credito', 'count2', 'not_found_contado', 'not_found_contado_e', 'not_found_contado_f', 'not_found_contado_m'));
    }

    private function gender($gender)
    {
        if ('M' == $gender) {
            return 0;
        }

        return 1;
    }
}
