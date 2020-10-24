<?php

namespace App\Actions;

use App\Insuree;
use App\Invoice;
use FormFiller\PDF\Converter\Converter;
use FormFiller\PDF\Field;
use FormFiller\PDF\PDFGenerator;
use Illuminate\Support\Facades\Storage;

class FillDentalFormPDF
{
    private $coordinates = '';

    private $invoice;
    private $data;
    private $invoice_data;
    private $service_slots = [];

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->addDiagnosisSlots(count($invoice->diagnoses));
    }

    public function fill($output)
    {
        $this->getInvoiceData();
        $pages = ceil(count($this->invoice->services2) / 10);
        $form = storage_path('app/pdf/dentalForm.pdf');
        for ($i = 0; $i < $pages; ++$i) {
            $services = $this->invoice->services2->slice($i * 10, 10)->values();
            $this->fillPage($form, $services, $i);
        }
        $merge = new MergePDFs($pages);
        $merge->merge($this->invoice->code, $output);
    }

    public function saveFill()
    {
        $this->getInvoiceData();
        $pages = ceil(count($this->invoice->services2) / 10);
        $directory = 'pdf/patients/'.$this->invoice->patient_id.'/invoices/';

        Storage::put($directory.$this->invoice->code.'DentalForm.pdf', '');

        $form = storage_path('app/pdf/dentalForm.pdf');
        for ($i = 0; $i < $pages; ++$i) {
            $services = $this->invoice->services2->slice($i * 10, 10)->values();
            $this->fillPage($form, $services, $i);
        }
        $merge = new MergePDFs($pages);
        $merge->saveMerge('app/'.$directory.$this->invoice->code.'DentalForm.pdf');
    }

    public function addServices($services)
    {
        $services_list = [];
        $alphabet = range('A', 'Z');
        $total = 0;
        for ($i = 0; $i < count($services); ++$i) {
            $total += $services[$i]->total_discounted_price;
            $service = explode(' ', $services[$i]->code);
            $code = '';
            $modifier = '';
            if (count($service) > 1) {
                $modifier = $service[0];
                $code = $service[1];
            } else {
                $code = $service[0];
            }
            $services[$i]->pointers_alphabet = $this->realPointers($services[$i]->diagnoses_pointers, $alphabet);
            $services_list['S'.($i + 1).'_FROM_MM'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->DOS->format('m'),
            ];
            $services_list['S'.($i + 1).'_FROM_DD'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->DOS->format('d'),
            ];
            $services_list['S'.($i + 1).'_FROM_YY'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->DOS->format('y'),
            ];
            $services_list['S'.($i + 1).'_TO_MM'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->DOS_to->format('m'),
            ];
            $services_list['S'.($i + 1).'_TO_DD'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->DOS_to->format('d'),
            ];
            $services_list['S'.($i + 1).'_TO_YY'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->DOS_to->format('y'),
            ];
            $services_list['S'.($i + 1).'_PLACE'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => '11',
            ];
            $services_list['S'.($i + 1).'_EMG'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => 'N',
            ];
            $services_list['S'.($i + 1).'_CODE'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $code,
            ];
            $services_list['S'.($i + 1).'_NAME'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $modifier,
            ];
            $services_list['S'.($i + 1).'_POINTERS'] = [
                'size' => 7,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->pointers_alphabet,
            ];
            $services_list['S'.($i + 1).'_TOTAL'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => number_format($services[$i]->total_discounted_price, 2),
            ];
            $services_list['S'.($i + 1).'_UNITS'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->quantity,
            ];
        }

        $total_services = ['INVOICE_TOTAL' => [
            'size' => 9,
            'family' => 'Arial',
            'style' => 'B',
            'value' => number_format($total, 2),
        ]];

        return $services_list + $total_services;
    }

    private function fillPage($form, $services, $page)
    {
        $data = $this->invoice_data;
        $coordinates = $this->addServicesSlots(count($services));

        $data = $data + $this->addServices($services);

        $converter = new Converter($coordinates);
        $converter->loadPagesWithFieldsCount();
        $coords = $converter->formatFieldsAsJSON();
        $fields = json_decode($coords, true);
        $fieldEntities = [];

        foreach ($fields as $field) {
            $fieldEntities[] = Field::fieldFromArray($field);
        }

        $path = 'app/pdf/invoice/newForm'.$page.'.pdf';
        Storage::put($path, '');
        $newForm = storage_path($path);
        $pdfGenerator = new PDFGenerator($fieldEntities, $data, 'P', 'pt', 'A4');

        try {
            $pdfGenerator->start($form, $newForm);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function realPointers($diagnosis_pointers, $alphabet)
    {
        $pointers = explode(',', $diagnosis_pointers);
        $new_pointers = '';
        $count = count($pointers);
        if ($count < 5) {
            for ($i = 0; $i < $count; ++$i) {
                $new_pointers = $new_pointers.$alphabet[$pointers[$i] - 1].',';
            }
        } else {
            return $alphabet[$pointers[0] - 1].'-'.$alphabet[$pointers[$count - 1] - 1];
        }

        return substr($new_pointers, 0, -1);
    }

    private function addDiagnosisSlots($diagnoses_count)
    {
        for ($i = 0; $i < $diagnoses_count; ++$i) {
            $this->coordinates = $this->coordinates.$this->diagnosis_slots[$i];
        }
    }

    private function addServicesSlots($services_count)
    {
        $coordinates = $this->coordinates;
        for ($i = 0; $i < $services_count; ++$i) {
            $coordinates = $coordinates.$this->service_slots[$i];
        }

        return $coordinates;
    }

    private function getInvoiceData()
    {
        //return
        $this->invoice_data = [
            'DENTIST_SIGNATURE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->doctor,
            ], /*
            'INVOICE_TOTAL' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => number_format($this->invoice->total_with_discounts, 2),
            ], */
            'Patient_DOB' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->birth_date->format('m/d/y'),
            ],
            'Patient_Name' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->name(),
            ],
            'Patient_Address' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->address(),
            ],
            'Patient_City_State_Zip' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->addressDetails(),
            ],
            'Patient_F' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (1 == $this->invoice->patient->gender) ? 'X' : '',
            ],
            'Patient_M' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (1 == $this->invoice->patient->gender) ? '' : 'X',
            ],
            'Patient_U' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => '',
            ],
        ];
        if ($this->invoice->patient->insured) {
            $insured = $this->invoice->patient->insuree;

            //add insured data
            $insured_data = [
                'Insurance_ID' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurance_id,
                ],
                'Patient_Insurance' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurance_id,
                ],
                'Insurer_Policy_Number' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->group_number,
                ],
                'Insurer_DOB' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->birth_date->format('m/d/y'),
                ],
                'Insurer_Name' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->name(),
                ],
                'Insurer_City_State_Zip' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->addressDetails(),
                ],
                'Insurer_Address' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->address(),
                ],
                'Self' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => 'X',
                ],
                'Dependent Child' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
                'Spouse' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
                'Other' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
                'Insurer_F' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $this->invoice->patient->gender) ? 'X' : '',
                ],
                'Insurer_M' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $this->invoice->patient->gender) ? '' : 'X',
                ],
                'Insurer_U' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
            ];

            $insurance_data = [
                'Company_Name' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurer->name,
                ],
                'Company_Address' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurer->address,
                ],
                'Company_City_State_Zip' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurer->addressDetails(),
                ],
            ];

            $this->invoice_data = $this->invoice_data + $insured_data + $insurance_data;
        } else {
            $insured = Insuree::where('patient_id', $this->invoice->patient->dependent->insuree_id)->first();
            $insured_data = [
                'Insurance_ID' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurance_id,
                ],
                'Patient_]Insurance' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurance_id,
                ],
                'Insurer_Policy_Number' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->group_number,
                ],
                'Insurer_DOB' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->birth_date->format('m/d/y'),
                ],
                'Insurer_Name' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->name(),
                ],
                'Insurer_City_State_Zip' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->addressDetails(),
                ],
                'Insurer_Address' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->address(),
                ],
                'Self' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
                'Dependent Child' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'Spouse' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (2 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'Other' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (0 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'Insurer_F' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $insured->patient->gender) ? 'X' : '',
                ],
                'Insurer_M' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $insured->patient->gender) ? '' : 'X',
                ],
                'Insurer_U' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
            ];
            $insurance_data = [
                'Company_Name' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurer->name,
                ],
                'Company_Address' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurer->address,
                ],
                'Company_City_State_Zip' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurer->cityZIP(),
                ],
                'INSURANCE_PHONE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurer->phone_number,
                ],
            ];
            $this->invoice_data = $this->invoice_data + $insured_data + $insurance_data;
        }

        $diagnosis_list = [];

        for ($i = 1; $i <= count($this->invoice->diagnoses); ++$i) {
            $diagnosis_list['Diagnosis_'.$i] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
            ];

            /* if (0 == $i) {
                $diagnosis_list['DA'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (1 == $i) {
                $diagnosis_list['DB'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (2 == $i) {
                $diagnosis_list['DC'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (3 == $i) {
                $diagnosis_list['DD'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (4 == $i) {
                $diagnosis_list['DE'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (5 == $i) {
                $diagnosis_list['DF'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (6 == $i) {
                $diagnosis_list['DG'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (7 == $i) {
                $diagnosis_list['DH'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (8 == $i) {
                $diagnosis_list['DI'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (9 == $i) {
                $diagnosis_list['DJ'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (10 == $i) {
                $diagnosis_list['DK'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (11 == $i) {
                $diagnosis_list['DL'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } */
        }

        $this->invoice_data = $this->invoice_data + $diagnosis_list;
        //add data
    }
}