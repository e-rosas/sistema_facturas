<?php

namespace App\Actions;

use App\Insuree;
use App\Invoice;
use FormFiller\PDF\Converter\Converter;
use FormFiller\PDF\Field;
use App\Actions\PDFGeneratorLocal;
use Illuminate\Support\Facades\Storage;

class FillDentalFormPDF
{
    private $coordinates = '184 widget annotations found on page 1.
----------------------------------------------

Preauthorization: 
     llx: 93.884
     lly: 698.66101
     urx: 238.084
     ury: 708.19202
   width: 144.2
  height: 9.5310099999999


Company_Name: 
     llx: 20.1756
     lly: 661.10303
     urx: 297.11899
     ury: 672.04401
   width: 276.94339
  height: 10.94098


Company_Address: 
     llx: 19.9398
     lly: 649.70697
     urx: 297.67099
     ury: 660.24902
   width: 277.73119
  height: 10.54205


Company_City_State_Zip: 
     llx: 20.7595
     lly: 637.79602
     urx: 296.927
     ury: 648.60901
   width: 276.1675
  height: 10.81299


Insurer_Name: 
     llx: 305.53201
     lly: 687.07599
     urx: 594.13202
     ury: 697.289
   width: 288.60001
  height: 10.21301


Insurer_Address: 
     llx: 305.922
     lly: 674.43903
     urx: 593.12402
     ury: 684.25299
   width: 287.20202
  height: 9.81396


Insurer_City_State_Zip: 
     llx: 306.742
     lly: 661.435
     urx: 592.745
     ury: 672.24799
   width: 286.003
  height: 10.81299


Insurer_DOB: 
     llx: 306.07101
     lly: 625.35602
     urx: 402.47699
     ury: 635.44501
   width: 96.40598
  height: 10.08899


Insurer_M: 
     llx: 408.56601
     lly: 624.729
     urx: 418.39301
     ury: 634.08002
   width: 6.827
  height: 9.3510199999999


Insurer_F: 
     llx: 422.35699
     lly: 625.82098
     urx: 432.91299
     ury: 634.08002
   width: 7.556
  height: 8.25904


Insurer_U: 
     llx: 441.21399
     lly: 624.729
     urx: 447.31299
     ury: 634.08002
   width: 6.099
  height: 9.3510199999999


Insurance_ID: 
     llx: 468.42401
     lly: 622.96002
     urx: 591.23602
     ury: 635.44501
   width: 122.81201
  height: 12.48499


Insurer_Policy_Number: 
     llx: 306.87
     lly: 600.15802
     urx: 396.27701
     ury: 611.08398
   width: 89.40701
  height: 10.92596


Self: 
     llx: 316.27301
     lly: 563.88
     urx: 326.11301
     ury: 573.35999
   width: 9.84
  height: 9.47999


Spouse: 
     llx: 352.03299
     lly: 563.88
     urx: 361.87299
     ury: 573.35999
   width: 9.84
  height: 9.47999


Dependent Child: 
     llx: 395.353
     lly: 563.88
     urx: 405.19299
     ury: 573.35999
   width: 9.83999
  height: 9.47999


Other: 
     llx: 460.27301
     lly: 563.88
     urx: 470.11301
     ury: 573.35999
   width: 9.84
  height: 9.47999


Patient_DOB: 
     llx: 309.06699
     lly: 479.07901
     urx: 403.07599
     ury: 492.24301
   width: 94.009
  height: 13.164


Patient_M: 
     llx: 407.59299
     lly: 480.35999
     urx: 418.513
     ury: 490.44
   width: 7.92001
  height: 10.08001


Patient_F: 
     llx: 422.11301
     lly: 480.35999
     urx: 433.03299
     ury: 490.44
   width: 7.91998
  height: 10.08001


Patient_U: 
     llx: 439.513
     lly: 480.35999
     urx: 447.43301
     ury: 490.44
   width: 7.92001
  height: 10.08001


Patient_Insurance: 
     llx: 461.83301
     lly: 478.67899
     urx: 593.23297
     ury: 491.64401
   width: 131.39996
  height: 12.96502


Patient_Name: 
     llx: 304.005
     lly: 542.35901
     urx: 592.60498
     ury: 552.57202
   width: 288.59998
  height: 10.21301


Patient_Address: 
     llx: 304.39499
     lly: 529.72198
     urx: 591.59698
     ury: 539.53601
   width: 287.20199
  height: 9.81403


Patient_City_State_Zip: 
     llx: 305.215
     lly: 516.71802
     urx: 591.21802
     ury: 527.53101
   width: 286.00302
  height: 10.81299


Invoice_Total: 
     llx: 546.99402
     lly: 287.04001
     urx: 592.98901
     ury: 298.79999
   width: 45.99499
  height: 11.75998


Enclosures: 
     llx: 515.89697
     lly: 228.718
     urx: 525.95001
     ury: 238.696
   width: 10.05304
  height: 9.978


Ortho_No: 
     llx: 315.064
     lly: 205.67999
     urx: 324.90399
     ury: 215.28
   width: 9.83999
  height: 9.60001


Ortho_Yes: 
     llx: 379.74399
     lly: 205.67999
     urx: 389.58401
     ury: 215.28
   width: 9.84002
  height: 9.60001


Appliance_Placed: 
     llx: 493.59201
     lly: 206.92
     urx: 579.55402
     ury: 217.28799
   width: 85.96201
  height: 10.36799


Months_Treatment: 
     llx: 324.28299
     lly: 183.48
     urx: 365.10901
     ury: 192.035
   width: 40.82602
  height: 8.555


Replacement_No: 
     llx: 378.918
     lly: 180.52
     urx: 390.078
     ury: 190.39301
   width: 11.16
  height: 9.87301


Replacement_Yes: 
     llx: 401.104
     lly: 180.52
     urx: 410.944
     ury: 190.12
   width: 9.84
  height: 9.6


Prior_Placement: 
     llx: 491.242
     lly: 182.117
     urx: 573.56097
     ury: 192.76401
   width: 82.31897
  height: 10.64701


T_0: 
     llx: 315.064
     lly: 156.84
     urx: 324.90399
     ury: 166.44
   width: 9.83999
  height: 9.6


T_1: 
     llx: 422.58401
     lly: 156.84
     urx: 432.42401
     ury: 166.44
   width: 9.84
  height: 9.6


T_2: 
     llx: 494.58401
     lly: 156.36
     urx: 504.42401
     ury: 165.96001
   width: 9.84
  height: 9.60001


Accident_Date: 
     llx: 401.5
     lly: 145.599
     urx: 498.103
     ury: 154.28101
   width: 96.603
  height: 8.68201


DENTIST_SIGNATURE: 
     llx: 306.784
     lly: 94.68
     urx: 470.37299
     ury: 104.4
   width: 163.58899
  height: 9.72


DENTIST_SIGNATURE_DATE: 
     llx: 548.70901
     lly: 95.7052
     urx: 577.40698
     ury: 106.491
   width: 78.69797
  height: 10.7858


Accident_State: 
     llx: 568.31897
     lly: 145.44099
     urx: 590.69
     ury: 153.42999
   width: 22.37103
  height: 7.989


DENTIST_LICENSE: 
     llx: 502.81601
     lly: 73.9579
     urx: 591.13702
     ury: 82.8727
   width: 88.32101
  height: 8.9148


PATIENT_SIGNATURE_DATE: 
     llx: 187.989
     lly: 201.709
     urx: 257.89801
     ury: 212.495
   width: 69.90901
  height: 10.786


SUBSCRIBER_SIGNATURE_DATE: 
     llx: 187.689
     lly: 155.075
     urx: 257.599
     ury: 165.86099
   width: 69.91
  height: 10.78599


License_Number: 
     llx: 106.761
     lly: 40.6351
     urx: 198.44099
     ury: 49.4431
   width: 91.67999
  height: 8.808';

    private $invoice;
    private $data;
    private $invoice_data;
    private $diagnoses_slots = ['

Diagnosis_1: 
     llx: 358.15701
     lly: 300.22699
     urx: 417.19699
     ury: 309.94699
   width: 59.03998
  height: 9.72',
'

Diagnosis_2: 
     llx: 358.15701
     lly: 287.987
     urx: 417.19699
     ury: 297.707
   width: 59.03998
  height: 9.72',
'

Diagnosis_3: 
     llx: 435.677
     lly: 300.22699
     urx: 494.83701
     ury: 309.94699
   width: 59.16001
  height: 9.72',
'

Diagnosis_4: 
     llx: 435.677
     lly: 287.987
     urx: 494.71701
     ury: 297.707
   width: 59.04001
  height: 9.72'];
    private $service_slots = [
'

24_Procedure_Date_MMDDYYYY1: 
     llx: 21.84
     lly: 432.12
     urx: 97.08
     ury: 443.28
   width: 75.24
  height: 11.16


25_Area_of_Oral_Cavity1: 
     llx: 98.4
     lly: 432.12
     urx: 119.04
     ury: 443.28
   width: 20.64
  height: 11.16


26_Tooth_System1: 
     llx: 120.36
     lly: 432.12
     urx: 140.28
     ury: 443.28
   width: 19.92
  height: 11.16


27_Tooth_Numbers_or_Letters1: 
     llx: 141.60001
     lly: 432.12
     urx: 226.8
     ury: 443.28
   width: 85.19999
  height: 11.16


28_Tooth_Surface1: 
     llx: 228.12
     lly: 432.12
     urx: 269.51999
     ury: 443.28
   width: 41.39999
  height: 11.16


29_Procedure_Code1: 
     llx: 270.84
     lly: 432.12
     urx: 312.72
     ury: 443.28
   width: 41.88
  height: 11.16


29a_Diag_Pointer1: 
     llx: 314.04001
     lly: 432.12
     urx: 348.95999
     ury: 443.28
   width: 34.91998
  height: 11.16


29b_Qty1: 
     llx: 350.28
     lly: 432.12
     urx: 370.44
     ury: 443.28
   width: 20.16
  height: 11.16


30_Description1: 
     llx: 371.76001
     lly: 432.12
     urx: 543.47998
     ury: 443.28
   width: 171.71997
  height: 11.16


31_Fee1: 
     llx: 544.91998
     lly: 432.12
     urx: 593.40002
     ury: 443.28
   width: 48.48004
  height: 11.16',
'

24_Procedure_Date_MMDDYYYY2: 
     llx: 21.84
     lly: 419.88
     urx: 97.08
     ury: 431.16
   width: 75.24
  height: 11.28


25_Area_of_Oral_Cavity2: 
     llx: 98.4
     lly: 419.88
     urx: 119.04
     ury: 431.16
   width: 20.64
  height: 11.28


26_Tooth_System2: 
     llx: 120.36
     lly: 419.88
     urx: 140.28
     ury: 431.16
   width: 19.92
  height: 11.28


27_Tooth_Numbers_or_Letters2: 
     llx: 141.60001
     lly: 419.88
     urx: 226.8
     ury: 431.16
   width: 85.19999
  height: 11.28


28_Tooth_Surface2: 
     llx: 228.12
     lly: 419.88
     urx: 269.51999
     ury: 431.16
   width: 41.39999
  height: 11.28


29_Procedure_Code2: 
     llx: 270.84
     lly: 419.88
     urx: 312.72
     ury: 431.16
   width: 41.88
  height: 11.28


29a_Diag_Pointer2: 
     llx: 314.04001
     lly: 419.88
     urx: 348.95999
     ury: 431.16
   width: 34.91998
  height: 11.28


29b_Qty2: 
     llx: 350.28
     lly: 419.88
     urx: 370.44
     ury: 431.16
   width: 20.16
  height: 11.28


30_Description2: 
     llx: 371.76001
     lly: 419.88
     urx: 543.47998
     ury: 431.16
   width: 171.71997
  height: 11.28


31_Fee2: 
     llx: 544.91998
     lly: 419.88
     urx: 593.40002
     ury: 431.16
   width: 48.48004
  height: 11.28',
'

24_Procedure_Date_MMDDYYYY3: 
     llx: 21.84
     lly: 407.76001
     urx: 97.08
     ury: 418.92001
   width: 75.24
  height: 11.16


25_Area_of_Oral_Cavity3: 
     llx: 98.4
     lly: 407.76001
     urx: 119.04
     ury: 418.92001
   width: 20.64
  height: 11.16


26_Tooth_System3: 
     llx: 120.36
     lly: 407.76001
     urx: 140.28
     ury: 418.92001
   width: 19.92
  height: 11.16


27_Tooth_Numbers_or_Letters3: 
     llx: 141.60001
     lly: 407.76001
     urx: 226.8
     ury: 418.92001
   width: 85.19999
  height: 11.16


28_Tooth_Surface3: 
     llx: 228.12
     lly: 407.76001
     urx: 269.51999
     ury: 418.92001
   width: 41.39999
  height: 11.16


29_Procedure_Code3: 
     llx: 270.84
     lly: 407.76001
     urx: 312.72
     ury: 418.92001
   width: 41.88
  height: 11.16


29a_Diag_Pointer3: 
     llx: 314.04001
     lly: 407.76001
     urx: 348.95999
     ury: 418.92001
   width: 34.91998
  height: 11.16


29b_Qty3: 
     llx: 350.28
     lly: 407.76001
     urx: 370.44
     ury: 418.92001
   width: 20.16
  height: 11.16


30_Description3: 
     llx: 371.76001
     lly: 407.76001
     urx: 543.47998
     ury: 418.92001
   width: 171.71997
  height: 11.16


31_Fee3: 
     llx: 544.91998
     lly: 407.76001
     urx: 593.40002
     ury: 418.92001
   width: 48.48004
  height: 11.16',
'

24_Procedure_Date_MMDDYYYY4: 
     llx: 21.84
     lly: 395.64001
     urx: 97.08
     ury: 406.79999
   width: 75.24
  height: 11.15998


25_Area_of_Oral_Cavity4: 
     llx: 98.4
     lly: 395.64001
     urx: 119.04
     ury: 406.79999
   width: 20.64
  height: 11.15998


26_Tooth_System4: 
     llx: 120.36
     lly: 395.64001
     urx: 140.28
     ury: 406.79999
   width: 19.92
  height: 11.15998


27_Tooth_Numbers_or_Letters4: 
     llx: 141.60001
     lly: 395.64001
     urx: 226.8
     ury: 406.79999
   width: 85.19999
  height: 11.15998


28_Tooth_Surface4: 
     llx: 228.12
     lly: 395.64001
     urx: 269.51999
     ury: 406.79999
   width: 41.39999
  height: 11.15998


29_Procedure_Code4: 
     llx: 270.84
     lly: 395.64001
     urx: 312.72
     ury: 406.79999
   width: 41.88
  height: 11.15998


29a_Diag_Pointer4: 
     llx: 314.04001
     lly: 395.64001
     urx: 348.95999
     ury: 406.79999
   width: 34.91998
  height: 11.15998


29b_Qty4: 
     llx: 350.28
     lly: 395.64001
     urx: 370.44
     ury: 406.79999
   width: 20.16
  height: 11.15998


30_Description4: 
     llx: 371.76001
     lly: 395.64001
     urx: 543.47998
     ury: 406.79999
   width: 171.71997
  height: 11.15998


31_Fee4: 
     llx: 544.91998
     lly: 395.64001
     urx: 593.40002
     ury: 406.79999
   width: 48.48004
  height: 11.15998',
'

24_Procedure_Date_MMDDYYYY5: 
     llx: 21.84
     lly: 383.51999
     urx: 97.08
     ury: 394.67999
   width: 75.24
  height: 11.16


25_Area_of_Oral_Cavity5: 
     llx: 98.4
     lly: 383.51999
     urx: 119.04
     ury: 394.67999
   width: 20.64
  height: 11.16


26_Tooth_System5: 
     llx: 120.36
     lly: 383.51999
     urx: 140.28
     ury: 394.67999
   width: 19.92
  height: 11.16


27_Tooth_Numbers_or_Letters5: 
     llx: 141.60001
     lly: 383.51999
     urx: 226.8
     ury: 394.67999
   width: 85.19999
  height: 11.16


28_Tooth_Surface5: 
     llx: 228.12
     lly: 383.51999
     urx: 269.51999
     ury: 394.67999
   width: 41.39999
  height: 11.16


29_Procedure_Code5: 
     llx: 270.84
     lly: 383.51999
     urx: 312.72
     ury: 394.67999
   width: 41.88
  height: 11.16


29a_Diag_Pointer5: 
     llx: 314.04001
     lly: 383.51999
     urx: 348.95999
     ury: 394.67999
   width: 34.91998
  height: 11.16


29b_Qty5: 
     llx: 350.28
     lly: 383.51999
     urx: 370.44
     ury: 394.67999
   width: 20.16
  height: 11.16


30_Description5: 
     llx: 371.76001
     lly: 383.51999
     urx: 543.47998
     ury: 394.67999
   width: 171.71997
  height: 11.16


31_Fee5: 
     llx: 544.91998
     lly: 383.51999
     urx: 593.40002
     ury: 394.67999
   width: 48.48004
  height: 11.16',
'

24_Procedure_Date_MMDDYYYY6: 
     llx: 21.84
     lly: 371.39999
     urx: 97.08
     ury: 382.56
   width: 75.24
  height: 11.16001


25_Area_of_Oral_Cavity6: 
     llx: 98.4
     lly: 371.39999
     urx: 119.04
     ury: 382.56
   width: 20.64
  height: 11.16001


26_Tooth_System6: 
     llx: 120.36
     lly: 371.39999
     urx: 140.28
     ury: 382.56
   width: 19.92
  height: 11.16001


27_Tooth_Numbers_or_Letters6: 
     llx: 141.60001
     lly: 371.39999
     urx: 226.8
     ury: 382.56
   width: 85.19999
  height: 11.16001


28_Tooth_Surface6: 
     llx: 228.12
     lly: 371.39999
     urx: 269.51999
     ury: 382.56
   width: 41.39999
  height: 11.16001


29_Procedure_Code6: 
     llx: 270.84
     lly: 371.39999
     urx: 312.72
     ury: 382.56
   width: 41.88
  height: 11.16001


29a_Diag_Pointer6: 
     llx: 314.04001
     lly: 371.39999
     urx: 348.95999
     ury: 382.56
   width: 34.91998
  height: 11.16001


29b_Qty6: 
     llx: 350.28
     lly: 371.39999
     urx: 370.44
     ury: 382.56
   width: 20.16
  height: 11.16001


30_Description6: 
     llx: 371.76001
     lly: 371.39999
     urx: 543.47998
     ury: 382.56
   width: 171.71997
  height: 11.16001


31_Fee6: 
     llx: 544.91998
     lly: 371.39999
     urx: 593.40002
     ury: 382.56
   width: 48.48004
  height: 11.16',
'

24_Procedure_Date_MMDDYYYY7: 
     llx: 21.84
     lly: 359.28
     urx: 97.08
     ury: 370.44
   width: 75.24
  height: 11.16


25_Area_of_Oral_Cavity7: 
     llx: 98.4
     lly: 359.28
     urx: 119.04
     ury: 370.44
   width: 20.64
  height: 11.16


26_Tooth_System7: 
     llx: 120.36
     lly: 359.28
     urx: 140.28
     ury: 370.44
   width: 19.92
  height: 11.16


27_Tooth_Numbers_or_Letters7: 
     llx: 141.60001
     lly: 359.28
     urx: 226.8
     ury: 370.44
   width: 85.19999
  height: 11.16


28_Tooth_Surface7: 
     llx: 228.12
     lly: 359.28
     urx: 269.51999
     ury: 370.44
   width: 41.39999
  height: 11.16


29_Procedure_Code7: 
     llx: 270.84
     lly: 359.28
     urx: 312.72
     ury: 370.44
   width: 41.88
  height: 11.16


29a_Diag_Pointer7: 
     llx: 314.04001
     lly: 359.28
     urx: 348.95999
     ury: 370.44
   width: 34.91998
  height: 11.16


29b_Qty7: 
     llx: 350.28
     lly: 359.28
     urx: 370.44
     ury: 370.44
   width: 20.16
  height: 11.16


30_Description7: 
     llx: 371.76001
     lly: 359.28
     urx: 543.47998
     ury: 370.44
   width: 171.71997
  height: 11.16


31_Fee7: 
     llx: 544.91998
     lly: 359.28
     urx: 593.40002
     ury: 370.44
   width: 48.48004
  height: 11.16',
'

24_Procedure_Date_MMDDYYYY8: 
     llx: 21.84
     lly: 347.16
     urx: 97.08
     ury: 358.32001
   width: 75.24
  height: 11.16001


25_Area_of_Oral_Cavity8: 
     llx: 98.4
     lly: 347.16
     urx: 119.04
     ury: 358.32001
   width: 20.64
  height: 11.16001


26_Tooth_System8: 
     llx: 120.36
     lly: 347.16
     urx: 140.28
     ury: 358.32001
   width: 19.92
  height: 11.16001


27_Tooth_Numbers_or_Letters8: 
     llx: 141.60001
     lly: 347.16
     urx: 226.8
     ury: 358.32001
   width: 85.19999
  height: 11.16001


28_Tooth_Surface8: 
     llx: 228.12
     lly: 347.16
     urx: 269.51999
     ury: 358.32001
   width: 41.39999
  height: 11.16001


29_Procedure_Code8: 
     llx: 270.84
     lly: 347.16
     urx: 312.72
     ury: 358.32001
   width: 41.88
  height: 11.16001


29a_Diag_Pointer8: 
     llx: 314.04001
     lly: 347.16
     urx: 348.95999
     ury: 358.32001
   width: 34.91998
  height: 11.16001


29b_Qty8: 
     llx: 350.28
     lly: 347.16
     urx: 370.44
     ury: 358.32001
   width: 20.16
  height: 11.16001


30_Description8: 
     llx: 371.76001
     lly: 347.16
     urx: 543.47998
     ury: 358.32001
   width: 171.71997
  height: 11.16001


31_Fee8: 
     llx: 544.91998
     lly: 347.16
     urx: 593.40002
     ury: 358.32001
   width: 48.48004
  height: 11.16001',
'

24_Procedure_Date_MMDDYYYY9: 
     llx: 21.84
     lly: 335.04001
     urx: 97.08
     ury: 346.20001
   width: 75.24
  height: 11.16


25_Area_of_Oral_Cavity9: 
     llx: 98.4
     lly: 335.04001
     urx: 119.04
     ury: 346.20001
   width: 20.64
  height: 11.16


26_Tooth_System9: 
     llx: 120.36
     lly: 335.04001
     urx: 140.28
     ury: 346.20001
   width: 19.92
  height: 11.16


27_Tooth_Numbers_or_Letters9: 
     llx: 141.60001
     lly: 335.04001
     urx: 226.8
     ury: 346.20001
   width: 85.19999
  height: 11.16


28_Tooth_Surface9: 
     llx: 228.12
     lly: 335.04001
     urx: 269.51999
     ury: 346.20001
   width: 41.39999
  height: 11.16


29_Procedure_Code9: 
     llx: 270.84
     lly: 335.04001
     urx: 312.72
     ury: 346.20001
   width: 41.88
  height: 11.16


29a_Diag_Pointer9: 
     llx: 314.04001
     lly: 335.04001
     urx: 348.95999
     ury: 346.20001
   width: 34.91998
  height: 11.16


29b_Qty9: 
     llx: 350.28
     lly: 335.04001
     urx: 370.44
     ury: 346.20001
   width: 20.16
  height: 11.16


30_Description9: 
     llx: 371.76001
     lly: 335.04001
     urx: 543.47998
     ury: 346.20001
   width: 171.71997
  height: 11.16


31_Fee9: 
     llx: 544.91998
     lly: 335.04001
     urx: 593.40002
     ury: 346.20001
   width: 48.48004
  height: 11.16',
'

24_Procedure_Date_MMDDYYYY10: 
     llx: 21.72
     lly: 323.28
     urx: 97.2
     ury: 334.20001
   width: 75.48
  height: 10.92001


25_Area_of_Oral_Cavity10: 
     llx: 98.28
     lly: 323.28
     urx: 119.16
     ury: 334.20001
   width: 20.88
  height: 10.92001


26_Tooth_System10: 
     llx: 120.24
     lly: 323.28
     urx: 140.39999
     ury: 334.20001
   width: 20.15999
  height: 10.92001


27_Tooth_Numbers_or_Letters10: 
     llx: 141.48
     lly: 323.28
     urx: 226.92
     ury: 334.20001
   width: 85.44
  height: 10.92001


28_Tooth_Surface10: 
     llx: 228
     lly: 323.28
     urx: 269.64001
     ury: 334.20001
   width: 41.64001
  height: 10.92001


29_Procedure_Code10: 
     llx: 270.72
     lly: 323.28
     urx: 312.84
     ury: 334.20001
   width: 42.12
  height: 10.92001


29a_Diag_Pointer10: 
     llx: 313.92001
     lly: 323.28
     urx: 349.07999
     ury: 334.20001
   width: 35.15998
  height: 10.92001


29b_Qty10: 
     llx: 350.16
     lly: 323.28
     urx: 370.56
     ury: 334.20001
   width: 20.4
  height: 10.92001


30_Description10: 
     llx: 371.64001
     lly: 323.28
     urx: 543.59998
     ury: 334.20001
   width: 171.95997
  height: 10.92001


31_Fee10: 
     llx: 544.79999
     lly: 323.28
     urx: 593.52002
     ury: 334.20001
   width: 48.72003
  height: 10.92001',

];
    private $teeth_slots = [
'

T1: 
     llx: 19.924
     lly: 298.54501
     urx: 30.313
     ury: 308.33401
   width: 8.389
  height: 7.789',
'

T2: 
     llx: 34.0056
     lly: 298.64401
     urx: 44.3947
     ury: 308.43399
   width: 8.3891
  height: 7.78998',
'

T3: 
     llx: 47.8085
     lly: 298.60501
     urx: 58.1976
     ury: 308.39499
   width: 8.3891
  height: 7.78998',
'

T4: 
     llx: 62.61
     lly: 298.67499
     urx: 72.9991
     ury: 308.465
   width: 8.3891
  height: 7.79001',
'

T5: 
     llx: 76.9286
     lly: 298.565
     urx: 87.3177
     ury: 308.35501
   width: 8.3891
  height: 7.79001',
'

T6: 
     llx: 91.0103
     lly: 300.66501
     urx: 101.399
     ury: 308.45499
   width: 8.3887
  height: 7.78998',
'

T7: 
     llx: 104.813
     lly: 298.62601
     urx: 115.202
     ury: 308.41599
   width: 8.389
  height: 7.78998',
'

T8: 
     llx: 119.615
     lly: 298.69601
     urx: 130.004
     ury: 308.48599
   width: 8.389
  height: 7.78998',
'

T9: 
     llx: 133.37199
     lly: 298.664
     urx: 145.761
     ury: 308.45401
   width: 8.38901
  height: 7.79001',
'

T10: 
     llx: 149.453
     lly: 298.76401
     urx: 159.842
     ury: 308.55399
   width: 8.389
  height: 7.78998',
'

T11: 
     llx: 163.256
     lly: 298.72501
     urx: 173.645
     ury: 308.51401
   width: 8.389
  height: 7.789',
'

T12: 
     llx: 178.058
     lly: 298.79501
     urx: 188.44701
     ury: 308.58401
   width: 8.38901
  height: 7.789',
'

T13: 
     llx: 192.37601
     lly: 298.685
     urx: 202.765
     ury: 308.47501
   width: 8.38899
  height: 7.79001',
'

T14: 
     llx: 206.45799
     lly: 298.785
     urx: 216.847
     ury: 308.57401
   width: 8.38901
  height: 7.78901',
'

T15: 
     llx: 220.261
     lly: 298.745
     urx: 230.64999
     ury: 308.535
   width: 8.38899
  height: 7.79',
'

T16: 
     llx: 235.062
     lly: 298.815
     urx: 245.451
     ury: 308.60501
   width: 8.389
  height: 7.79001',
'

T17: 
     llx: 234.968
     lly: 286.548
     urx: 245.35699
     ury: 296.33801
   width: 8.38899
  height: 7.79001',
'

T18: 
     llx: 220.166
     lly: 286.478
     urx: 230.556
     ury: 296.26801
   width: 8.39
  height: 7.79001',
'

T19: 
     llx: 206.364
     lly: 286.517
     urx: 216.75301
     ury: 296.30701
   width: 8.38901
  height: 7.79001',
'

T20: 
     llx: 192.282
     lly: 286.41699
     urx: 202.67101
     ury: 296.207
   width: 8.38901
  height: 7.79001',
'

T21: 
     llx: 177.963
     lly: 286.52701
     urx: 188.35201
     ury: 296.31699
   width: 8.38901
  height: 7.78998',
'

T22: 
     llx: 163.162
     lly: 286.457
     urx: 173.55099
     ury: 296.24701
   width: 8.38899
  height: 7.79001',
'

T23: 
     llx: 149.35899
     lly: 286.496
     urx: 159.748
     ury: 296.28601
   width: 8.38901
  height: 7.79001',
'

T24: 
     llx: 135.27699
     lly: 286.396
     urx: 145.666
     ury: 296.186
   width: 8.38901
  height: 7.79',
'

T25: 
     llx: 119.52
     lly: 286.42801
     urx: 129.909
     ury: 296.21799
   width: 8.389
  height: 7.78998',
'

T26: 
     llx: 104.719
     lly: 286.358
     urx: 115.108
     ury: 296.14801
   width: 8.389
  height: 7.79001',
'

T27: 
     llx: 90.916
     lly: 286.39801
     urx: 101.305
     ury: 296.18701
   width: 8.389
  height: 7.789',
'

T28: 
     llx: 76.8342
     lly: 286.298
     urx: 87.2234
     ury: 296.08801
   width: 8.3892
  height: 7.79001',
'

T29: 
     llx: 62.5157
     lly: 286.40799
     urx: 72.9048
     ury: 296.19699
   width: 8.3891
  height: 7.789',
'

T30: 
     llx: 47.7141
     lly: 286.33801
     urx: 58.1033
     ury: 296.12701
   width: 8.3892
  height: 7.789',
'

T31: 
     llx: 33.9113
     lly: 286.37701
     urx: 44.3004
     ury: 296.16699
   width: 8.3891
  height: 7.78998',
'

T32: 
     llx: 19.8297
     lly: 286.27701
     urx: 30.2187
     ury: 296.06699
   width: 8.389
  height: 7.78998',
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
            $services_list['24_Procedure_Date_MMDDYYYY'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->DOS->format('m/d/Y'),
            ];
            $services_list['25_Area_of_Oral_Cavity'.($i + 1)] = [
               'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->dental->oral_cavity,
            ];
            $services_list['26_Tooth_System'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->dental->tooth_system,
            ];
            $services_list['27_Tooth_Numbers_or_Letters'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->dental->tooth_numbers,
            ];
            $services_list['28_Tooth_Surface'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->dental->tooth_surfaces,
            ];
            $services_list['29_Procedure_Code'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $code,
            ];
            $services_list['30_Description'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->shortDescription(),
            ];
            $services_list['29a_Diag_Pointer'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->pointers_alphabet,
            ];
            $services_list['31_Fee'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => '$ '. number_format($services[$i]->total_discounted_price, 2),
            ];
            $services_list['29b_Qty'.($i + 1)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => $services[$i]->quantity,
            ];
            if($services[$i]->dental->missing) {
	            $services_list['T'.($services[$i]->dental->tooth_numbers)] = [
                'size' => 8,
                'family' => 'Arial',
                'style' => '',
                'value' => 'X',
              ]; 
          }
        }
        $missing_teeth = explode(",", $this->invoice->dental_details->tooth_numbers);
        for ($i=0; $i < count($missing_teeth); $i++) { 
          $services_list['T'.($missing_teeth[$i])] = [
            'size' => 8,
            'family' => 'Arial',
            'style' => '',
            'value' => 'X',
          ]; 
          
        }

        $total_services = ['Invoice_Total' => [
            'size' => 8,
            'family' => 'Arial',
            'style' => '',
            'value' => '$ '. number_format($total, 2),
        ]];


        return $services_list + $total_services;
    }

    private function fillPage($form, $services, $page)
    {
        $data = $this->invoice_data;
	
        $coordinates = $this->addServicesSlots(count($services)) . $this->addTeethSlots($services);

        if($this->invoice->dental_details->tooth_numbers){
          $coordinates = $coordinates . $this->addMissingTeethSlots(explode(",", $this->invoice->dental_details->tooth_numbers));
        }
	
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
        $pdfGenerator = new PDFGeneratorLocal($fieldEntities, $data, 'P', 'pt', 'letter');

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

    private function addMissingTeethSlots($tooth_numbers)
    {
        $coordinates = '';
        for ($i = 0; $i < count($tooth_numbers); ++$i) {
               //get number from array
               $n = $tooth_numbers[$i];
               if(is_numeric($n) && $n < 33){
               //search for it in slots
               $coordinates = $coordinates.$this->teeth_slots[($n - 1)];
              }
        }

        return $coordinates;
    }

    private function addTeethSlots($services)
    {
        $coordinates = '';
        for ($i = 0; $i < count($services); ++$i) {
            if($services[$i]->dental->missing) {
               //get number from array
               $n = $services[$i]->dental->tooth_numbers;
               if(is_numeric($n) && $n < 33){
               //search for it in slots
               $coordinates = $coordinates.$this->teeth_slots[($n - 1)];
              }
            }
        }

        return $coordinates;
    }

    private function getInvoiceData()
    {
        //return
        $this->invoice_data = [
            'DENTIST_SIGNATURE' => [
                'size' => 7,
                'family' => 'Arial',
                'style' => '',
                'value' => str_replace('{', ", ",$this->invoice->doctor),
            ],
	   'DENTIST_SIGNATURE_DATE' => [
                'size' => 7,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->DOS->format('m/d/Y'),
            ],
	   'PATIENT_SIGNATURE_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->DOS->format('m/d/Y'),
            ],
	   'SUBSCRIBER_SIGNATURE_DATE' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->DOS->format('m/d/Y'),
            ],
	    'DENTIST_LICENSE' => [
                'size' => 7,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->dental_details->license,
            ], 
	    'License_Number' => [
                'size' => 7,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->dental_details->license,
            ],/*
            'INVOICE_TOTAL' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => number_format($this->invoice->total_with_discounts, 2),
            ], */
            'Patient_DOB' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->birth_date->format('m/d/Y'),
            ],
            'Patient_Name' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->name(),
            ],
            'Patient_Address' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->address(),
            ],
            'Patient_City_State_Zip' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->patient->addressDetails(),
            ],
            'Patient_F' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (1 == $this->invoice->patient->gender) ? 'X' : '',
            ],
            'Patient_M' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (1 == $this->invoice->patient->gender) ? '' : 'X',
            ],
            'Patient_U' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => '',
            ],
	   'Preauthorization' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => '',
            ],
            'Remarks' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->comments,
            ],
            'Enclosures' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->dental_details->enclosures) ? 'Y' : 'N',
            ],
            'Ortho_No' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->dental_details->orthodontics) ? '' : 'X',
            ],
            'Ortho_Yes' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->dental_details->orthodontics) ? 'X' : '',
            ],
            'Appliance_Placed' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->dental_details->orthodontics) ? $this->invoice->dental_details->appliance_placed->format('m/d/Y') : '',
            ],
            'Months_Treatment' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->dental_details->orthodontics) ? $this->invoice->dental_details->months_remaining : '',
            ],
            'Replacement_Yes' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->dental_details->prosthesis_replacement) ? 'X' : '',
            ],
            'Replacement_No' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->dental_details->prosthesis_replacement) ? '' : 'X',
            ],
            'Prior_Placement' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => ($this->invoice->dental_details->prosthesis_replacement) ? $this->invoice->dental_details->prior_placement->format('m/d/Y') : '',
            ],
            'T_0' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (0 == $this->invoice->dental_details->treatment_resulting_from) ? 'x' : '',
            ],
            'T_1' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (1 == $this->invoice->dental_details->treatment_resulting_from) ? 'x' : '',
            ],
            'T_2' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (0 == $this->invoice->dental_details->treatment_resulting_from) ? 'x' : '',
            ],
            'Accident_Date' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => (1 == $this->invoice->dental_details->treatment_resulting_from) ? $this->invoice->dental_details->accident->format('m/d/Y') : '',
            ],
            'Accident_State' => [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
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
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'Patient_Insurance' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'Insurer_Policy_Number' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->group_number,
                ],
                'Insurer_DOB' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->birth_date->format('m/d/Y'),
                ],
                'Insurer_Name' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->name(),
                ],
                'Insurer_City_State_Zip' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->addressDetails(),
                ],
                'Insurer_Address' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $this->invoice->patient->address(),
                ],
                'Self' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => 'X',
                ],
                'Child' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
                'Spouse' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
                'Other' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
                'Insurer_F' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $this->invoice->patient->gender) ? 'X' : '',
                ],
                'Insurer_M' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $this->invoice->patient->gender) ? '' : 'X',
                ],
                'Insurer_U' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
            ];

            $insurance_data = [
                'Company_Name' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->name,
                ],
                'Company_Address' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->address,
                ],
                'Company_City_State_Zip' => [
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
                'Insurance_ID' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'Patient_Insurance' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurance_id,
                ],
                'Insurer_Policy_Number' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->group_number,
                ],
                'Insurer_DOB' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->birth_date->format('m/d/Y'),
                ],
                'Insurer_Name' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->name(),
                ],
                'Insurer_City_State_Zip' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->addressDetails(),
                ],
                'Insurer_Address' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->patient->address(),
                ],
                'Self' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
                'Child' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'Spouse' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (2 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'Other' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (0 == $this->invoice->patient->dependent->relationship) ? 'X' : '',
                ],
                'Insurer_F' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $insured->patient->gender) ? 'X' : '',
                ],
                'Insurer_M' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => (1 == $insured->patient->gender) ? '' : 'X',
                ],
                'Insurer_U' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => '',
                ],
            ];
            $insurance_data = [
                'Company_Name' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->name,
                ],
                'Company_Address' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->address,
                ],
                'Company_City_State_Zip' => [
                    'size' => 9,
                    'family' => 'Arial',
                    'style' => '',
                    'value' => $insured->insurer->cityZIP(),
                ],
            ];
            $this->invoice_data = $this->invoice_data + $insured_data + $insurance_data;
        }

        $diagnosis_list = [];

        for ($i = 0; $i < count($this->invoice->diagnoses); ++$i) {
            $diagnosis_list['Diagnosis_'.($i+1)] = [
                'size' => 9,
                'family' => 'Arial',
                'style' => '',
                'value' => $this->invoice->diagnoses[$i]->diagnosis_code,
            ];

            
        }

        $this->invoice_data = $this->invoice_data + $diagnosis_list;
        //add data
    }
}
