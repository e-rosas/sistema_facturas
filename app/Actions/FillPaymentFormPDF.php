<?php

namespace App\Actions;

use App\Invoice;
use App\Patient;
use FormFiller\PDF\Converter\Converter;
use FormFiller\PDF\Field;
use FormFiller\PDF\PDFGenerator;
use Illuminate\Support\Facades\Storage;

class FillPaymentFormPDF
{
    private $coordinates = '124 widget annotations found on page 1.
    ----------------------------------------------
    
    INSURED_ID: 
         llx: 373.92
         lly: 675.409
         urx: 587.52
         ury: 685.823
       width: 213.6
      height: 10.414
    
    
    INSURED_NAME: 
         llx: 373.133
         lly: 653.089
         urx: 586.733
         ury: 664.425
       width: 213.6
      height: 11.336
    
    
    PATIENT_ADDRESS: 
         llx: 20.2031
         lly: 625.853
         urx: 222.445
         ury: 636.377
       width: 202.2419
      height: 10.524
    
    
    INSURED_ADDRESS: 
         llx: 373.92
         lly: 627.821
         urx: 587.52
         ury: 639.306
       width: 213.6
      height: 11.485
    
    
    CITY: 
         llx: 20.16
         lly: 602.88
         urx: 191.78
         ury: 613.041
       width: 171.62
      height: 10.161
    
    
    INSURED_CITY: 
         llx: 373.68
         lly: 603.471
         urx: 530.87
         ury: 615.225
       width: 157.19
      height: 11.754
    
    
    OTHER: 
         llx: 334.251
         lly: 673.607
         urx: 347.33
         ury: 685.504
       width: 13.079
      height: 11.897
    
    
    SEXM: 
         llx: 313.582
         lly: 649.591
         urx: 323.905
         ury: 661.095
       width: 10.323
      height: 11.504
    
    
    SEXF: 
         llx: 348.818
         lly: 649.985
         urx: 360.715
         ury: 661.685
       width: 11.897
      height: 11.7
    
    
    PATIENT_NAME: 
         llx: 20.2755
         lly: 650.465
         urx: 222.243
         ury: 662.079
       width: 201.9675
      height: 11.614
    
    
    SELF: 
         llx: 247.834
         lly: 626.363
         urx: 259.141
         ury: 637.473
       width: 11.307
      height: 11.11
    
    
    SPOUSE: 
         llx: 284.842
         lly: 626.363
         urx: 295.361
         ury: 636.882
       width: 10.519
      height: 10.519
    
    
    CHILD: 
         llx: 313.385
         lly: 626.363
         urx: 324.495
         ury: 637.473
       width: 11.11
      height: 11.11
    
    
    R_OTHER: 
         llx: 350.196
         lly: 627.544
         urx: 360.715
         ury: 638.26
       width: 10.519
      height: 10.716
    
    
    STATE: 
         llx: 200.787
         lly: 602.827
         urx: 220.669
         ury: 616.213
       width: 19.882
      height: 13.386
    
    
    INSURED_STATE: 
         llx: 542.518
         lly: 604.008
         urx: 585.037
         ury: 615.82
       width: 42.519
      height: 11.812
    
    
    PATIENT_MM: 
         llx: 227.165
         lly: 650.465
         urx: 250.983
         ury: 659.52
       width: 23.818
      height: 9.0549999999999
    
    
    PATIENT_DD: 
         llx: 255.314
         lly: 650.662
         urx: 274.605
         ury: 658.536
       width: 19.291
      height: 7.8739999999999
    
    
    PATIENT_YY: 
         llx: 277.558
         lly: 650.465
         urx: 304.33
         ury: 659.52
       width: 26.772
      height: 9.0549999999999
    
    
    PATIENT_ZIP: 
         llx: 24.9999
         lly: 577.434
         urx: 77.5588
         ury: 591.016
       width: 52.5589
      height: 13.582
    
    
    PATIENT_PHONE: 
         llx: 121.063
         lly: 577.631
         urx: 220.669
         ury: 588.457
       width: 99.606
      height: 10.826
    
    
    INSURED_ZIP: 
         llx: 372.44
         lly: 579.009
         urx: 459.054
         ury: 590.032
       width: 86.614
      height: 11.023
    
    
    INSURED_PHONE: 
         llx: 479.329
         lly: 580.583
         urx: 583.659
         ury: 590.426
       width: 104.33
      height: 9.8430000000001
    
    
    INSURED_MM: 
         llx: 384.644
         lly: 530.584
         urx: 412.203
         ury: 540.623
       width: 27.559
      height: 10.039
    
    
    INSURED_DD: 
         llx: 414.762
         lly: 530.78
         urx: 432.676
         ury: 540.229
       width: 17.914
      height: 9.4490000000001
    
    
    INSURED_YY: 
         llx: 438.778
         lly: 530.387
         urx: 474.605
         ury: 540.623
       width: 35.827
      height: 10.236
    
    
    INSURED_SEXM: 
         llx: 500.589
         lly: 532.158
         urx: 511.219
         ury: 543.182
       width: 10.63
      height: 11.024
    
    
    INSURED_SEXF: 
         llx: 551.77
         lly: 531.765
         urx: 562.4
         ury: 543.182
       width: 10.63
      height: 11.417
    
    
    PATIENT_DATE: 
         llx: 273.163
         lly: 414.546
         urx: 364.363
         ury: 422.837
       width: 91.2
      height: 8.291
    
    
    INVOICE_NUMBER: 
         llx: 180.655
         lly: 102.327
         urx: 262.909
         ury: 114.108
       width: 82.254
      height: 11.781
    
    
    INVOICE_TOTAL: 
         llx: 385.31
         lly: 102.545
         urx: 431.128
         ury: 111.927
       width: 45.818
      height: 9.382
    
    
    INVOICE_PAID: 
         llx: 465.164
         lly: 102.545
         urx: 502.037
         ury: 114.763
       width: 36.873
      height: 12.218
    
    
    DOCTOR: 
         llx: 24
         lly: 56.2901
         urx: 171.055
         ury: 70.2538
       width: 147.055
      height: 13.9637
    ';

    private $invoice;
    private $data;
    private $diagnosis_slots = [
        '

      DA: 
           llx: 40.551
           lly: 316.214
           urx: 74.2124
           ury: 323.498
         width: 33.6614
        height: 7.284',
        '

        DB: 
             llx: 135.236
             lly: 316.017
             urx: 166.338
             ury: 321.726
           width: 31.102
          height: 5.709',
        '

        DC: 
             llx: 229.527
             lly: 316.411
             urx: 261.22
             ury: 322.12
           width: 31.693
          height: 5.709',
        '

        DD: 
             llx: 327.755
             lly: 315.82
             urx: 354.133
             ury: 321.923
           width: 26.378
          height: 6.103',
        '

        DE: 
             llx: 39.7636
             lly: 305.387
             urx: 74.606
             ury: 311.687
           width: 34.8424
          height: 6.3',
        '

        DF: 
             llx: 134.448
             lly: 304.403
             urx: 166.535
             ury: 310.506
           width: 32.087
          height: 6.103',
        '

        DG: 
             llx: 226.968
             lly: 304.403
             urx: 260.629
             ury: 310.506
           width: 33.661
          height: 6.103',
        '

        DH: 
             llx: 330.117
             lly: 304.6
             urx: 354.133
             ury: 310.112
           width: 24.016
          height: 5.512',
        '

        DI: 
             llx: 41.7321
             lly: 293.183
             urx: 73.425
             ury: 299.876
           width: 31.6929
          height: 6.693',
        '

        DJ: 
             llx: 134.645
             lly: 292.986
             urx: 166.338
             ury: 298.104
           width: 31.693
          height: 5.118',
        '

        DK: 
             llx: 227.165
             lly: 293.38
             urx: 261.416
             ury: 299.482
           width: 34.251
          height: 6.102',
        '

        DL: 
             llx: 329.526
             lly: 293.38
             urx: 353.936
             ury: 299.679
           width: 24.41
          height: 6.299',
    ];
    private $service_slots = [
        '

        S1_FROM_MM: 
             llx: 20.509
             lly: 245.238
             urx: 37.5272
             ury: 256.583
           width: 17.0182
          height: 11.345
        
        
        S1_FROM_DD: 
             llx: 40.5817
             lly: 244.801
             urx: 58.909
             ury: 256.147
           width: 18.3273
          height: 11.346
        
        
        S1_FROM_YY: 
             llx: 61.0908
             lly: 244.801
             urx: 80.7271
             ury: 255.71
           width: 19.6363
          height: 10.909
        
        
        S1_TO_MM: 
             llx: 84.8719
             lly: 244.801
             urx: 101.89
             ury: 256.147
           width: 17.0181
          height: 11.346
        
        
        S1_TO_DD: 
             llx: 104.945
             lly: 244.365
             urx: 123.272
             ury: 255.71
           width: 18.327
          height: 11.345
        
        
        S1_TO_YY: 
             llx: 125.454
             lly: 244.365
             urx: 145.09
             ury: 255.274
           width: 19.636
          height: 10.909
        
        
        S1_PLACE: 
             llx: 148.364
             lly: 244.799
             urx: 168
             ury: 255.709
           width: 19.636
          height: 10.91
        
        
        S1_EMG: 
             llx: 170.618
             lly: 244.799
             urx: 186.546
             ury: 255.927
           width: 15.928
          height: 11.128
        
        
        S1_CODE: 
             llx: 195.709
             lly: 245.454
             urx: 239.346
             ury: 254.836
           width: 43.637
          height: 9.382
        
        
        S1_NAME: 
             llx: 248.509
             lly: 245.236
             urx: 332.509
             ury: 255.927
           width: 84
          height: 10.691
        
        
        S1_POINTERS: 
             llx: 335.346
             lly: 245.236
             urx: 370.037
             ury: 255.927
           width: 34.691
          height: 10.691
        
        
        S1_TOTAL: 
             llx: 375.928
             lly: 245.454
             urx: 433.091
             ury: 255.709
           width: 57.163
          height: 10.255',
        '

        S2_FROM_MM: 
             llx: 20.9454
             lly: 221.563
             urx: 37.9636
             ury: 232.909
           width: 17.0182
          height: 11.346
        
        
        S2_FROM_DD: 
             llx: 41.0181
             lly: 221.127
             urx: 59.3454
             ury: 232.472
           width: 18.3273
          height: 11.345
        
        
        S2_FROM_YY: 
             llx: 61.5272
             lly: 221.127
             urx: 81.1635
             ury: 232.036
           width: 19.6363
          height: 10.909
        
        
        S2_TO_MM: 
             llx: 85.3083
             lly: 221.127
             urx: 102.326
             ury: 232.472
           width: 17.0177
          height: 11.345
        
        
        S2_TO_DD: 
             llx: 105.381
             lly: 220.69
             urx: 123.708
             ury: 232.036
           width: 18.327
          height: 11.346
        
        
        S2_TO_YY: 
             llx: 125.89
             lly: 220.69
             urx: 145.526
             ury: 231.599
           width: 19.636
          height: 10.909
        
        
        S2_PLACE: 
             llx: 148.8
             lly: 221.125
             urx: 168.437
             ury: 232.034
           width: 19.637
          height: 10.909
        
        
        S2_EMG: 
             llx: 171.055
             lly: 221.125
             urx: 186.982
             ury: 232.252
           width: 15.927
          height: 11.127
        
        
        S2_CODE: 
             llx: 196.146
             lly: 221.78
             urx: 239.782
             ury: 231.161
           width: 43.636
          height: 9.381
        
        
        S2_NAME: 
             llx: 248.946
             lly: 221.561
             urx: 332.946
             ury: 232.252
           width: 84
          height: 10.691
        
        
        S2_POINTERS: 
             llx: 335.782
             lly: 221.561
             urx: 370.473
             ury: 232.252
           width: 34.691
          height: 10.691
        
        
        S2_TOTAL: 
             llx: 376.364
             lly: 221.78
             urx: 433.528
             ury: 232.034
           width: 57.164
          height: 10.254',
        '

        S3_FROM_MM: 
             llx: 21.8909
             lly: 197.054
             urx: 38.909
             ury: 208.399
           width: 17.0181
          height: 11.345
        
        
        S3_FROM_DD: 
             llx: 41.9636
             lly: 196.618
             urx: 60.2908
             ury: 207.963
           width: 18.3272
          height: 11.345
        
        
        S3_FROM_YY: 
             llx: 62.4726
             lly: 196.618
             urx: 82.1089
             ury: 207.527
           width: 19.6363
          height: 10.909
        
        
        S3_TO_MM: 
             llx: 86.2537
             lly: 196.618
             urx: 103.272
             ury: 207.963
           width: 17.0183
          height: 11.345
        
        
        S3_TO_DD: 
             llx: 106.326
             lly: 196.181
             urx: 124.654
             ury: 207.527
           width: 18.328
          height: 11.346
        
        
        S3_TO_YY: 
             llx: 126.835
             lly: 196.181
             urx: 146.472
             ury: 207.09
           width: 19.637
          height: 10.909
        
        
        S3_PLACE: 
             llx: 149.746
             lly: 196.616
             urx: 169.382
             ury: 207.525
           width: 19.636
          height: 10.909
        
        
        S3_EMG: 
             llx: 172
             lly: 196.616
             urx: 187.928
             ury: 207.743
           width: 15.928
          height: 11.127
        
        
        S3_CODE: 
             llx: 197.091
             lly: 197.27
             urx: 240.728
             ury: 206.652
           width: 43.637
          height: 9.382
        
        
        S3_NAME: 
             llx: 249.891
             lly: 197.052
             urx: 333.891
             ury: 207.743
           width: 84
          height: 10.691
        
        
        S3_POINTERS: 
             llx: 336.728
             lly: 197.052
             urx: 371.419
             ury: 207.743
           width: 34.691
          height: 10.691
        
        
        S3_TOTAL: 
             llx: 377.31
             lly: 197.27
             urx: 434.473
             ury: 207.525
           width: 57.163
          height: 10.255',
        '

        S4_FROM_MM: 
             llx: 21.6
             lly: 172.69
             urx: 38.6181
             ury: 184.036
           width: 17.0181
          height: 11.346
        
        
        S4_FROM_DD: 
             llx: 41.6727
             lly: 172.254
             urx: 59.9999
             ury: 183.599
           width: 18.3272
          height: 11.345
        
        
        S4_FROM_YY: 
             llx: 62.1817
             lly: 172.254
             urx: 81.818
             ury: 183.163
           width: 19.6363
          height: 10.909
        
        
        S4_TO_MM: 
             llx: 85.9628
             lly: 172.254
             urx: 102.981
             ury: 183.599
           width: 17.0182
          height: 11.345
        
        
        S4_TO_DD: 
             llx: 106.036
             lly: 171.818
             urx: 124.363
             ury: 183.163
           width: 18.327
          height: 11.345
        
        
        S4_TO_YY: 
             llx: 126.545
             lly: 171.818
             urx: 146.181
             ury: 182.727
           width: 19.636
          height: 10.909
        
        
        S4_PLACE: 
             llx: 149.455
             lly: 172.252
             urx: 169.091
             ury: 183.161
           width: 19.636
          height: 10.909
        
        
        S4_EMG: 
             llx: 171.709
             lly: 172.252
             urx: 187.637
             ury: 183.379
           width: 15.928
          height: 11.127
        
        
        S4_CODE: 
             llx: 196.8
             lly: 172.907
             urx: 240.437
             ury: 182.289
           width: 43.637
          height: 9.382
        
        
        S4_NAME: 
             llx: 249.6
             lly: 172.689
             urx: 333.6
             ury: 183.379
           width: 84
          height: 10.69
        
        
        S4_POINTERS: 
             llx: 336.437
             lly: 172.689
             urx: 371.128
             ury: 183.379
           width: 34.691
          height: 10.69
        
        
        S4_TOTAL: 
             llx: 377.019
             lly: 172.907
             urx: 434.182
             ury: 183.161
           width: 57.163
          height: 10.254',
        '

        S5_FROM_MM: 
             llx: 22.1091
             lly: 150.145
             urx: 39.1272
             ury: 161.49
           width: 17.0181
          height: 11.345
        
        
        S5_FROM_DD: 
             llx: 42.1817
             lly: 149.709
             urx: 60.509
             ury: 161.054
           width: 18.3273
          height: 11.345
        
        
        S5_FROM_YY: 
             llx: 62.6908
             lly: 149.709
             urx: 82.3271
             ury: 160.618
           width: 19.6363
          height: 10.909
        
        
        S5_TO_MM: 
             llx: 86.4719
             lly: 149.708
             urx: 103.49
             ury: 161.054
           width: 17.0181
          height: 11.346
        
        
        S5_TO_DD: 
             llx: 106.545
             lly: 149.272
             urx: 124.872
             ury: 160.618
           width: 18.327
          height: 11.346
        
        
        S5_TO_YY: 
             llx: 127.054
             lly: 149.272
             urx: 146.69
             ury: 160.181
           width: 19.636
          height: 10.909
        
        
        S5_PLACE: 
             llx: 149.964
             lly: 149.707
             urx: 169.6
             ury: 160.616
           width: 19.636
          height: 10.909
        
        
        S5_EMG: 
             llx: 172.218
             lly: 149.707
             urx: 188.146
             ury: 160.834
           width: 15.928
          height: 11.127
        
        
        S5_CODE: 
             llx: 197.309
             lly: 150.361
             urx: 240.946
             ury: 159.743
           width: 43.637
          height: 9.382
        
        
        S5_NAME: 
             llx: 250.109
             lly: 150.143
             urx: 334.109
             ury: 160.834
           width: 84
          height: 10.691
        
        
        S5_POINTERS: 
             llx: 336.946
             lly: 150.143
             urx: 371.637
             ury: 160.834
           width: 34.691
          height: 10.691
        
        
        S5_TOTAL: 
             llx: 377.528
             lly: 150.361
             urx: 434.691
             ury: 160.616
           width: 57.163
          height: 10.255',
        '

        S6_FROM_MM: 
             llx: 21.9636
             lly: 125.636
             urx: 38.9817
             ury: 136.981
           width: 17.0181
          height: 11.345
        
        
        S6_FROM_DD: 
             llx: 42.0363
             lly: 125.199
             urx: 60.3635
             ury: 136.545
           width: 18.3272
          height: 11.346
        
        
        S6_FROM_YY: 
             llx: 62.5453
             lly: 125.199
             urx: 82.1816
             ury: 136.108
           width: 19.6363
          height: 10.909
        
        
        S6_TO_MM: 
             llx: 86.3264
             lly: 125.199
             urx: 103.345
             ury: 136.545
           width: 17.0186
          height: 11.346
        
        
        S6_TO_DD: 
             llx: 106.399
             lly: 124.763
             urx: 124.726
             ury: 136.108
           width: 18.327
          height: 11.345
        
        
        S6_TO_YY: 
             llx: 126.908
             lly: 124.763
             urx: 146.544
             ury: 135.672
           width: 19.636
          height: 10.909
        
        
        S6_PLACE: 
             llx: 149.818
             lly: 125.198
             urx: 169.455
             ury: 136.107
           width: 19.637
          height: 10.909
        
        
        S6_EMG: 
             llx: 172.073
             lly: 125.198
             urx: 188
             ury: 136.325
           width: 15.927
          height: 11.127
        
        
        S6_CODE: 
             llx: 197.164
             lly: 125.852
             urx: 240.8
             ury: 135.234
           width: 43.636
          height: 9.382
        
        
        S6_NAME: 
             llx: 249.964
             lly: 125.634
             urx: 333.964
             ury: 136.325
           width: 84
          height: 10.691
        
        
        S6_POINTERS: 
             llx: 336.8
             lly: 125.634
             urx: 371.491
             ury: 136.325
           width: 34.691
          height: 10.691
        
        
        S6_TOTAL: 
             llx: 377.382
             lly: 125.852
             urx: 434.546
             ury: 136.107
           width: 57.164
          height: 10.255',
    ];

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->addDiagnosisSlots(count($invoice->diagnoses));
        $this->addServicesSlots(count($invoice->services2));
    }

    public function test()
    {
        $converter = new Converter($this->coordinates);
        $converter->loadPagesWithFieldsCount();
        $coords = $converter->formatFieldsAsJSON();

        $fields = json_decode($coords, true);

        $fieldEntities = [];

        foreach ($fields as $field) {
            $fieldEntities[] = Field::fieldFromArray($field);
        }

        $this->getInvoiceData();

        $form = Storage::get('pdf/form.pdf');
        $newForm = 'pdf/newForm.pdf';

        $pdfGenerator = new PDFGenerator($fieldEntities, $this->data, 'P', 'pt', 'A4');

        try {
            $pdfGenerator->start($form, $newForm);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function addDiagnosisSlots($diagnoses_count)
    {
        for ($i = 0; $i < $diagnoses_count; ++$i) {
            $this->coordinates = $this->coordinates.$this->diagnosis_slots[$i];
        }
    }

    private function addServicesSlots($services_count)
    {
        for ($i = 0; $i < $services_count; ++$i) {
            $this->coordinates = $this->coordinates.$this->service_slots[$i];
        }
    }

    private function getInvoiceData()
    {
        //return
        $this->data = [
            'DOCTOR' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->doctor,
            ],
            'INVOICE_PAID' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->amountPaid(),
            ],
            'INVOICE_TOTAL' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->totalDiscounted(),
            ],
            'INVOICE_NUMBER' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->number,
            ],
            'PATIENT_PHONE' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->phone_number,
            ],
            'PATIENT_ZIP' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->zip_code,
            ],
            'PATIENT_DATE' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->date->format('m-d-Y'),
            ],
            'PATIENT_YY' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->birth_date->format('y'),
            ],
            'PATIENT_DD' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->birth_date->day,
            ],
            'PATIENT_MM' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->birth_date->month,
            ],
            'STATE' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->state,
            ],
            'PATIENT_NAME' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->name(),
            ],
            'CITY' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->city,
            ],
            'PATIENT_ADDRESS' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->patient->address(),
            ],
            'SEXF' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (1 == $this->invoice->patient->gender) ? 'X' : '',
            ],
            'SEXM' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (1 == $this->invoice->patient->gender) ? '' : 'X',
            ],
            'OTHER' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => 'X',
            ],
        ];
        if ($this->invoice->patient->insured) {
            $insured = $this->invoice->patient->insuree;

            //add insured data
            $insured_data = [
                'INSURED_ID' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insurance_id,
                ],
                'INSURED_PHONE' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->phone_number,
                ],
                'INSURED_ZIP' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->zip_code,
                ],
                'INSURED_YY' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->birth_date->format('y'),
                ],
                'INSURED_DD' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->birth_date->day,
                ],
                'INSURED_MM' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->birth_date->month,
                ],
                'INSURED_STATE' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->state,
                ],
                'INSURED_NAME' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->name(),
                ],
                'INSURED_CITY' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->city,
                ],
                'INSURED_ADDRESS' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->patient->address(),
                ],
                'SELF' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => 'X',
                ],
                'CHILD' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
                'SPOUSE' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
                'R_OTHER' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
                'INSURED_SEXF' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $this->invoice->patient->gender) ? 'X' : '',
                ],
                'INSURED_SEXM' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $this->invoice->patient->gender) ? '' : 'X',
                ],
            ];

            $this->data = $this->data + $insured_data;
        } else {
            $insured = Patient::where('id', $this->patient->dependent->insuree_id)->first();
            $insured_data = [
                'INSURED_ID' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->insured->insurance_id,
                ],
                'INSURED_PHONE' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->phone_number,
                ],
                'INSURED_ZIP' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->zip_code,
                ],
                'INSURED_YY' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->birth_date->format('y'),
                ],
                'INSURED_DD' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->birth_date->day,
                ],
                'INSURED_MM' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->birth_date->month,
                ],
                'INSURED_STATE' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->state,
                ],
                'INSURED_NAME' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->name(),
                ],
                'INSURED_CITY' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->city,
                ],
                'INSURED_ADDRESS' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $insured->patient->address(),
                ],
                'SELF' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => '',
                ],
                'CHILD' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'SPOUSE' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (2 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'R_OTHER' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (0 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'INSURED_SEXF' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $insured->patient->gender) ? 'X' : '',
                ],
                'INSURED_SEXM' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => (1 == $insured->patient->gender) ? '' : 'X',
                ],
            ];
        }

        $diagnosis_list = [];

        for ($i = 0; $i < count($this->invoice->diagnoses); ++$i) {
            if (0 == $i) {
                $diagnosis_list['DA'] = [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ];
            /* array_push($diagnosis_list, ['DA' => [
                'size' => 14,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->diagnoses[$i]->code,
            ]]) */
            } elseif (1 == $i) {
                array_push($diagnosis_list, ['DB' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (2 == $i) {
                array_push($diagnosis_list, ['DC' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (3 == $i) {
                array_push($diagnosis_list, ['DD' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (4 == $i) {
                array_push($diagnosis_list, ['DE' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (5 == $i) {
                array_push($diagnosis_list, ['DF' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (6 == $i) {
                array_push($diagnosis_list, ['DG' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (7 == $i) {
                array_push($diagnosis_list, ['DH' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (8 == $i) {
                array_push($diagnosis_list, ['DI' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (9 == $i) {
                array_push($diagnosis_list, ['DJ' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (10 == $i) {
                array_push($diagnosis_list, ['DK' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            } elseif (11 == $i) {
                array_push($diagnosis_list, ['DL' => [
                    'size' => 14,
                    'family' => 'Arial',
                    'style' => 'B',
                    'value' => $this->invoice->diagnoses[$i]->code,
                ]]);
            }
        }

        $this->data = $this->data + $diagnosis_list;
        print_r($this->data);
        //add data
    }
}
