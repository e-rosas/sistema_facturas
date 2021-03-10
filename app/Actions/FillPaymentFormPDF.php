<?php

namespace App\Actions;

use App\Insuree;
use App\Invoice;
use FormFiller\PDF\Converter\Converter;
use FormFiller\PDF\Field;
use FormFiller\PDF\PDFGenerator;
use Illuminate\Support\Facades\Storage;

class FillPaymentFormPDF
{
    private $coordinates = '142 widget annotations found on page 1.
    ----------------------------------------------
    
    INSURED_ID: 
         llx: 373.92
         lly: 725.409
         urx: 587.52
         ury: 685.823
       width: 213.6
      height: 10.49
    
    
    INSURED_NAME: 
         llx: 373.133
         lly: 703.089
         urx: 586.733
         ury: 664.425
       width: 213.6
      height: 11.336
    
    
    PATIENT_ADDRESS: 
         llx: 20.2031
         lly: 675.853
         urx: 222.445
         ury: 636.377
       width: 202.2419
      height: 10.524
    
    
    INSURED_ADDRESS: 
         llx: 373.92
         lly: 677.821
         urx: 587.52
         ury: 639.306
       width: 213.6
      height: 11.485
    
    
    CITY: 
         llx: 20.16
         lly: 652.88
         urx: 191.78
         ury: 613.041
       width: 171.62
      height: 10.161
    
    
    INSURED_CITY: 
         llx: 373.68
         lly: 653.471
         urx: 530.87
         ury: 615.225
       width: 157.19
      height: 11.754
    
    
    OTHER: 
         llx: 334.251
         lly: 723.607
         urx: 347.33
         ury: 685.504
       width: 13.079
      height: 11.897
    
    
    SEXM: 
         llx: 313.582
         lly: 699.591
         urx: 323.905
         ury: 661.095
       width: 10.323
      height: 11.504
    
    
    SEXF: 
         llx: 348.818
         lly: 699.985
         urx: 360.715
         ury: 661.685
       width: 11.897
      height: 11.7
    
    
    PATIENT_NAME: 
         llx: 20.2755
         lly: 700.465
         urx: 222.243
         ury: 662.079
       width: 201.9675
      height: 11.69
    
    
    SELF: 
         llx: 247.834
         lly: 676.363
         urx: 259.91
         ury: 637.473
       width: 11.307
      height: 11.11
    
    
    SPOUSE: 
         llx: 284.842
         lly: 676.363
         urx: 295.361
         ury: 636.882
       width: 10.519
      height: 10.519
    
    
    CHILD: 
         llx: 313.385
         lly: 676.363
         urx: 324.495
         ury: 637.473
       width: 11.11
      height: 11.11
    
    
    R_OTHER: 
         llx: 350.196
         lly: 677.544
         urx: 360.715
         ury: 638.26
       width: 10.519
      height: 10.716
    
    
    STATE: 
         llx: 200.787
         lly: 652.827
         urx: 220.669
         ury: 616.213
       width: 19.882
      height: 13.386
    
    
    INSURED_STATE: 
         llx: 542.518
         lly: 654.008
         urx: 585.037
         ury: 615.82
       width: 42.519
      height: 11.812
    
    
    PATIENT_MM: 
         llx: 239.165
         lly: 698.465
         urx: 250.983
         ury: 659.52
       width: 23.818
      height: 9.0549999999999
    
    
    PATIENT_DD: 
         llx: 258.39
         lly: 698.465
         urx: 274.605
         ury: 658.536
       width: 19.291
      height: 9.0549999999999
    
    
    PATIENT_YY: 
         llx: 284.558
         lly: 698.465
         urx: 304.33
         ury: 659.52
       width: 26.772
      height: 9.0549999999999
    
    
    PATIENT_ZIP: 
         llx: 24.9999
         lly: 627.434
         urx: 77.5588
         ury: 591.016
       width: 52.5589
      height: 13.582
    
    
    PATIENT_PHONE: 
         llx: 121.063
         lly: 627.631
         urx: 220.669
         ury: 588.457
       width: 99.606
      height: 10.826
    
    
    INSURED_ZIP: 
         llx: 372.44
         lly: 629.009
         urx: 459.054
         ury: 590.032
       width: 86.69
      height: 11.023
    
    
    INSURED_PHONE: 
         llx: 483.129
         lly: 630.583
         urx: 583.659
         ury: 590.426
       width: 104.33
      height: 9.8430000000001


INSURED_POLICY: 
     llx: 373.03
     lly: 606.371
     urx: 585.431
     ury: 567.198
   width: 212.401
  height: 10.827
    
    
    INSURED_MM: 
         llx: 396.644
         lly: 579.78
         urx: 412.203
         ury: 540.623
       width: 27.559
      height: 10.039
    
    
    INSURED_DD: 
         llx: 414.762
         lly: 579.78
         urx: 432.676
         ury: 540.229
       width: 17.99
      height: 9.4490000000001
    
    
    INSURED_YY: 
         llx: 440.778
         lly: 579.78
         urx: 474.605
         ury: 540.623
       width: 35.827
      height: 10.236
    
    
    INSURED_SEXM: 
         llx: 500.589
         lly: 582.158
         urx: 511.219
         ury: 543.182
       width: 10.63
      height: 11.024
    
    
    INSURED_SEXF: 
         llx: 551.77
         lly: 581.765
         urx: 562.4
         ury: 543.182
       width: 10.63
      height: 11.417
    
    
    PATIENT_DATE: 
         llx: 273.163
         lly: 459.546
         urx: 364.363
         ury: 422.837
       width: 91.2
      height: 8.291
    
    
    INVOICE_NUMBER: 
         llx: 180.655
         lly: 152.327
         urx: 262.909
         ury: 19.108
       width: 82.254
      height: 11.781
    
    
    INVOICE_TOTAL: 
         llx: 385.31
         lly: 152.545
         urx: 431.128
         ury: 111.927
       width: 45.818
      height: 9.382
    
    
    INVOICE_PAID: 
         llx: 465.164
         lly: 152.545
         urx: 502.037
         ury: 19.763
       width: 36.873
      height: 12.218
    
    
      DOCTOR1: 
          llx: 24
          lly: 108.6951
          urx: 178.59801
          ury: 70.2538
        width: 150.59801
      height: 5.5587


    INSURANCE_NAME: 
          llx: 387.217
          lly: 809.141
          urx: 586.987
          ury: 771.836
        width: 199.77
        height: 12.695


    INSURANCE_ADDRESS: 
          llx: 387.964
          lly: 794.205
          urx: 586.987
          ury: 756.527
        width: 199.023
        height: 12.322


    INSURANCE_CITY_ZIP: 
          llx: 388.711
          lly: 776.281
          urx: 586.613
          ury: 741.217
        width: 197.902
        height: 14.936


    INSURANCE_PHONE: 
          llx: 389.084
          lly: 759.105
          urx: 542.178
          ury: 722.921
        width: 153.094
        height: 13.816


BILLING_PHONE: 
     llx: 479.619
     lly: 140.1034
     urx: 567.513
     ury: 100.423
   width: 87.894
  height: 8.3196


LINE_1: 
     llx: 179.893
     lly: 131.0155
     urx: 369.897
     ury: 92.4552
   width: 190.004
  height: 9.4397


LINE_2: 
     llx: 179.193
     lly: 121.5051
     urx: 369.897
     ury: 81.8483
   width: 190.704
  height: 8.3432


LINE_3: 
     llx: 180.302
     lly: 111.177
     urx: 370.246
     ury: 72.3257
   width: 189.944
  height: 9.1487


LINE_4: 
     llx: 180.827
     lly: 101.1673
     urx: 370.771
     ury: 62.316
   width: 189.944
  height: 9.1487


BILLING_LINE_1: 
     llx: 376.03
     lly: 131.0523
     urx: 566.034
     ury: 91.492
   width: 190.004
  height: 9.4397


BILLING_LINE_2: 
     llx: 375.33
     lly: 121.5419
     urx: 566.034
     ury: 80.8851
   width: 190.704
  height: 8.3432


BILLING_LINE_3: 
     llx: 376.438
     lly: 111.2137
     urx: 566.383
     ury: 71.3625
   width: 189.945
  height: 9.1488


BILLING_LINE_4: 
     llx: 376.964
     lly: 101.2041
     urx: 566.908
     ury: 61.3528
   width: 189.944
  height: 9.1487


ACCEPT_ASSIGNMENT_YES: 
     llx: 286.924
     lly: 151.982
     urx: 297.554
     ury: 113.006
   width: 10.63
  height: 11.024


ACCEPT_ASSIGNMENT_NO: 
     llx: 323.103
     lly: 151.752
     urx: 333.733
     ury: 112.776
   width: 10.63
  height: 11.024


INVOICE_DOS: 
     llx: 125.0909
     lly: 96.9112
     urx: 173.345
     ury: 58.6922
   width: 82.2541
  height: 11.781


  DOCTOR2: 
       llx: 24.4573
       lly: 101.0145
       urx: 173.87399
       ury: 63.5732
     width: 149.41669
    height: 5.5587
  
  
  DOCTOR3: 
       llx: 24.5036
       lly: 104.6247
       urx: 173.92101
       ury: 57.1834
     width: 149.41741
    height: 5.5587';

    private $invoice;
    private $data;
    private $invoice_data;
    private $diagnosis_slots = [
        '

      DA: 
           llx: 40.551
           lly: 363.29
           urx: 74.2124
           ury: 323.498
         width: 33.669
        height: 7.284',
        '

        DB: 
             llx: 135.236
             lly: 363.29
             urx: 166.338
             ury: 321.726
           width: 31.102
          height: 5.709',
        '

        DC: 
             llx: 229.527
             lly: 363.29
             urx: 261.22
             ury: 322.12
           width: 31.693
          height: 5.709',
        '

        DD: 
             llx: 327.755
             lly: 363.29
             urx: 354.133
             ury: 321.923
           width: 26.378
          height: 6.103',
        '

        DE: 
             llx: 39.7636
             lly: 352.3
             urx: 74.606
             ury: 311.687
           width: 34.8424
          height: 6.3',
        '

        DF: 
             llx: 134.448
             lly: 352.3
             urx: 166.535
             ury: 310.506
           width: 32.087
          height: 6.103',
        '

        DG: 
             llx: 226.968
             lly: 352.3
             urx: 260.629
             ury: 310.506
           width: 33.661
          height: 6.103',
        '

        DH: 
             llx: 330.117
             lly: 352.3
             urx: 354.133
             ury: 310.112
           width: 24.016
          height: 5.512',
        '

        DI: 
             llx: 41.7321
             lly: 339.29
             urx: 73.425
             ury: 299.876
           width: 31.6929
          height: 6.693',
        '

        DJ: 
             llx: 134.645
             lly: 339.29
             urx: 166.338
             ury: 298.104
           width: 31.693
          height: 5.118',
        '

        DK: 
             llx: 227.165
             lly: 339.29
             urx: 261.416
             ury: 299.482
           width: 34.251
          height: 6.102',
        '

        DL: 
             llx: 329.526
             lly: 339.29
             urx: 353.936
             ury: 299.679
           width: 24.41
          height: 6.299',
    ];
    private $service_slots = [
        '

        S1_FROM_MM: 
             llx: 20.509
             lly: 294.801
             urx: 37.5272
             ury: 256.583
           width: 17.0182
          height: 11.345
        
        
        S1_FROM_DD: 
             llx: 40.5817
             lly: 294.801
             urx: 58.909
             ury: 256.97
           width: 18.3273
          height: 11.346
        
        
        S1_FROM_YY: 
             llx: 61.0908
             lly: 294.801
             urx: 80.7271
             ury: 255.71
           width: 19.6363
          height: 11.346
        
        
        S1_TO_MM: 
             llx: 84.8719
             lly: 294.801
             urx: 101.89
             ury: 256.97
           width: 17.0181
          height: 11.346
        
        
        S1_TO_DD: 
             llx: 104.945
             lly: 294.801
             urx: 123.272
             ury: 255.71
           width: 18.327
          height: 11.345
        
        
        S1_TO_YY: 
             llx: 125.454
             lly: 294.801
             urx: 95.09
             ury: 255.274
           width: 19.636
          height: 11.345
        
        
        S1_PLACE: 
             llx: 148.364
             lly: 294.801
             urx: 168
             ury: 255.709
           width: 19.636
          height: 10.91
        
        
        S1_EMG: 
             llx: 170.618
             lly: 294.801
             urx: 186.546
             ury: 255.927
           width: 15.928
          height: 11.128
        
        
        S1_CODE: 
             llx: 195.709
             lly: 294.801
             urx: 239.346
             ury: 254.836
           width: 43.637
          height: 9.382
        
        
        S1_NAME: 
             llx: 248.509
             lly: 294.801
             urx: 332.509
             ury: 255.927
           width: 84
          height: 10.691
        
        
        S1_POINTERS: 
             llx: 335.346
             lly: 294.801
             urx: 370.037
             ury: 255.927
           width: 34.691
          height: 10.691
        
        
        S1_TOTAL: 
             llx: 375.928
             lly: 294.801
             urx: 433.091
             ury: 255.709
           width: 57.163
          height: 10.255
        

        S1_UNITS: 
             llx: 439.867
             lly: 294.801
             urx: 458.163
             ury: 256.543
           width: 18.296
          height: 11.949',
        '


        S2_FROM_MM: 
             llx: 20.9454
             lly: 271.563
             urx: 37.9636
             ury: 232.909
           width: 17.0182
          height: 11.346
        
        
        S2_FROM_DD: 
             llx: 41.0181
             lly: 271.127
             urx: 59.3454
             ury: 232.472
           width: 18.3273
          height: 11.345
        
        
        S2_FROM_YY: 
             llx: 61.5272
             lly: 271.127
             urx: 81.1635
             ury: 232.036
           width: 19.6363
          height: 10.909
        
        
        S2_TO_MM: 
             llx: 85.3083
             lly: 271.127
             urx: 102.326
             ury: 232.472
           width: 17.0177
          height: 11.345
        
        
        S2_TO_DD: 
             llx: 105.381
             lly: 270.69
             urx: 123.708
             ury: 232.036
           width: 18.327
          height: 11.346
        
        
        S2_TO_YY: 
             llx: 125.89
             lly: 270.69
             urx: 95.526
             ury: 231.599
           width: 19.636
          height: 10.909
        
        
        S2_PLACE: 
             llx: 148.364
             lly: 271.125
             urx: 168.437
             ury: 232.034
           width: 19.637
          height: 10.909
        
        
        S2_EMG: 
             llx: 171.055
             lly: 271.125
             urx: 186.982
             ury: 232.252
           width: 15.927
          height: 11.127
        
        
        S2_CODE: 
             llx: 196.96
             lly: 271.78
             urx: 239.782
             ury: 231.161
           width: 43.636
          height: 9.381
        
        
        S2_NAME: 
             llx: 248.946
             lly: 271.561
             urx: 332.946
             ury: 232.252
           width: 84
          height: 10.691
        
        
        S2_POINTERS: 
             llx: 335.782
             lly: 271.561
             urx: 370.473
             ury: 232.252
           width: 34.691
          height: 10.691
        
        
        S2_TOTAL: 
             llx: 376.364
             lly: 271.78
             urx: 433.528
             ury: 232.034
           width: 57.164
          height: 10.254

        
        S2_UNITS: 
             llx: 439.951
             lly: 271.78
             urx: 458.248
             ury: 233.347
           width: 18.297
          height: 11.948',
        '


        S3_FROM_MM: 
             llx: 21.8909
             lly: 247.054
             urx: 38.909
             ury: 208.399
           width: 17.0181
          height: 11.345
        
        
        S3_FROM_DD: 
             llx: 41.9636
             lly: 246.618
             urx: 60.2908
             ury: 207.963
           width: 18.3272
          height: 11.345
        
        
        S3_FROM_YY: 
             llx: 62.4726
             lly: 246.618
             urx: 82.1089
             ury: 207.527
           width: 19.6363
          height: 10.909
        
        
        S3_TO_MM: 
             llx: 86.2537
             lly: 246.618
             urx: 103.272
             ury: 207.963
           width: 17.0183
          height: 11.345
        
        
        S3_TO_DD: 
             llx: 106.326
             lly: 246.181
             urx: 124.654
             ury: 207.527
           width: 18.328
          height: 11.346
        
        
        S3_TO_YY: 
             llx: 126.835
             lly: 246.181
             urx: 96.472
             ury: 207.09
           width: 19.637
          height: 10.909
        
        
        S3_PLACE: 
             llx: 148.364
             lly: 246.616
             urx: 169.382
             ury: 207.525
           width: 19.636
          height: 10.909
        
        
        S3_EMG: 
             llx: 172
             lly: 246.616
             urx: 187.928
             ury: 207.743
           width: 15.928
          height: 11.127
        
        
        S3_CODE: 
             llx: 197.091
             lly: 247.27
             urx: 240.728
             ury: 206.652
           width: 43.637
          height: 9.382
        
        
        S3_NAME: 
             llx: 249.891
             lly: 247.052
             urx: 333.891
             ury: 207.743
           width: 84
          height: 10.691
        
        
        S3_POINTERS: 
             llx: 336.728
             lly: 247.052
             urx: 371.419
             ury: 207.743
           width: 34.691
          height: 10.691
        
        
        S3_TOTAL: 
             llx: 377.31
             lly: 247.27
             urx: 434.473
             ury: 207.525
           width: 57.163
          height: 10.255

        
        S3_UNITS: 
             llx: 440.406
             lly: 247.27
             urx: 458.703
             ury: 208.511
           width: 18.297
          height: 11.949',
        '


        S4_FROM_MM: 
             llx: 21.6
             lly: 222.69
             urx: 38.6181
             ury: 184.036
           width: 17.0181
          height: 11.346
        
        
        S4_FROM_DD: 
             llx: 41.6727
             lly: 222.254
             urx: 59.9999
             ury: 183.599
           width: 18.3272
          height: 11.345
        
        
        S4_FROM_YY: 
             llx: 62.1817
             lly: 222.254
             urx: 81.818
             ury: 183.163
           width: 19.6363
          height: 10.909
        
        
        S4_TO_MM: 
             llx: 85.9628
             lly: 222.254
             urx: 102.981
             ury: 183.599
           width: 17.0182
          height: 11.345
        
        
        S4_TO_DD: 
             llx: 106.036
             lly: 221.818
             urx: 124.363
             ury: 183.163
           width: 18.327
          height: 11.345
        
        
        S4_TO_YY: 
             llx: 126.545
             lly: 221.818
             urx: 96.181
             ury: 182.727
           width: 19.636
          height: 10.909
        
        
        S4_PLACE: 
             llx: 148.364
             lly: 222.252
             urx: 169.091
             ury: 183.161
           width: 19.636
          height: 10.909
        
        
        S4_EMG: 
             llx: 171.709
             lly: 222.252
             urx: 187.637
             ury: 183.379
           width: 15.928
          height: 11.127
        
        
        S4_CODE: 
             llx: 196.8
             lly: 222.907
             urx: 240.437
             ury: 182.289
           width: 43.637
          height: 9.382
        
        
        S4_NAME: 
             llx: 249.6
             lly: 222.689
             urx: 333.6
             ury: 183.379
           width: 84
          height: 10.69
        
        
        S4_POINTERS: 
             llx: 336.437
             lly: 222.689
             urx: 371.128
             ury: 183.379
           width: 34.691
          height: 10.69
        
        
        S4_TOTAL: 
             llx: 377.019
             lly: 222.907
             urx: 434.182
             ury: 183.161
           width: 57.163
          height: 10.254


        S4_UNITS: 
             llx: 440.697
             lly: 222.907
             urx: 458.994
             ury: 184.657
           width: 18.297
          height: 11.949',
        '


        S5_FROM_MM: 
             llx: 22.1091
             lly: 200.95
             urx: 39.1272
             ury: 161.49
           width: 17.0181
          height: 11.345
        
        
        S5_FROM_DD: 
             llx: 42.1817
             lly: 200.95
             urx: 60.509
             ury: 161.054
           width: 18.3273
          height: 11.345
        
        
        S5_FROM_YY: 
             llx: 62.6908
             lly: 200.95
             urx: 82.3271
             ury: 160.618
           width: 19.6363
          height: 10.909
        
        
        S5_TO_MM: 
             llx: 86.4719
             lly: 200.95
             urx: 103.49
             ury: 161.054
           width: 17.0181
          height: 11.346
        
        
        S5_TO_DD: 
             llx: 106.545
             lly: 200.95
             urx: 124.872
             ury: 160.618
           width: 18.327
          height: 11.346
        
        
        S5_TO_YY: 
             llx: 127.054
             lly: 200.95
             urx: 96.69
             ury: 160.181
           width: 19.636
          height: 10.909
        
        
        S5_PLACE: 
             llx: 148.364
             lly: 200.95
             urx: 169.6
             ury: 160.616
           width: 19.636
          height: 10.909
        
        
        S5_EMG: 
             llx: 172.218
             lly: 200.95
             urx: 188.96
             ury: 160.834
           width: 15.928
          height: 11.127
        
        
        S5_CODE: 
             llx: 197.309
             lly: 200.95
             urx: 240.946
             ury: 159.743
           width: 43.637
          height: 9.382
        
        
        S5_NAME: 
             llx: 250.109
             lly: 200.95
             urx: 334.109
             ury: 160.834
           width: 84
          height: 10.691
        
        
        S5_POINTERS: 
             llx: 336.946
             lly: 200.95
             urx: 371.637
             ury: 160.834
           width: 34.691
          height: 10.691
        
        
        S5_TOTAL: 
             llx: 377.528
             lly: 200.95
             urx: 434.691
             ury: 160.616
           width: 57.163
          height: 10.255
          
          
        S5_UNITS: 
             llx: 440.988
             lly: 200.95
             urx: 459.284
             ury: 161.129
           width: 18.296
          height: 11.948',
        '


        S6_FROM_MM: 
             llx: 21.9636
             lly: 175.636
             urx: 38.9817
             ury: 136.981
           width: 17.0181
          height: 11.345
        
        
        S6_FROM_DD: 
             llx: 42.0363
             lly: 175.199
             urx: 60.3635
             ury: 136.545
           width: 18.3272
          height: 11.346
        
        
        S6_FROM_YY: 
             llx: 62.5453
             lly: 175.199
             urx: 82.1816
             ury: 136.108
           width: 19.6363
          height: 10.909
        
        
        S6_TO_MM: 
             llx: 86.3264
             lly: 175.199
             urx: 103.345
             ury: 136.545
           width: 17.0186
          height: 11.346
        
        
        S6_TO_DD: 
             llx: 106.399
             lly: 174.763
             urx: 124.726
             ury: 136.108
           width: 18.327
          height: 11.345
        
        
        S6_TO_YY: 
             llx: 126.908
             lly: 174.763
             urx: 96.544
             ury: 135.672
           width: 19.636
          height: 10.909
        
        
        S6_PLACE: 
             llx: 148.364
             lly: 175.198
             urx: 169.455
             ury: 136.107
           width: 19.637
          height: 10.909
        
        
        S6_EMG: 
             llx: 172.073
             lly: 175.198
             urx: 188
             ury: 136.325
           width: 15.927
          height: 11.127
        
        
        S6_CODE: 
             llx: 197.164
             lly: 175.852
             urx: 240.8
             ury: 135.234
           width: 43.636
          height: 9.382
        
        
        S6_NAME: 
             llx: 249.964
             lly: 175.634
             urx: 333.964
             ury: 136.325
           width: 84
          height: 10.691
        
        
        S6_POINTERS: 
             llx: 336.8
             lly: 175.634
             urx: 371.491
             ury: 136.325
           width: 34.691
          height: 10.691
        
        
        S6_TOTAL: 
             llx: 377.382
             lly: 175.852
             urx: 434.546
             ury: 136.107
           width: 57.164
          height: 10.255


        S6_UNITS: 
              llx: 441.442
              lly: 175.852
              urx: 459.739
              ury: 136.947
            width: 18.297
           height: 11.948',
    ];

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->addDiagnosisSlots(count($invoice->diagnoses));
    }

    public function getForm() 
    {
       if(config('app.old')) { 
            return  storage_path('app/pdf/formOld.pdf');
       } else {
            return  storage_path('app/pdf/form.pdf');
         }

    }
    

    public function fill($output)
    {
        $this->getInvoiceData();
        $amount_services = count($this->invoice->services2);
        $pages = ceil($amount_services / 6);
        $form = $this->getForm();
        
        for ($i = 0; $i < $pages; ++$i) {
          $remaining = ($amount_services - $i * 6);
          $take = ($remaining > 6 ? 6 : $remaining);
          $services = $this->invoice->services2->slice($i * 6, $take)->values();
            
            
            $this->fillPage($form, $services, $i);
        }
        $merge = new MergePDFs($pages);
        $merge->merge($this->invoice->code, $output);
    }

    public function saveFill()
    {
        $this->getInvoiceData();
        $amount_services = count($this->invoice->services2);
        $pages = ceil($amount_services / 6);
        $directory = 'pdf/patients/'.$this->invoice->patient_id.'/invoices/';
        
        
        Storage::put($directory.$this->invoice->code.'PaymentForm.pdf', '');
       
        
        
        $form = $this->getForm();
        for ($i = 0; $i < $pages; ++$i) {
            $services = $this->invoice->services2->slice($i * 6, 6)->values();
            $this->fillPage($form, $services, $i);
        }
        $merge = new MergePDFs($pages);
        $merge->saveMerge('app/'.$directory.$this->invoice->code.'PaymentForm.pdf');
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
                'style' => '',
                'value' => $services[$i]->DOS->format('m'),
            ];
            $services_list['S'.($i + 1).'_FROM_DD'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->DOS->format('d'),
            ];
            $services_list['S'.($i + 1).'_FROM_YY'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->DOS->format('y'),
            ];
            $services_list['S'.($i + 1).'_TO_MM'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->DOS_to->format('m'),
            ];
            $services_list['S'.($i + 1).'_TO_DD'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->DOS_to->format('d'),
            ];
            $services_list['S'.($i + 1).'_TO_YY'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->DOS_to->format('y'),
            ];
            $services_list['S'.($i + 1).'_PLACE'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => '11',
            ];
            $services_list['S'.($i + 1).'_EMG'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => 'N',
            ];
            $services_list['S'.($i + 1).'_CODE'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $code,
            ];
            $services_list['S'.($i + 1).'_NAME'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $modifier,
            ];
            $services_list['S'.($i + 1).'_POINTERS'] = [
                'size' => 7,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->pointers_alphabet,
            ];
            $services_list['S'.($i + 1).'_TOTAL'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => number_format($services[$i]->total_discounted_price, 2),
            ];
            $services_list['S'.($i + 1).'_UNITS'] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->quantity,
            ];
        }

        $total_services = ['INVOICE_TOTAL' => [
            'size' => 9,
            'family' => 'Arial',
            'style' => '',
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
        //dd($pdfGenerator);

        try {
            $pdfGenerator->start($form, $newForm);
        } catch (\Throwable $th) { dd($th);
            throw $th;
        }
        //dd($page);
    }

    private function realPointers($diagnosis_pointers, $alphabet)
    {
        $pointers = explode(',', $diagnosis_pointers);
        $new_pointers = '';
        $count = count($pointers);
        if($count < 5){
        for ($i = 0; $i < $count; ++$i) {
                    $new_pointers = $new_pointers.$alphabet[$pointers[$i] - 1].',';
                }
        }
        else {
        return $alphabet[$pointers[0]-1].'-'.$alphabet[$pointers[$count-1]-1];

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
      $doctors = explode("{", $this->invoice->doctor);
        //return
        $this->invoice_data = [
            'DOCTOR1' => [
                'size' => 7,
                'family' => 'Arial',
                'style' => '',
                'value' => $doctors[1] ?? '',
            ],
            'DOCTOR2' => [
              'size' => 7,
              'family' => 'Arial',
              'style' => '',
              'value' => $doctors[0],
          ],
          'DOCTOR3' => [
            'size' => 7,
            'family' => 'Arial',
            'style' => '',
            'value' => $doctors[2] ?? '',
        ],
            'INVOICE_PAID' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => 0,
            ], /*
            'INVOICE_TOTAL' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => number_format($this->invoice->total_with_discounts, 2),
            ], */
            'INVOICE_NUMBER' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->code,
            ],
            'PATIENT_PHONE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->phone_number,
            ],
            'PATIENT_ZIP' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->zip_code,
            ],
            'PATIENT_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' =>config('app.old') ? $this->invoice->date->format("m/d/Y") : $this->invoice->DOS->format("m/d/Y"),
            ],
            'PATIENT_YY' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->birth_date->format('y'),
            ],
            'PATIENT_DD' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->birth_date->format('d'),
            ],
            'PATIENT_MM' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->birth_date->format('m'),
            ],
            'STATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->state,
            ],
            'PATIENT_NAME' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->name(),
            ],
            'CITY' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->city,
            ],
            'PATIENT_ADDRESS' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->address(),
            ],
            'SEXF' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (1 == $this->invoice->patient->gender) ? 'X' : '',
            ],
            'SEXM' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (1 == $this->invoice->patient->gender) ? '' : 'X',
            ],
            'OTHER' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => 'X',
            ],
            'BILLING_PHONE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->phone_number,
            ],
            'BILLING_PHONE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->phone_number,
            ],
            'LINE_1' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->first_line,
            ],
            'LINE_2' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->second_line,
            ],
            'LINE_3' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->requiresThirdLine(),
            ],
            'LINE_4' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->fourth_line,
            ],
            'BILLING_LINE_1' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->billing_first_line,
            ],
            'BILLING_LINE_2' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->billing_second_line,
            ],
            'BILLING_LINE_3' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->billing_third_line,
            ],'BILLING_LINE_4' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->location->billing_fourth_line,
            ],'ACCEPT_ASSIGNMENT_YES' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->accept_assignment) ? 'X' : '',
            ],'ACCEPT_ASSIGNMENT_NO' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->accept_assignment) ? '' : 'X',
            ],'INVOICE_DOS' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' =>  $this->invoice->DOS->format("m/d/Y"),
            ],
        ];
        if ($this->invoice->patient->insured) {
            $insured = $this->invoice->patient->insuree;

            //add insured data
            $insured_data = [
                'INSURED_ID' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'INSURED_PHONE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->phone_number,
                ],
                'INSURED_POLICY' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->group_number,
                ],
                'INSURED_ZIP' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->zip_code,
                ],
                'INSURED_YY' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->birth_date->format('y'),
                ],
                'INSURED_DD' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->birth_date->format('d'),
                ],
                'INSURED_MM' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->birth_date->format('m'),
                ],
                'INSURED_STATE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->state,
                ],
                'INSURED_NAME' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->name(),
                ],
                'INSURED_CITY' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->city,
                ],
                'INSURED_ADDRESS' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->address(),
                ],
                'SELF' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => 'X',
                ],
                'CHILD' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
                'SPOUSE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
                'R_OTHER' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
                'INSURED_SEXF' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $this->invoice->patient->gender) ? 'X' : '',
                ],
                'INSURED_SEXM' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $this->invoice->patient->gender) ? '' : 'X',
                ],
            ];

            $insurance_data = [
                'INSURANCE_NAME' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->name,
                ],
                'INSURANCE_ADDRESS' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->address,
                ],
                'INSURANCE_CITY_ZIP' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->addressDetails(),
                ],
                'INSURANCE_PHONE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer_phone_number,
                ],
            ];

            $this->invoice_data = $this->invoice_data + $insured_data + $insurance_data;
        } else {
            $insured = Insuree::where('patient_id', $this->invoice->patient->dependent->insuree_id)->first();
            $insured_data = [
                'INSURED_ID' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'INSURED_PHONE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->phone_number,
                ],
                'INSURED_POLICY' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->group_number,
                ],
                'INSURED_ZIP' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->zip_code,
                ],
                'INSURED_YY' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->birth_date->format('y'),
                ],
                'INSURED_DD' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->birth_date->format('d'),
                ],
                'INSURED_MM' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->birth_date->format('m'),
                ],
                'INSURED_STATE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->state,
                ],
                'INSURED_NAME' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->name(),
                ],
                'INSURED_CITY' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->city,
                ],
                'INSURED_ADDRESS' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->address(),
                ],
                'SELF' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
                'CHILD' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'SPOUSE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (2 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'R_OTHER' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (0 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'INSURED_SEXF' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $insured->patient->gender) ? 'X' : '',
                ],
                'INSURED_SEXM' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $insured->patient->gender) ? '' : 'X',
                ],
            ];
            $insurance_data = [
                'INSURANCE_NAME' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->name,
                ],
                'INSURANCE_ADDRESS' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->address,
                ],
                'INSURANCE_CITY_ZIP' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->cityZIP(),
                ],
                'INSURANCE_PHONE' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer_phone_number,
                ],
            ];
            $this->invoice_data = $this->invoice_data + $insured_data + $insurance_data;
        }

        $diagnosis_list = [];

        for ($i = 0; $i < count($this->invoice->diagnoses); ++$i) {
            if (0 == $i) {
                $diagnosis_list['DA'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (1 == $i) {
                $diagnosis_list['DB'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (2 == $i) {
                $diagnosis_list['DC'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (3 == $i) {
                $diagnosis_list['DD'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (4 == $i) {
                $diagnosis_list['DE'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (5 == $i) {
                $diagnosis_list['DF'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (6 == $i) {
                $diagnosis_list['DG'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (7 == $i) {
                $diagnosis_list['DH'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (8 == $i) {
                $diagnosis_list['DI'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (9 == $i) {
                $diagnosis_list['DJ'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (10 == $i) {
                $diagnosis_list['DK'] = [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
                ];
            } elseif (11 == $i) {
                $diagnosis_list['DL'] = [
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
