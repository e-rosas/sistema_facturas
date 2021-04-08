<?php

namespace App\Actions;

use App\Insuree;
use App\Invoice;
use FormFiller\PDF\Converter\Converter;
use FormFiller\PDF\Field;
use App\Actions\PDFGeneratorLocal;
use Illuminate\Support\Facades\Storage;

class FillHospitalizationFormPDF
{
    private $coordinates = '96 widget annotations found on page 1.
    ----------------------------------------------
    
    BILL_TYPE: 
     llx: 566.209
     lly: 756.05
     urx: 600.447
     ury: 767.178
   width: 34.238
  height: 11.128


INVOICE_CODE: 
     llx: 393.736
     lly: 768.034
     urx: 457.076
     ury: 777.449
   width: 63.34
  height: 9.415


INVOICE_FROM_DATE: 
     llx: 444.236
     lly: 732.084
     urx: 492.169
     ury: 741.499
   width: 47.933
  height: 9.415


INVOICE_TO_DATE: 
     llx: 495.165
     lly: 732.084
     urx: 542.67
     ury: 741.499
   width: 47.505
  height: 9.415


PATIENT_NAME: 
     llx: 19.6868
     lly: 707.689
     urx: 224.686
     ury: 718.389
   width: 204.9992
  height: 10.7


PATIENT_ADDRESS: 
     llx: 236.669
     lly: 708.117
     urx: 462.639
     ury: 717.961
   width: 225.97
  height: 9.844


PATIENT_BIRTHDATE: 
     llx: 11.9833
     lly: 684.579
     urx: 74.0394
     ury: 693.994
   width: 62.0561
  height: 9.415


PATIENT_SEX: 
     llx: 76.6073
     lly: 684.151
     urx: 95.4381
     ury: 694.422
   width: 18.8308
  height: 10.271


ADMISSION_DATE: 
     llx: 98.0059
     lly: 684.151
     urx: 137.807
     ury: 693.138
   width: 39.8011
  height: 8.987


PATIENT_NAME_2: 
     llx: 14.5511
     lly: 626.374
     urx: 311.565
     ury: 638.786
   width: 297.0139
  height: 12.412


PATIENT_ADDRESS_1: 
     llx: 14.9791
     lly: 610.539
     urx: 311.993
     ury: 622.523
   width: 297.0139
  height: 11.984


PATIENT_ADDRESS_2: 
     llx: 14.5511
     lly: 594.704
     urx: 311.565
     ury: 605.832
   width: 297.0139
  height: 11.128
    
    
  INVOICE_TOTAL: 
  llx: 442.525
  lly: 300.686
  urx: 511
  ury: 310.102
width: 68.475
height: 9.416


INSURANCE_ADDRESS_1: 
  llx: 12.8392
  lly: 275.864
  urx: 174.185
  ury: 286.135
width: 161.3458
height: 10.271


INSURANCE_ADDRESS_2: 
  llx: 13.2672
  lly: 264.309
  urx: 174.185
  ury: 274.58
width: 160.9178
height: 10.271


INSURANCE_ADDRESS_3: 
  llx: 14.5511
  lly: 251.898
  urx: 174.185
  ury: 261.313
width: 159.6339
height: 9.415


INSURER_ID: 
  llx: 178.037
  lly: 264.309
  urx: 283.318
  ury: 274.152
width: 105.281
height: 9.843


INVOICE_TOTAL_1: 
  llx: 393.736
  lly: 264.737
  urx: 469.915
  ury: 274.58
width: 76.179
height: 9.843


INSURED_NAME: 
  llx: 12.8392
  lly: 227.931
  urx: 196.012
  ury: 237.774
width: 183.1728
height: 9.843


INSURED_ADDRESS_1: 
  llx: 13.6951
  lly: 216.376
  urx: 195.584
  ury: 225.363
width: 181.8889
height: 8.987


INSURED_ADDRESS_2: 
  llx: 12.6546
  lly: 203.999
  urx: 195.928
  ury: 213.599
width: 183.2734
height: 9.6


INSURER_ID2: 
  llx: 220.8
  lly: 215.781
  urx: 361.746
  ury: 226.472
width: 140.946
height: 10.691


GROUP_NAME: 
  llx: 365.237
  lly: 215.781
  urx: 469.746
  ury: 226.254
width: 104.509
height: 10.473


GROUP_NUMBER: 
  llx: 473.673
  lly: 215.781
  urx: 599.564
  ury: 226.472
width: 125.891
height: 10.691';

      private $doctor_slots = ['
      DOCTOR_LAST_NAME1: 
     llx: 389.456
     lly: 95.6872
     urx: 499.445
     ury: 105.959
   width: 109.989
  height: 10.2718


DOCTOR_FIRST_NAME1: 
     llx: 517.848
     lly: 96.5432
     urx: 600.447
     ury: 105.103
   width: 82.599
  height: 8.5598',
   '


   DOCTOR_LAST_NAME2: 
     llx: 389.028
     lly: 71.7207
     urx: 499.017
     ury: 81.9921
   width: 109.989
  height: 10.2714


DOCTOR_FIRST_NAME2: 
     llx: 517.42
     lly: 72.5767
     urx: 600.019
     ury: 81.1361
   width: 82.599
  height: 8.5594',
     '


DOCTOR_LAST_NAME3: 
     llx: 388.386
     lly: 47.7542
     urx: 498.375
     ury: 58.0255
   width: 109.989
  height: 10.2713


DOCTOR_FIRST_NAME3: 
     llx: 516.778
     lly: 48.6101
     urx: 599.377
     ury: 57.1696
   width: 82.599
  height: 8.5595',
       '


DOCTOR_LAST_NAME4: 
     llx: 387.958
     lly: 23.7877
     urx: 497.947
     ury: 34.0591
   width: 109.989
  height: 10.2714


DOCTOR_FIRST_NAME4: 
     llx: 516.35
     lly: 24.6436
     urx: 598.949
     ury: 33.2031
   width: 82.599
  height: 8.5595

      '];

    private $procedure_slots = ['


    PCODE1: 
    llx: 12.4112
    lly: 96.5432
    urx: 66.7639
    ury: 105.531
  width: 54.3527
 height: 8.9878


PDATE1: 
    llx: 70.6156
    lly: 96.1152
    urx: 117.693
    ury: 105.531
  width: 47.0774
 height: 9.4158
    ',
  '


  PCODE2: 
     llx: 120.903
     lly: 96.5432
     urx: 175.255
     ury: 105.531
   width: 54.352
  height: 8.9878


PDATE2: 
     llx: 179.107
     lly: 96.1152
     urx: 226.184
     ury: 105.531
   width: 47.077
  height: 9.4158
  ',
'


PCODE3: 
     llx: 228.489
     lly: 96.3782
     urx: 282.841
     ury: 105.366
   width: 54.352
  height: 8.9878


PDATE3: 
     llx: 286.693
     lly: 95.9503
     urx: 333.77
     ury: 105.366
   width: 47.077
  height: 9.4157

', '


PCODE4: 
     llx: 12.8637
     lly: 73.0871
     urx: 67.2163
     ury: 82.0745
   width: 54.3526
  height: 8.9874


PDATE4: 
     llx: 71.0681
     lly: 72.6591
     urx: 118.145
     ury: 82.0745
   width: 47.0769
  height: 9.4154
', '


PCODE5: 
     llx: 121.355
     lly: 73.0871
     urx: 175.708
     ury: 82.0745
   width: 54.353
  height: 8.9874


PDATE5: 
     llx: 179.559
     lly: 72.6591
     urx: 226.636
     ury: 82.0745
   width: 47.077
  height: 9.4154
',
'

PCODE6: 
     llx: 228.941
     lly: 72.9222
     urx: 283.294
     ury: 81.9096
   width: 54.353
  height: 8.9874


PDATE6: 
     llx: 287.146
     lly: 72.4942
     urx: 334.223
     ury: 81.9096
   width: 47.077
  height: 9.4154'];

    private $invoice;
    private $data;
    private $invoice_data;
    private $diagnosis_slots = ['
    
    
    R1: 
     llx: 39.8015
     lly: 119.654
     urx: 89.4465
     ury: 130.353
   width: 49.645
  height: 10.699
','

  R2: 
    llx: 127.536
    lly: 120.082
    urx: 175.041
    ury: 130.781
  width: 47.505
  height: 10.699
',
'

R3: 
     llx: 178.037
     lly: 120.082
     urx: 225.542
     ury: 129.925
   width: 47.505
  height: 9.843',
'

R4: 
     llx: 228.966
     lly: 119.654
     urx: 276.471
     ury: 130.781
   width: 47.505
  height: 11.127',];
    private $service_slots = [
'
S_CODE1: 
llx: 12.4112
lly: 563.462
urx: 42.7973
ury: 574.162
width: 30.3861
height: 10.7


S_NAME1: 
llx: 45.7932
lly: 563.89
urx: 222.546
ury: 574.162
width: 176.7528
height: 10.272


S_DATE1: 
llx: 332.963
lly: 564.318
urx: 380.896
ury: 574.59
width: 47.933
height: 10.272


S_UNITS1: 
llx: 383.892
lly: 564.318
urx: 438.673
ury: 574.162
width: 54.781
height: 9.844


S_TOTAL1: 
llx: 441.669
lly: 564.318
urx: 509.288
ury: 574.162
width: 67.619
height: 9.844
',
'
S_CODE2: 
llx: 12.4112
lly: 551.051
urx: 42.7974
ury: 561.75
width: 30.3862
height: 10.699


S_NAME2: 
llx: 45.7932
lly: 551.479
urx: 222.546
ury: 561.75
width: 176.7528
height: 10.271


S_DATE2: 
llx: 332.963
lly: 551.907
urx: 380.896
ury: 562.178
width: 47.933
height: 10.271


S_UNITS2: 
llx: 383.892
lly: 551.907
urx: 438.673
ury: 561.75
width: 54.781
height: 9.843


S_TOTAL2: 
llx: 441.669
lly: 551.907
urx: 509.288
ury: 561.75
width: 67.619
height: 9.843
    
    
    ',
'
S_CODE3: 
llx: 12.0703
lly: 539.182
urx: 42.4565
ury: 549.881
width: 30.3862
height: 10.699


S_NAME3: 
llx: 45.4523
lly: 539.61
urx: 222.205
ury: 549.881
width: 176.7527
height: 10.271


S_DATE3: 
llx: 332.622
lly: 540.038
urx: 380.556
ury: 550.309
width: 47.934
height: 10.271


S_UNITS3: 
llx: 383.551
lly: 540.038
urx: 438.332
ury: 549.881
width: 54.781
height: 9.843


S_TOTAL3: 
llx: 441.328
lly: 540.038
urx: 508.948
ury: 549.881
width: 67.62
height: 9.843
    
    
    ',
'
S_CODE4: 
llx: 12.5018
lly: 526.81
urx: 42.888
ury: 537.51
width: 30.3862
height: 10.7


S_NAME4: 
llx: 45.8838
lly: 527.238
urx: 222.637
ury: 537.51
width: 176.7532
height: 10.272


S_DATE4: 
llx: 333.054
lly: 527.666
urx: 380.987
ury: 537.938
width: 47.933
height: 10.272


S_UNITS4: 
llx: 383.983
lly: 527.666
urx: 438.763
ury: 537.51
width: 54.78
height: 9.8439999999999


S_TOTAL4: 
llx: 441.759
lly: 527.666
urx: 509.379
ury: 537.51
width: 67.62
height: 9.8439999999999
    
    
    ',
'
S_CODE5: 
llx: 12.5018
lly: 514.399
urx: 42.888
ury: 525.098
width: 30.3862
height: 10.699


S_NAME5: 
llx: 45.8838
lly: 514.827
urx: 222.637
ury: 525.098
width: 176.7532
height: 10.271


S_DATE5: 
llx: 333.054
lly: 515.255
urx: 380.987
ury: 525.526
width: 47.933
height: 10.271


S_UNITS5: 
llx: 383.983
lly: 515.255
urx: 438.763
ury: 525.098
width: 54.78
height: 9.843


S_TOTAL5: 
llx: 441.759
lly: 515.255
urx: 509.379
ury: 525.098
width: 67.62
height: 9.843
    
    
    ',
'
S_CODE6: 
llx: 12.1609
lly: 502.53
urx: 42.5471
ury: 513.229
width: 30.3862
height: 10.699


S_NAME6: 
llx: 45.5429
lly: 502.958
urx: 222.296
ury: 513.229
width: 176.7531
height: 10.271


S_DATE6: 
llx: 332.713
lly: 503.386
urx: 380.646
ury: 513.657
width: 47.933
height: 10.271


S_UNITS6: 
llx: 383.642
lly: 503.386
urx: 438.423
ury: 513.229
width: 54.781
height: 9.843


S_TOTAL6: 
llx: 441.418
lly: 503.386
urx: 509.038
ury: 513.229
width: 67.62
height: 9.843
    
    
    ',
];
    private $extra_diagnosis_slots = [
'

P1: 
         llx: 20.9415
         lly: 144.048
         urx: 75.3233
         ury: 153.464
       width: 52.8871
      height: 10.473',
'

P2: 
         llx: 78.0176
         lly: 143.62
     urx: 132.244
     ury: 153.464
       width: 54.4584
      height: 9.95',
'

P3: 
         llx: 135.051
         lly: 144.262
     urx: 189.391
     ury: 153.678
       width: 54.982
      height: 10.255
    ',
'

P4: 
         llx: 194.069
         lly: 143.834
     urx: 246.311
     ury: 153.678
       width: 52.887
      height: 10.473
    ',
'

P5: 
         llx: 251.145
         lly: 143.961
     urx: 305.221
     ury: 153.377
       width: 54.458
      height: 9.9490
    ',
'

P6: 
         llx: 308.178
         lly: 143.533
         urx: 362.141
         ury: 153.377
       width: 54.982
      height: 10.254',
'

P7: 
         llx: 365.851
         lly: 144.325
         urx: 420.057
         ury: 153.74
       width: 52.887
      height: 10.473',
'

P8: 
         llx: 422.927
         lly: 143.897
     urx: 476.978
     ury: 153.74
       width: 54.458
      height: 9.95',
'

P9: 
         llx: 479.96
         lly: 143.824
     urx: 536.299
     ury: 153.668
       width: 54.982
      height: 10.255',
'

P10: 
         llx: 20.0869
         lly: 132.048
     urx: 75.0841
     ury: 141.464
       width: 52.8872
      height: 10.473',
'

 P11: 
         llx: 77.1631
         lly: 131.62
     urx: 132.005
     ury: 141.464
       width: 54.4579
      height: 9.949',
'

P12: 
         llx: 134.196
         lly: 132.262
     urx: 189.152
     ury: 141.678
       width: 54.982
      height: 10.254',
'

P13: 
         llx: 193.214
         lly: 131.834
     urx: 246.072
     ury: 141.678
       width: 52.888
      height: 10.472',
'

P14: 
         llx: 250.291
         lly: 131.961
         urx: 304.982
         ury: 141.377
       width: 54.458
      height: 9.9490',
'

P15: 
         llx: 307.324
         lly: 131.533
     urx: 361.902
     ury: 141.377
       width: 54.982
      height: 10.255',
'

P16: 
         llx: 364.996
         lly: 132.325
     urx: 419.818
     ury: 141.74
       width: 52.888
      height: 10.473',
'

P17: 
         llx: 422.073
         lly: 131.897
         urx: 476.738
         ury: 141.74
       width: 54.458
      height: 9.9490',
'

P18: 
         llx: 479.106
         lly: 131.824
         urx: 536.06
         ury: 141.668
       width: 54.982
      height: 10.255',
];

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->addDiagnosisSlots(count($invoice->diagnoses));
    }

    public function fill($output)
    {
        $this->getInvoiceData();
        $pages = 1;
        $form = storage_path('app/pdf/hospitalizationForm.pdf');
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
        $pages = 1;
        $directory = 'pdf/patients/'.$this->invoice->patient_id.'/invoices/';

        Storage::put($directory.$this->invoice->code.'HospitalizationForm.pdf', '');

        $form = storage_path('app/pdf/hospitalizationForm.pdf');
        for ($i = 0; $i < $pages; ++$i) {
            $services = $this->invoice->services2->slice($i * 10, 10)->values();
            $this->fillPage($form, $services, $i);
        }
        $merge = new MergePDFs($pages);
        $merge->saveMerge('app/'.$directory.$this->invoice->code.'HospitalizationForm.pdf');
    }

    public function addServices($services)
    {
        $services_list = [];
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
            $services_list['S_DATE'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->DOS->format('m/d/y'),
            ];
            $services_list['S_CODE'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $code,
            ];
            $services_list['S_NAME'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->shortDescription(),
            ];
            $services_list['S_TOTAL'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => '$ '. number_format($services[$i]->total_discounted_price, 2),
            ];
            $services_list['S_UNITS'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->quantity,
            ];
        }

        $total_services = ['INVOICE_TOTAL_1' => [
            'size' => 8,
            'family' => 'Arial',
            'style' => '',
            'value' => '$ '. number_format($total, 2),
        ]];

        $total_services = $total_services + ['INVOICE_TOTAL' => [
          'size' => 8,
          'family' => 'Arial',
          'style' => '',
          'value' => '$ '. number_format($total, 2),
      ]];


        return $services_list + $total_services;
    }

    private function addDoctors($doctors) {
      $doctors_list = [];
      for ($i=0; $i < count($doctors); $i++) { 
        $full_name = explode(',', $doctors[$i]);
        $name = '';
        $last_name = '';
        if (count($full_name) > 1) {
            $name = $full_name[0];
            $last_name = $full_name[1];
        } else {
          $name = $full_name[0];
        }

        $doctors_list['DOCTOR_LAST_NAME'.($i + 1)] = [
            'size' => 8,
            'family' => 'Arial',
            'style' => '',
            'value' => $name,
        ];
        $doctors_list['DOCTOR_FIRST_NAME'.($i + 1)] = [
            'size' => 8,
            'family' => 'Arial',
            'style' => '',
            'value' => $last_name,
        ];
        
      }
      return $doctors_list;
    }

    private function addProcedures($procedures) {
      $procedures_list = [];
      for ($i=0; $i < count($procedures); $i++) { 
        $procedure = explode('-', $procedures[$i]);
        $code = '';
        $date = '';
        if (count($procedure) > 1) {
            $code = $procedure[0];
            $date = $procedure[1];
        } else {
          $code = $procedure[0];
        }

        $proceduress_list['PCODE'.($i + 1)] = [
            'size' => 8,
            'family' => 'Arial',
            'style' => '',
            'value' => $code,
        ];
        $proceduress_list['PDATE'.($i + 1)] = [
            'size' => 8,
            'family' => 'Arial',
            'style' => '',
            'value' => $date,
        ];
        
      }
      return $proceduress_list;
    }

    private function fillPage($form, $services, $page)
    {
        $data = $this->invoice_data;

        $doctors = explode('{', $this->invoice->doctor);

          
	
        $coordinates = $this->addServicesSlots(count($services)) . $this->addDoctorSlots($doctors);

        

        if($this->invoice->hospitalization_details->breakdown){
          $d_codes = explode(",", $this->invoice->hospitalization_details->diagnosis_codes);
          $coordinates = $coordinates . $this->addProcedureSlots($d_codes);
          $data = $data + $this->addProcedures($d_codes);
        }

        
	
        $data = $data + $this->addServices($services) + $this->addDoctors($doctors);

        


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
        $pdfGenerator = new PDFGeneratorLocal($fieldEntities, $data, 'P', 'pt', 'letter');
        
        try {
            $pdfGenerator->start($form, $newForm);
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    private function addDiagnosisSlots($diagnoses_count)
    {
        for ($i = 0; $i < $diagnoses_count && $i < 4; ++$i) {
            $this->coordinates = $this->coordinates.$this->diagnosis_slots[$i];
        }
        if($diagnoses_count > 4){
          for ($i = 4; $i < $diagnoses_count; ++$i) {
            $this->coordinates = $this->coordinates.$this->extra_diagnosis_slots[$i];
          }
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

    private function addDoctorSlots($doctors)
    {
      $coordinates = '';
        for ($i = 0; $i < count($doctors); ++$i) {
          $coordinates = $coordinates.$this->doctor_slots[$i];
        }

      return $coordinates;
    }

    private function addProcedureSlots($procedures)
    {
      $coordinates = '';
      for ($i = 0; $i < count($procedures); ++$i) {
        $coordinates = $coordinates.$this->procedure_slots[$i];
      }

    return $coordinates;
    }

    private function getInvoiceData()
    {
        //return
        $this->invoice_data = [
            'INVOICE_TOTAL_1' => [
                'size' => 7,
                'family' => 'Arial',
                'style' => '',
                'value' => number_format($this->invoice->total_with_discounts, 2),
            ],
            'INVOICE_CODE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->code,
            ],
            'INVOICE_FROM_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->DOS->format('m/d/y'),
            ],
            'INVOICE_TO_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->services2[0]->DOS_to->format('m/d/y'),
            ],
            'INVOICE_TOTAL' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => number_format($this->invoice->total_with_discounts, 2),
            ],
            'PATIENT_BIRTHDATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->birth_date->format('m/d/y'),
            ],
            'PATIENT_NAME' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->name(),
            ],
            'PATIENT_ADDRESS' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->address(),
            ],
            'PATIENT_ADDRESS_1' => [
              'size' => 9,
              'family' => 'Arial',
              'style' => '',
              'value' => $this->invoice->patient->address(),
          ],
            'PATIENT_ADDRESS_2' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->addressDetails(),
            ],
            'PATIENT_SEX' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (1 == $this->invoice->patient->gender) ? 'F' : 'M',
            ],
            'ADMISSION_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->DOS->format('m/d/y'),
            ],
	          'PATIENT_NAME_2' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->name(),
            ],
            'BILL_TYPE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->hospitalization_details->bill_type),
            ],
        ];

        if ($this->invoice->patient->insured) {
            $insured = $this->invoice->patient->insuree;

            //add insured data
            $insured_data = [
                'INSURER_ID' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'INSURER_ID2' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'GROUP_NUMBER' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->group_number,
                ],
                'Insurer_DOB' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->birth_date->format('m/d/y'),
                ],
                'INSURED_NAME' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->name(),
                ],
                'INSURED_ADDRESS_2' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->addressDetails(),
                ],
                'INSURED_ADDRESS_1' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->address(),
                ],
                'GROUP_NAME' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
            ];

            $insurance_data = [
                'INSURANCE_ADDRESS_1' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->name,
                ],
                'INSURANCE_ADDRESS_2' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->address,
                ],
                'INSURANCE_ADDRESS_3' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->addressDetails(),
                ],
            ];

            $this->invoice_data = $this->invoice_data + $insured_data + $insurance_data;
        } else {
            $insured = Insuree::where('patient_id', $this->invoice->patient->dependent->insuree_id)->first();
            $insured_data = [
                'INSURER_ID' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'INSURER_ID2' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'GROUP_NUMBER' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->group_number,
                ],
                'INSURED_NAME' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->name(),
                ],
                'INSURED_ADDRESS_2' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->addressDetails(),
                ],
                'INSURED_ADDRESS_1' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->address(),
                ],
                'GROUP_NAME' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
            ];
            $insurance_data = [
                'INSURANCE_ADDRESS_1' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->name,
                ],
                'INSURANCE_ADDRESS_2' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->address,
                ],
                'INSURANCE_ADDRESS_3' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->cityZIP(),
                ],
            ];
            $this->invoice_data = $this->invoice_data + $insured_data + $insurance_data;
        }

        $diagnosis_list = [];

        for ($i = 0; $i < count($this->invoice->diagnoses) && $i < 4; ++$i) {
            $diagnosis_list['R'.($i+1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
            ];
        }
        if(count($this->invoice->diagnoses) > 4){

          for ($i = 4; $i < count($this->invoice->diagnoses); ++$i) {
            $diagnosis_list['P'.($i-3)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
            ];
        }

        }

        $this->invoice_data = $this->invoice_data + $diagnosis_list;
        //add data
    }
}
