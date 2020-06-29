<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $invoice->code }} - Categories</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        .page-break {
          page-break-after: always;
        }
        body {
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            font-size: small;
            color: #322d28;
          }
        .invoice-company {
            display: flex;
            justify-content: space-between;
            align-items: center;
          }
          .invoice-company-info {
            font-size: 10px;
          }
          .invoice-table {
            width: 100%;
            border-collapse: collapse;
          }
          .invoice-table thead tr td {
            font-size: 12px;
            letter-spacing: 1px;
            color: grey;
            padding: 2px 0;
          }
          .invoice-table tbody tr td {
              letter-spacing: 0;
          }
          .invoice-table .row-data #unit {
            text-align: center;
          }

          .invoice-table .row-data {
            font-size: 11px;
            color: rgba(0, 0, 0, 0.6);
          }
          .invoice-month-header {
            width: 150px;
            border-bottom: #e4e4e4 1px solid;
          }
          .invoice-details {
            flex: 1;
            border-top: 0.5px dashed grey;
            border-bottom: 0.5px dashed grey;
            display: flex;
            align-items: center;
          }
          .invoice-total {
            justify-content: space-between;
            padding: 5px 10px;
            border-radius: 10px;
          }
    </style>
</head>
<body>
  @foreach($categories as $category)
    <div class="invoice">
        <div class="invoice-content">
            <div class="invoice-company">
                <div class="invoice-company-logo" style="text-align: left">
                    <img height="80px" src="{{public_path().'/img/HM-logo.png'}}" />
                </div>
                <div class="invoice-company-info" style="text-align: right">
                    <span>HOSPITAL MEXICO DE BC SA DE CV</span> <br>
                    <span>PO BOX 2508</span> <br>
                    <span>CHULA VISTA CA 91912</span><br>
                    <span>619 482 8608</span>
                </div>
            </div>
            <div class="invoice-company-info">
              <table style="width: 100%">
                <tr>
                  <td style="font-weight: bold; width:50%">INSURED&#39S NAME: <span style="font-weight: 400;">{{ $insured->patient->name() }}</span></td>
                  <td style="width: 20%"></td>
                  <td style="font-weight: bold; width:30%">PATIENT&#39S ACCOUNT NO. <span style="font-weight: 400;">{{ $invoice->code }}</span></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; width:50%">PATIENT&#39S NAME: <span
                            style="font-weight: 400;">{{ $patient->name() }}</span></td>
                    <td style="width: 20%"></td>
                    <td style="font-weight: bold; width:30%">INSURED&#39S I.D NUMBER: <span
                            style="font-weight: 400;">{{ $insured->insurance_id }}</span></td>
                </tr>
                <tr>
                  <td style="font-weight: bold;">PATIENT&#39S DATE OF BIRTH: <span
                          style="font-weight: 400;">{{ $patient->birth_date->format('m/d/Y') }}</span></td>
                </tr>
              </table>
            </div>
            <h5 class="invoice-month-header">{{ $category->name()}} </h5>

            <div class="invoice-detail">
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <td style="font-weight: bold;">Date</td>
                            <td style="font-weight: bold;">Description</td>
                            <td style="font-weight: bold;">Quantity</td>
                            <td style="font-weight: bold;">Price</td>
                        </tr>
                    </thead>
                    <tbody>
                      @if ($category->id == 6) //SURGERY AND LAB
                          @foreach ($category->services as $service)
                            <tr class="row-data">
                                <td style="width:15%; word-wrap: break-word">
                                    {{ $service->DOS->format("m/d/Y") }}
                                </td>
                                <td style="width:60%; word-wrap: break-word">
                                    {{ $service->description}}
                                </td>
                                <td style="width:10%; word-wrap: break-word" id="unit">
                                    {{ $service->quantity }}
                                </td>
                                <td style="width:15%; word-wrap: break-word">
                                    $ {{ number_format($service->total_discounted_price, 2) }}
                                </td>
                            </tr>
                          @endforeach
                      @else
                          @foreach ($category->services as $service)
                            @foreach ($service->items as $item)
                                <tr class="row-data">
                                    <td style="width:15%; word-wrap: break-word">
                                        {{ $item->date->format("m/d/Y") }}
                                    </td>
                                    <td style="width:60%; word-wrap: break-word">
                                        {{ $item->description}}
                                    </td>
                                    <td style="width:10%; word-wrap: break-word" id="unit">
                                        {{ $item->quantity }}
                                    </td>
                                    <td style="width:15%; word-wrap: break-word">
                                        $ {{ number_format($item->total_discounted_price, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                          @endforeach
                      @endif

                        <tr class="row-data">
                            <td colspan="2"></td>
                            <td style="font-weight: bold;">SUBTOTAL</td>
                            <td style="font-weight: bold;">$ {{ $category->total() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="page-break"></div>

  @endforeach
    <div class="invoice">
        <div class="invoice-content">
            <div class="invoice-company">
                <div class="invoice-company-logo" style="text-align: left">
                    <img height="80px" src="{{public_path().'/img/HM-logo.png'}}" />
                </div>
                <div class="invoice-company-info" style="text-align: right">
                    <span>HOSPITAL MEXICO DE BC SA DE CV</span> <br>
                    <span>PO BOX 2508</span> <br>
                    <span>CHULA VISTA CA 91912</span><br>
                    <span>619 482 8608</span>
                </div>
            </div>
            <div class="invoice-company-info">
                <table style="width: 100%">
                    <tr>
                        <td style="font-weight: bold; width:50%">INSURED&#39S NAME: <span
                                style="font-weight: 400;">{{ $insured->patient->name() }}</span></td>
                        <td style="width: 20%"></td>
                        <td style="font-weight: bold; width:30%">PATIENT&#39S ACCOUNT NO. <span
                                style="font-weight: 400;">{{ $invoice->code }}</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; width:50%">PATIENT&#39S NAME: <span
                                style="font-weight: 400;">{{ $patient->name() }}</span></td>
                        <td style="width: 20%"></td>
                        <td style="font-weight: bold; width:30%">INSURED&#39S I.D NUMBER: <span
                                style="font-weight: 400;">{{ $insured->insurance_id }}</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">PATIENT&#39S DATE OF BIRTH: <span
                                style="font-weight: 400;">{{ $patient->birth_date->format('m/d/Y') }}</span></td>
                    </tr>
                </table>
            </div>
            <h4></h4>
            <div class="invoice-detail">
                <table class="invoice-table" style="margin-left: auto; margin-right: auto; width:50%">
                    {{-- <thead>
                        <tr>
                            <td style="font-weight: bold;">Date</td>
                            <td style="font-weight: bold;">Description</td>
                            <td style="font-weight: bold;">Quantity</td>
                            <td style="font-weight: bold;">Price</td>
                        </tr>
                    </thead> --}}
                    <tbody>
                        @foreach ($categories as $category)
                        <tr class="row-data">
                            <td style="word-wrap: break-word">
                                {{ $category->name() }}
                            </td>
                            <td style="word-wrap: break-word">
                                $ {{ $category->total() }}
                            </td>
                        </tr>
                        @endforeach
                        <tr class="row-data">
                            <td style="font-weight: bold;">TOTAL</td>
                            <td style="font-weight: bold;">$ {{ $invoice_total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
