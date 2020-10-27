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
    private $coordinates = '198 widget annotations found on page 1.
----------------------------------------------

Preauthorization: 
     llx: 16.2
     lly: 694.56
     urx: 306
     ury: 710.4
   width: 289.8
  height: 15.84


Company_Name: 
     llx: 16.9997
     lly: 662.708
     urx: 305.6
     ury: 672.921
   width: 288.6003
  height: 10.213


Insurer_DOB: 
     llx: 310.078
     lly: 625.356
     urx: 406.484
     ury: 635.445
   width: 96.406
  height: 10.089


Insurer_M: 
     llx: 414.48
     lly: 624
     urx: 422.4
     ury: 634.08
   width: 7.92
  height: 10.08


Insurer_F: 
     llx: 429
     lly: 624
     urx: 436.92
     ury: 634.08
   width: 7.92
  height: 10.08


Insurer_U: 
     llx: 443.4
     lly: 624
     urx: 451.32
     ury: 634.08
   width: 7.92
  height: 10.08


Insurance_ID: 
     llx: 472.431
     lly: 622.96
     urx: 595.243
     ury: 635.445
   width: 122.812
  height: 12.485


Insurer_Policy_Number: 
     llx: 310.877
     lly: 600.158
     urx: 400.284
     ury: 611.084
   width: 89.407
  height: 10.926


Self: 
     llx: 320.28
     lly: 563.88
     urx: 330.12
     ury: 573.36
   width: 9.84
  height: 9.48


Spouse: 
     llx: 356.04
     lly: 563.88
     urx: 365.88
     ury: 573.36
   width: 9.84
  height: 9.48


Child: 
     llx: 399.36
     lly: 563.88
     urx: 409.2
     ury: 573.36
   width: 9.84
  height: 9.48


Other: 
     llx: 464.28
     lly: 563.88
     urx: 474.12
     ury: 573.36
   width: 9.84
  height: 9.48


Patient_DOB: 
     llx: 313.074
     lly: 479.079
     urx: 407.083
     ury: 492.243
   width: 94.009
  height: 13.164


Patient_M: 
     llx: 414.6
     lly: 480.36
     urx: 422.52
     ury: 490.44
   width: 7.92
  height: 10.08


Patient_F: 
     llx: 429.12
     lly: 480.36
     urx: 437.04
     ury: 490.44
   width: 7.92
  height: 10.08


Patient_U: 
     llx: 443.52
     lly: 480.36
     urx: 451.44
     ury: 490.44
   width: 7.92
  height: 10.08


Patient_Insurance: 
     llx: 465.84
     lly: 478.679
     urx: 597.24
     ury: 491.644
   width: 131.4
  height: 12.965


Invoice_Total: 
     llx: 544.08
     lly: 287.04
     urx: 597.36
     ury: 298.8
   width: 53.28
  height: 11.76


Remarks: 
     llx: 16.2
     lly: 268.554
     urx: 597.24
     ury: 277.642
   width: 581.04
  height: 9.088


Enclosures: 
     llx: 520.633
     lly: 228.718
     urx: 530.686
     ury: 238.696
   width: 10.053
  height: 9.978


Ortho_No: 
     llx: 319.8
     lly: 205.68
     urx: 329.64
     ury: 215.28
   width: 9.84
  height: 9.6


Ortho_Yes: 
     llx: 384.48
     lly: 205.68
     urx: 394.32
     ury: 215.28
   width: 9.84
  height: 9.6


Appliance_Placed: 
     llx: 473.92
     lly: 206.556
     urx: 597.04
     ury: 216.924
   width: 123.12
  height: 10.368


Months_Treatment: 
     llx: 300.24
     lly: 183.116
     urx: 379.68
     ury: 192.764
   width: 79.44
  height: 9.648


Replacement_No: 
     llx: 383.654
     lly: 180.52
     urx: 394.814
     ury: 190.393
   width: 11.16
  height: 9.873


Replacement_Yes: 
     llx: 405.84
     lly: 180.52
     urx: 415.68
     ury: 190.12
   width: 9.84
  height: 9.6


Prior_Placement: 
     llx: 474.12
     lly: 182.117
     urx: 597.24
     ury: 192.764
   width: 123.12
  height: 10.647


T_0: 
     llx: 319.8
     lly: 156.84
     urx: 329.64
     ury: 166.44
   width: 9.84
  height: 9.6


T_1: 
     llx: 427.32
     lly: 156.84
     urx: 437.16
     ury: 166.44
   width: 9.84
  height: 9.6


T_2: 
     llx: 499.32
     lly: 156.36
     urx: 509.16
     ury: 165.96
   width: 9.84
  height: 9.6


Accident_Date: 
     llx: 406.236
     lly: 145.599
     urx: 502.839
     ury: 154.281
   width: 96.603
  height: 8.682


DENTIST_SIGNATURE: 
     llx: 311.52
     lly: 94.68
     urx: 475.109
     ury: 104.4
   width: 163.589
  height: 9.72


DENTIST_LICENSE: 
     llx: 508.28
     lly: 73.9579
     urx: 596.601
     ury: 82.8727
   width: 88.321
  height: 8.9148


PATIENT_SIGNATURE_DATE: 
     llx: 200.739
     lly: 203.166
     urx: 270.648
     ury: 213.952
   width: 69.909
  height: 10.786


SUBSCRIBER_SIGNATURE_DATE: 
     llx: 200.439
     lly: 157.625
     urx: 270.349
     ury: 168.411
   width: 69.91
  height: 10.786


DENTIST_SIGNATURE_DATE: 
     llx: 503.445
     lly: 95.7052
     urx: 582.143
     ury: 106.491
   width: 78.698
  height: 10.7858


Accident_State: 
     llx: 573.055
     lly: 145.441
     urx: 595.426
     ury: 153.43
   width: 22.371
  height: 7.989


Company_Address: 
     llx: 17.3898
     lly: 650.071
     urx: 304.592
     ury: 659.885
   width: 287.2022
  height: 9.814


Company_City_State_Zip: 
     llx: 18.2095
     lly: 637.067
     urx: 304.213
     ury: 647.88
   width: 286.0035
  height: 10.813


Insurer_Name: 
     llx: 308.811
     lly: 688.169
     urx: 597.411
     ury: 698.382
   width: 288.6
  height: 10.213


Insurer_Address: 
     llx: 309.201
     lly: 675.532
     urx: 596.403
     ury: 685.346
   width: 287.202
  height: 9.814


Insurer_City_State_Zip: 
     llx: 310.021
     lly: 662.528
     urx: 596.024
     ury: 673.341
   width: 286.003
  height: 10.813


Patient_Name: 
     llx: 308.012
     lly: 542.359
     urx: 596.612
     ury: 552.572
   width: 288.6
  height: 10.213


Patient_Address: 
     llx: 308.402
     lly: 529.722
     urx: 595.604
     ury: 539.536
   width: 287.202
  height: 9.814


Patient_City_State_Zip: 
     llx: 309.222
     lly: 516.718
     urx: 595.225
     ury: 527.531
   width: 286.003
  height: 10.813';

    private $invoice;
    private $data;
    private $invoice_data;
    private $diagnoses_slots = ['

Diagnosis_1: 
     llx: 361.8
     lly: 301.32
     urx: 420.84
     ury: 311.04
   width: 59.04
  height: 9.72',
'

Diagnosis_2: 
     llx: 361.8
     lly: 289.08
     urx: 420.84
     ury: 298.8
   width: 59.04
  height: 9.72',
'

Diagnosis_3: 
     llx: 439.32
     lly: 301.32
     urx: 498.48
     ury: 311.04
   width: 59.16
  height: 9.72',
'

Diagnosis_4: 
     llx: 439.32
     lly: 289.08
     urx: 498.36
     ury: 298.8
   width: 59.04
  height: 9.72'];
    private $service_slots = [
'

24 Procedure Date MMDDYYYY1: 
     llx: 25.8
     lly: 432.12
     urx: 101.04
     ury: 443.28
   width: 75.24
  height: 11.16


25 Area of Oral Cavity1: 
     llx: 102.36
     lly: 432.12
     urx: 123
     ury: 443.28
   width: 20.64
  height: 11.16


26 Tooth System1: 
     llx: 124.32
     lly: 432.12
     urx: 144.24
     ury: 443.28
   width: 19.92
  height: 11.16


27 Tooth Numbers or Letters1: 
     llx: 145.56
     lly: 432.12
     urx: 230.76
     ury: 443.28
   width: 85.2
  height: 11.16


28 Tooth Surface1: 
     llx: 232.08
     lly: 432.12
     urx: 273.48
     ury: 443.28
   width: 41.4
  height: 11.16


29 Procedure Code1: 
     llx: 274.8
     lly: 432.12
     urx: 316.68
     ury: 443.28
   width: 41.88
  height: 11.16


29a Diag Pointer1: 
     llx: 318
     lly: 432.12
     urx: 352.92
     ury: 443.28
   width: 34.92
  height: 11.16


29b Qty1: 
     llx: 354.24
     lly: 432.12
     urx: 374.4
     ury: 443.28
   width: 20.16
  height: 11.16


30 Description1: 
     llx: 375.72
     lly: 432.12
     urx: 547.44
     ury: 443.28
   width: 171.72
  height: 11.16


31 Fee1: 
     llx: 548.88
     lly: 432.12
     urx: 597.36
     ury: 443.28
   width: 48.48
  height: 11.16',
'

24 Procedure Date MMDDYYYY2: 
     llx: 25.8
     lly: 419.88
     urx: 101.04
     ury: 431.16
   width: 75.24
  height: 11.28


25 Area of Oral Cavity2: 
     llx: 102.36
     lly: 419.88
     urx: 123
     ury: 431.16
   width: 20.64
  height: 11.28


26 Tooth System2: 
     llx: 124.32
     lly: 419.88
     urx: 144.24
     ury: 431.16
   width: 19.92
  height: 11.28


27 Tooth Numbers or Letters2: 
     llx: 145.56
     lly: 419.88
     urx: 230.76
     ury: 431.16
   width: 85.2
  height: 11.28


28 Tooth Surface2: 
     llx: 232.08
     lly: 419.88
     urx: 273.48
     ury: 431.16
   width: 41.4
  height: 11.28


29 Procedure Code2: 
     llx: 274.8
     lly: 419.88
     urx: 316.68
     ury: 431.16
   width: 41.88
  height: 11.28


29a Diag Pointer2: 
     llx: 318
     lly: 419.88
     urx: 352.92
     ury: 431.16
   width: 34.92
  height: 11.28


29b Qty2: 
     llx: 354.24
     lly: 419.88
     urx: 374.4
     ury: 431.16
   width: 20.16
  height: 11.28


30 Description2: 
     llx: 375.72
     lly: 419.88
     urx: 547.44
     ury: 431.16
   width: 171.72
  height: 11.28


31 Fee2: 
     llx: 548.88
     lly: 419.88
     urx: 597.36
     ury: 431.16
   width: 48.48
  height: 11.28',
'

24 Procedure Date MMDDYYYY3: 
     llx: 25.8
     lly: 407.76
     urx: 101.04
     ury: 418.92
   width: 75.24
  height: 11.16


25 Area of Oral Cavity3: 
     llx: 102.36
     lly: 407.76
     urx: 123
     ury: 418.92
   width: 20.64
  height: 11.16


26 Tooth System3: 
     llx: 124.32
     lly: 407.76
     urx: 144.24
     ury: 418.92
   width: 19.92
  height: 11.16


27 Tooth Numbers or Letters3: 
     llx: 145.56
     lly: 407.76
     urx: 230.76
     ury: 418.92
   width: 85.2
  height: 11.16


28 Tooth Surface3: 
     llx: 232.08
     lly: 407.76
     urx: 273.48
     ury: 418.92
   width: 41.4
  height: 11.16


29 Procedure Code3: 
     llx: 274.8
     lly: 407.76
     urx: 316.68
     ury: 418.92
   width: 41.88
  height: 11.16


29a Diag Pointer3: 
     llx: 318
     lly: 407.76
     urx: 352.92
     ury: 418.92
   width: 34.92
  height: 11.16


29b Qty3: 
     llx: 354.24
     lly: 407.76
     urx: 374.4
     ury: 418.92
   width: 20.16
  height: 11.16


30 Description3: 
     llx: 375.72
     lly: 407.76
     urx: 547.44
     ury: 418.92
   width: 171.72
  height: 11.16


31 Fee3: 
     llx: 548.88
     lly: 407.76
     urx: 597.36
     ury: 418.92
   width: 48.48
  height: 11.16',
'

24 Procedure Date MMDDYYYY4: 
     llx: 25.8
     lly: 395.64
     urx: 101.04
     ury: 406.8
   width: 75.24
  height: 11.16


25 Area of Oral Cavity4: 
     llx: 102.36
     lly: 395.64
     urx: 123
     ury: 406.8
   width: 20.64
  height: 11.16


26 Tooth System4: 
     llx: 124.32
     lly: 395.64
     urx: 144.24
     ury: 406.8
   width: 19.92
  height: 11.16


27 Tooth Numbers or Letters4: 
     llx: 145.56
     lly: 395.64
     urx: 230.76
     ury: 406.8
   width: 85.2
  height: 11.16


28 Tooth Surface4: 
     llx: 232.08
     lly: 395.64
     urx: 273.48
     ury: 406.8
   width: 41.4
  height: 11.16


29 Procedure Code4: 
     llx: 274.8
     lly: 395.64
     urx: 316.68
     ury: 406.8
   width: 41.88
  height: 11.16


29a Diag Pointer4: 
     llx: 318
     lly: 395.64
     urx: 352.92
     ury: 406.8
   width: 34.92
  height: 11.16


29b Qty4: 
     llx: 354.24
     lly: 395.64
     urx: 374.4
     ury: 406.8
   width: 20.16
  height: 11.16


30 Description4: 
     llx: 375.72
     lly: 395.64
     urx: 547.44
     ury: 406.8
   width: 171.72
  height: 11.16


31 Fee4: 
     llx: 548.88
     lly: 395.64
     urx: 597.36
     ury: 406.8
   width: 48.48
  height: 11.16',
'

24 Procedure Date MMDDYYYY5: 
     llx: 25.8
     lly: 383.52
     urx: 101.04
     ury: 394.68
   width: 75.24
  height: 11.16


25 Area of Oral Cavity5: 
     llx: 102.36
     lly: 383.52
     urx: 123
     ury: 394.68
   width: 20.64
  height: 11.16


26 Tooth System5: 
     llx: 124.32
     lly: 383.52
     urx: 144.24
     ury: 394.68
   width: 19.92
  height: 11.16


27 Tooth Numbers or Letters5: 
     llx: 145.56
     lly: 383.52
     urx: 230.76
     ury: 394.68
   width: 85.2
  height: 11.16


28 Tooth Surface5: 
     llx: 232.08
     lly: 383.52
     urx: 273.48
     ury: 394.68
   width: 41.4
  height: 11.16


29 Procedure Code5: 
     llx: 274.8
     lly: 383.52
     urx: 316.68
     ury: 394.68
   width: 41.88
  height: 11.16


29a Diag Pointer5: 
     llx: 318
     lly: 383.52
     urx: 352.92
     ury: 394.68
   width: 34.92
  height: 11.16


29b Qty5: 
     llx: 354.24
     lly: 383.52
     urx: 374.4
     ury: 394.68
   width: 20.16
  height: 11.16


30 Description5: 
     llx: 375.72
     lly: 383.52
     urx: 547.44
     ury: 394.68
   width: 171.72
  height: 11.16


31 Fee5: 
     llx: 548.88
     lly: 383.52
     urx: 597.36
     ury: 394.68
   width: 48.48
  height: 11.16',
'

24 Procedure Date MMDDYYYY6: 
     llx: 25.8
     lly: 371.4
     urx: 101.04
     ury: 382.56
   width: 75.24
  height: 11.16


25 Area of Oral Cavity6: 
     llx: 102.36
     lly: 371.4
     urx: 123
     ury: 382.56
   width: 20.64
  height: 11.16


26 Tooth System6: 
     llx: 124.32
     lly: 371.4
     urx: 144.24
     ury: 382.56
   width: 19.92
  height: 11.16


27 Tooth Numbers or Letters6: 
     llx: 145.56
     lly: 371.4
     urx: 230.76
     ury: 382.56
   width: 85.2
  height: 11.16


28 Tooth Surface6: 
     llx: 232.08
     lly: 371.4
     urx: 273.48
     ury: 382.56
   width: 41.4
  height: 11.16


29 Procedure Code6: 
     llx: 274.8
     lly: 371.4
     urx: 316.68
     ury: 382.56
   width: 41.88
  height: 11.16


29a Diag Pointer6: 
     llx: 318
     lly: 371.4
     urx: 352.92
     ury: 382.56
   width: 34.92
  height: 11.16


29b Qty6: 
     llx: 354.24
     lly: 371.4
     urx: 374.4
     ury: 382.56
   width: 20.16
  height: 11.16


30 Description6: 
     llx: 375.72
     lly: 371.4
     urx: 547.44
     ury: 382.56
   width: 171.72
  height: 11.16


31 Fee6: 
     llx: 548.88
     lly: 371.4
     urx: 597.36
     ury: 382.56
   width: 48.48
  height: 11.16',
'

24 Procedure Date MMDDYYYY7: 
     llx: 25.8
     lly: 359.28
     urx: 101.04
     ury: 370.44
   width: 75.24
  height: 11.16


25 Area of Oral Cavity7: 
     llx: 102.36
     lly: 359.28
     urx: 123
     ury: 370.44
   width: 20.64
  height: 11.16


26 Tooth System7: 
     llx: 124.32
     lly: 359.28
     urx: 144.24
     ury: 370.44
   width: 19.92
  height: 11.16


27 Tooth Numbers or Letters7: 
     llx: 145.56
     lly: 359.28
     urx: 230.76
     ury: 370.44
   width: 85.2
  height: 11.16


28 Tooth Surface7: 
     llx: 232.08
     lly: 359.28
     urx: 273.48
     ury: 370.44
   width: 41.4
  height: 11.16


29 Procedure Code7: 
     llx: 274.8
     lly: 359.28
     urx: 316.68
     ury: 370.44
   width: 41.88
  height: 11.16


29a Diag Pointer7: 
     llx: 318
     lly: 359.28
     urx: 352.92
     ury: 370.44
   width: 34.92
  height: 11.16


29b Qty7: 
     llx: 354.24
     lly: 359.28
     urx: 374.4
     ury: 370.44
   width: 20.16
  height: 11.16


30 Description7: 
     llx: 375.72
     lly: 359.28
     urx: 547.44
     ury: 370.44
   width: 171.72
  height: 11.16


31 Fee7: 
     llx: 548.88
     lly: 359.28
     urx: 597.36
     ury: 370.44
   width: 48.48
  height: 11.16',
'

24 Procedure Date MMDDYYYY8: 
     llx: 25.8
     lly: 347.16
     urx: 101.04
     ury: 358.32
   width: 75.24
  height: 11.16


25 Area of Oral Cavity8: 
     llx: 102.36
     lly: 347.16
     urx: 123
     ury: 358.32
   width: 20.64
  height: 11.16


26 Tooth System8: 
     llx: 124.32
     lly: 347.16
     urx: 144.24
     ury: 358.32
   width: 19.92
  height: 11.16


27 Tooth Numbers or Letters8: 
     llx: 145.56
     lly: 347.16
     urx: 230.76
     ury: 358.32
   width: 85.2
  height: 11.16


28 Tooth Surface8: 
     llx: 232.08
     lly: 347.16
     urx: 273.48
     ury: 358.32
   width: 41.4
  height: 11.16


29 Procedure Code8: 
     llx: 274.8
     lly: 347.16
     urx: 316.68
     ury: 358.32
   width: 41.88
  height: 11.16


29a Diag Pointer8: 
     llx: 318
     lly: 347.16
     urx: 352.92
     ury: 358.32
   width: 34.92
  height: 11.16


29b Qty8: 
     llx: 354.24
     lly: 347.16
     urx: 374.4
     ury: 358.32
   width: 20.16
  height: 11.16


30 Description8: 
     llx: 375.72
     lly: 347.16
     urx: 547.44
     ury: 358.32
   width: 171.72
  height: 11.16


31 Fee8: 
     llx: 548.88
     lly: 347.16
     urx: 597.36
     ury: 358.32
   width: 48.48
  height: 11.16',
'

24 Procedure Date MMDDYYYY9: 
     llx: 25.8
     lly: 335.04
     urx: 101.04
     ury: 346.2
   width: 75.24
  height: 11.16


25 Area of Oral Cavity9: 
     llx: 102.36
     lly: 335.04
     urx: 123
     ury: 346.2
   width: 20.64
  height: 11.16


26 Tooth System9: 
     llx: 124.32
     lly: 335.04
     urx: 144.24
     ury: 346.2
   width: 19.92
  height: 11.16


27 Tooth Numbers or Letters9: 
     llx: 145.56
     lly: 335.04
     urx: 230.76
     ury: 346.2
   width: 85.2
  height: 11.16


28 Tooth Surface9: 
     llx: 232.08
     lly: 335.04
     urx: 273.48
     ury: 346.2
   width: 41.4
  height: 11.16


29 Procedure Code9: 
     llx: 274.8
     lly: 335.04
     urx: 316.68
     ury: 346.2
   width: 41.88
  height: 11.16


29a Diag Pointer9: 
     llx: 318
     lly: 335.04
     urx: 352.92
     ury: 346.2
   width: 34.92
  height: 11.16


29b Qty9: 
     llx: 354.24
     lly: 335.04
     urx: 374.4
     ury: 346.2
   width: 20.16
  height: 11.16


30 Description9: 
     llx: 375.72
     lly: 335.04
     urx: 547.44
     ury: 346.2
   width: 171.72
  height: 11.16


31 Fee9: 
     llx: 548.88
     lly: 335.04
     urx: 597.36
     ury: 346.2
   width: 48.48
  height: 11.16',
'

24 Procedure Date MMDDYYYY10: 
     llx: 25.68
     lly: 323.28
     urx: 101.16
     ury: 334.2
   width: 75.48
  height: 10.92


25 Area of Oral Cavity10: 
     llx: 102.24
     lly: 323.28
     urx: 123.12
     ury: 334.2
   width: 20.88
  height: 10.92


26 Tooth System10: 
     llx: 124.2
     lly: 323.28
     urx: 144.36
     ury: 334.2
   width: 20.16
  height: 10.92


27 Tooth Numbers or Letters10: 
     llx: 145.44
     lly: 323.28
     urx: 230.88
     ury: 334.2
   width: 85.44
  height: 10.92


28 Tooth Surface10: 
     llx: 231.96
     lly: 323.28
     urx: 273.6
     ury: 334.2
   width: 41.64
  height: 10.92


29 Procedure Code10: 
     llx: 274.68
     lly: 323.28
     urx: 316.8
     ury: 334.2
   width: 42.12
  height: 10.92


29a Diag Pointer10: 
     llx: 317.88
     lly: 323.28
     urx: 353.04
     ury: 334.2
   width: 35.16
  height: 10.92


29b Qty10: 
     llx: 354.12
     lly: 323.28
     urx: 374.52
     ury: 334.2
   width: 20.4
  height: 10.92


30 Description10: 
     llx: 375.6
     lly: 323.28
     urx: 547.56
     ury: 334.2
   width: 171.96
  height: 10.92


31 Fee10: 
     llx: 548.76
     lly: 323.28
     urx: 597.48
     ury: 334.2
   width: 48.72
  height: 10.92',







];
    private $teeth_slots = [
'

T1: 
     llx: 25.5668
     lly: 301.638
     urx: 33.9559
     ury: 309.427
   width: 8.3891
  height: 7.789',
'

T2: 
     llx: 39.6485
     lly: 301.737
     urx: 48.0376
     ury: 309.527
   width: 8.3891
  height: 7.79',
'

T3: 
     llx: 53.4513
     lly: 301.698
     urx: 61.8404
     ury: 309.488
   width: 8.3891
  height: 7.79',
'

T4: 
     llx: 68.2529
     lly: 301.768
     urx: 76.642
     ury: 309.558
   width: 8.3891
  height: 7.79',
'

T5: 
     llx: 82.5714
     lly: 301.658
     urx: 90.9605
     ury: 309.448
   width: 8.3891
  height: 7.79',
'

T6: 
     llx: 96.6531
     lly: 301.758
     urx: 105.042
     ury: 309.548
   width: 8.3889
  height: 7.79',
'

T7: 
     llx: 110.456
     lly: 301.719
     urx: 118.845
     ury: 309.509
   width: 8.389
  height: 7.79',
'

T8: 
     llx: 125.258
     lly: 301.789
     urx: 133.647
     ury: 309.579
   width: 8.389
  height: 7.79',
'

T9: 
     llx: 141.015
     lly: 301.757
     urx: 149.404
     ury: 309.547
   width: 8.389
  height: 7.79',
'

T10: 
     llx: 155.096
     lly: 301.857
     urx: 163.485
     ury: 309.647
   width: 8.389
  height: 7.79',
'

T11: 
     llx: 168.899
     lly: 301.818
     urx: 177.288
     ury: 309.607
   width: 8.389
  height: 7.789',
'

T12: 
     llx: 183.701
     lly: 301.888
     urx: 192.09
     ury: 309.677
   width: 8.389
  height: 7.789',
'

T13: 
     llx: 198.019
     lly: 301.778
     urx: 206.408
     ury: 309.568
   width: 8.389
  height: 7.79',
'

T14: 
     llx: 212.101
     lly: 301.878
     urx: 220.49
     ury: 309.667
   width: 8.389
  height: 7.789',
'

T15: 
     llx: 225.904
     lly: 301.838
     urx: 234.293
     ury: 309.628
   width: 8.389
  height: 7.79',
'

T16: 
     llx: 240.705
     lly: 301.908
     urx: 249.094
     ury: 309.698
   width: 8.389
  height: 7.79',
'

T17: 
     llx: 240.611
     lly: 289.641
     urx: 249
     ury: 297.431
   width: 8.389
  height: 7.79',
'

T18: 
     llx: 225.809
     lly: 289.571
     urx: 234.199
     ury: 297.361
   width: 8.39
  height: 7.79',
'

T19: 
     llx: 212.007
     lly: 289.61
     urx: 220.396
     ury: 297.4
   width: 8.389
  height: 7.79',
'

T20: 
     llx: 197.925
     lly: 289.51
     urx: 206.314
     ury: 297.3
   width: 8.389
  height: 7.79',
'

T21: 
     llx: 183.606
     lly: 289.62
     urx: 191.995
     ury: 297.41
   width: 8.389
  height: 7.79',
'

T22: 
     llx: 168.805
     lly: 289.55
     urx: 177.194
     ury: 297.34
   width: 8.389
  height: 7.79',
'

T23: 
     llx: 155.002
     lly: 289.589
     urx: 163.391
     ury: 297.379
   width: 8.389
  height: 7.79',
'

T24: 
     llx: 140.92
     lly: 289.489
     urx: 149.309
     ury: 297.279
   width: 8.389
  height: 7.79',
'

T25: 
     llx: 125.163
     lly: 289.521
     urx: 133.552
     ury: 297.311
   width: 8.389
  height: 7.79',
'

T26: 
     llx: 110.362
     lly: 289.451
     urx: 118.751
     ury: 297.241
   width: 8.389
  height: 7.79',
'

T27: 
     llx: 96.5588
     lly: 289.491
     urx: 104.948
     ury: 297.28
   width: 8.3892
  height: 7.789',
'

T28: 
     llx: 82.4771
     lly: 289.391
     urx: 90.8662
     ury: 297.181
   width: 8.3891
  height: 7.79',
'

T29: 
     llx: 68.1586
     lly: 289.501
     urx: 76.5477
     ury: 297.29
   width: 8.3891
  height: 7.789',
'

T30: 
     llx: 53.357
     lly: 289.431
     urx: 61.7461
     ury: 297.22
   width: 8.3891
  height: 7.789',
'

T31: 
     llx: 39.5542
     lly: 289.47
     urx: 47.9433
     ury: 297.26
   width: 8.3891
  height: 7.79',
'

T32: 
     llx: 25.4725
     lly: 289.37
     urx: 33.8616
     ury: 297.16
   width: 8.3891
  height: 7.79',
];

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
            $services_list['24 Procedure Date MMDDYYYY'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->DOS->format('m/d/y'),
            ];
            $services_list['25 Area of Oral Cavity'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->dental->oral_cavity,
            ];
            $services_list['26 Tooth System'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->dental->tooth_system,
            ];
            $services_list['27 Tooth Numbers or Letters'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->dental->tooth_numbers,
            ];
            $services_list['28 Tooth Surface'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->dental->tooth_surfaces,
            ];
            $services_list['29 Procedure Code'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $code,
            ];
            $services_list['30 Description'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $modifier,
            ];
            $services_list['29a Diag Pointer'.($i + 1)] = [
                'size' => 7,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->pointers_alphabet,
            ];
            $services_list['31 Fee'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => number_format($services[$i]->total_discounted_price, 2),
            ];
            $services_list['29b Qty'.($i + 1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $services[$i]->quantity,
            ];
	   $services_list['T'.($services[$i]->dental->tooth_numbers)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => 'X',
            ];
        }

        $total_services = ['Invoice_Total' => [
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

        $coordinates = $this->addTeethSlots($services);

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
            $this->coordinates = $this->coordinates.$this->diagnoses_slots[$i];
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

    private function addTeethSlots($services)
    {
        $coordinates = $this->coordinates;
        for ($i = 0; $i < count($services); ++$i) {
            //get number from array
            $n = (int)$services[$i]->dental->tooth_numbers;
            //search for it in slots
            $coordinates = $coordinates.$this->teeth_slots[($n - 1)];
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
            ],
	   'DENTIST_SIGNATURE_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->DOS->format('m/d/y'),
            ],
	   'PATIENT_SIGNATURE_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->DOS->format('m/d/y'),
            ],
	   'SUBSCRIBER_SIGNATURE_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->DOS->format('m/d/y'),
            ],
	    'DENTIST_LICENSE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->dental_details->license,
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
	   'Preauthorization' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => '',
            ],
            'Remarks' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => $this->invoice->comments,
            ],
            'Enclosures' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => ($this->invoice->dental_details->enclosures) ? 'Y' : 'N',
            ],
            'Ortho_No' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => ($this->invoice->dental_details->orthodontics) ? '' : 'X',
            ],
            'Ortho_Yes' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => ($this->invoice->dental_details->orthodontics) ? 'X' : '',
            ],
            'Appliance_Placed' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => ($this->invoice->dental_details->orthodontics) ? $this->invoice->dental_details->appliance_placed->format('m/d/y') : '',
            ],
            'Months_Treatment' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => ($this->invoice->dental_details->orthodontics) ? $this->invoice->dental_details->months_remaining : '',
            ],
            'Replacement_Yes' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => ($this->invoice->dental_details->prosthesis_replacement) ? 'X' : '',
            ],
            'Replacement_No' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => ($this->invoice->dental_details->prosthesis_replacement) ? '' : 'X',
            ],
            'Prior_Placement' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => ($this->invoice->dental_details->prosthesis_replacement) ? $this->invoice->dental_details->prior_placement->format('m/d/y') : '',
            ],
            'T_0' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (0 == $this->invoice->dental_details->treatment_resulting_from) ? 'x' : '',
            ],
            'T_1' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (1 == $this->invoice->dental_details->treatment_resulting_from) ? 'x' : '',
            ],
            'T_2' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (0 == $this->invoice->dental_details->treatment_resulting_from) ? 'x' : '',
            ],
            'Accident_Date' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (1 == $this->invoice->dental_details->treatment_resulting_from) ? $this->invoice->dental_details->accident->format('m/d/y') : '',
            ],
            'Accident_State' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => 'B',
                'value' => (1 == $this->invoice->dental_details->treatment_resulting_from) ? $this->invoice->dental_details->auto_accident_state : '',
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
                'Child' => [
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
                'Child' => [
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

        for ($i = 0; $i < count($this->invoice->diagnoses); ++$i) {
            $diagnosis_list['Diagnosis_'.($i+1)] = [
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