<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ $invoice->code }}</title>
  <style type="text/css">
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
  <div class="invoice">
    <div class="invoice-content">
      <div class="invoice-company">
        <div style="text-align: left">
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
        <p style="text-align:left; font-weight: bold;">INSURED&#39S NAME: <span
            style="font-weight: 400;">{{ $insured->patient->name() }}</span>
          <span style="float:right; font-weight: bold;">
            PATIENT&#39S ACCOUNT NO. <span style="font-weight: 400;">{{ $invoice->code }}</span>
          </span>
        </p>
        <p style="text-align:left; font-weight: bold;">PATIENT&#39S NAME: <span
            style="font-weight: 400;">{{ $patient->name() }}</span>
          <span style="float:right;">
            INSURED&#39S I.D NUMBER: <span style="font-weight: 400;">{{ $insured->insurance()->insurance_id }}</span>
          </span>
        </p>
        <p style="font-weight: bold;">PATIENT&#39S DATE OF BIRTH: <span style="font-weight: 400;">
            {{ $patient->birth_date->format('m/d/Y') }}</span></p>
      </div>
      @foreach ($categories as $category)
      <h5 class="invoice-month-header">{{ $category->name }} </h5>

      <div class="invoice-detail">
        <table class="invoice-table">
          {{--  <thead>
                        <tr>
                            <td>Date</td>
                            <td>Description</td>
                            <td>Units</td>
                            <td>Total</td>
                        </tr>
                    </thead>  --}}
          <tbody>
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
            <tr class="row-data">
              <td colspan="3"></td>
              <td style="font-weight: bold;">$ {{ $category->total() }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      @endforeach
      <div class="invoice-total" style="width: 90%">
        <h3 style="text-align:left;">Total <span style="float: right">$ {{ $invoice_total }}</span></h3>
      </div>
    </div>
</body>

</html>
