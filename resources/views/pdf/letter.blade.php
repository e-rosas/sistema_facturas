<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ $patient->full_name }}</title>
  <style type="text/css">
    body {
      font-family: 'Montserrat', sans-serif;
      font-weight: 400;
      font-size: 12px;
      color: #322d28;
      text-align: justify;
    }

    .invoice-company {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 80px;
      border-radius: 6px;
    }

    .invoice-company-info {
      font-size: 12px;
    }

    .invoice-table {
      width: 70%;
      border-collapse: collapse;
      margin-left: auto;
      margin-right: auto;
    }



    .tabletitle {
      padding: 5px;
      background: lightgray;
      font-size: 1.15em;
      font-weight: 500;
      text-align: center;
    }



    .invoice-table .row-data #unit {
      text-align: center;
    }

    .invoice-table .row-data {
      font-size: 0.9em;
      border: 2px solid #EEE;
      color: rgba(0, 0, 0, 0.6);
      text-align: center;
    }

    .invoice-table .row-total {
      font-size: 0.85em;
      color: rgba(15, 15, 15, 0.6);
    }

    .invoice-month-header {
      width: 250px;
      border-bottom: #e4e4e4 1px solid;
      font-size: 16px;
    }

    .td-total {
      border-bottom: #e4e4e4 1px solid;
      border-top: #e4e4e4 1px solid;
      font-weight: bold;
      text-align: center
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

    .bank p {
      margin: 2px;
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
          <span>Hospital México de B.C. S.A. de C.V.</span> <br>
          <span>R.F.C. HMB940222NF8</span> <br>
          <span>Paseo Tijuana 9077 Empleados Federales 22010 Tijuana, B.C.</span> <br>
          <span>Tel / Fax 011 52 (664) 683 6363</span><br>
          <span>1 800 315 8714</span><br><br><br>
          <span>{{ $datetime->toFormattedDateString() }}</span>
        </div>
      </div>
      <br> <br> <br> <br>
      <div class="invoice-company-info">
        <p style="text-align:left; ">{{ $insuree->insurer->name }}
        </p>
        <p style="text-align:left; font-weight: bold;">Insured ID #: <span
            style="font-weight: 400;">{{ $insuree->insurance_id }}</span>
        </p>
        <p style="text-align:left; font-weight: bold;">Insured&#39s name: <span
            style="font-weight: 400;">{{ $insuree->patient->name() }}</span>
          <span style="float:right; font-weight: bold;">
            Patient&#39s name: <span style="font-weight: 400;">{{ $patient->full_name }}</span>
          </span>
        </p>
        <p style="text-align:left; font-weight: bold;">Insurance: <span
            style="font-weight: 400;">{{ $insuree->insurer->name }}</span>
          <span style="float:right;">
            Date of Birth: <span style="font-weight: 400;">{{ $patient->birth_date->format('m/d/Y') }}</span>
          </span>
        </p>
        <p style="text-align:left; font-weight: bold;">Total charge: <span style="font-weight: 400;">{{ $total }}</span>
        </p>
        <p style="font-weight: bold;">Invoices<span style="font-weight: 400;">
            {{ $codes }}</span></p>
      </div>
      <div>
        <p>To whom it may concern:</p>
        <p>We write this letter to inform you that the total amount due, up to {{ $datetime->toFormattedDateString() }}
          for the
          above patient’s account, according to our records is $ {{ $total }} USD ( {{ $amount }} dollars).</p>
      </div>
      <h5 class="invoice-month-header">INVOICE LIST</h5>
      <div class="invoice-detail">
        <table class="invoice-table">
          <thead>
            <tr class="tabletitle">
              <td>Invoice</td>
              <td>Date of Service</td>
              <td>Total charge</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($invoices as $invoice)
            <tr class="row-data">
              <td>
                {{ $invoice->code}}
              </td>
              <td>
                {{ $invoice->DOS->format("m/d/Y") }}
              </td>

              <td>
                {{ number_format($invoice->amount_due, 2) }}
              </td>
            </tr>
            @endforeach
            <tr class="row-total">
              <td colspan="1"></td>
              <td style=" text-align: right">Total: </td>
              <td class="td-total">$ {{ $total }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <br> <br>
    <p>We would appreciate if you could send the corresponding payment via wire transfer to the
      following banking details:</p>
    <p>Beneficiary Bank: </p>
    <div class="bank">
      <p>PACIFIC WESTERN BANK</p>
      <p>5900 LA PLACE COURT SUITE 200,</p>
      <p>CA, 92008-1207, United States.</p>
      <p>Beneficiary account: 1001117850</p>
      <p>Tracking # 122238200</p>
    </div>
    <p style="page-break-before: always"></p>
    <div class="invoice-company-info" style="text-align: right">
      <span>Hospital México de B.C. S.A. de C.V.</span> <br>
      <span>R.F.C. HMB940222NF8</span> <br>
      <span>Paseo Tijuana 9077 Empleados Federales 22010 Tijuana, B.C.</span> <br>
      <span>Tel / Fax 011 52 (664) 683 6363</span><br>
      <span>1 800 315 8714</span><br><br><br>
      <span>{{ $datetime->toFormattedDateString() }}</span>
    </div>
    <br> <br><br> <br>
    <p>OR</p>
    <div class="bank">
      <p>Via check made out to Hospital Mexico de B.C. S.A. de C.V.</p>
      <p>P.O. Box 2508,</p>
      <p>Chula Vista, CA,</p>
      <p>91912, United States.</p>
    </div>
    <div>
      <p>The Health Insurance Claim Forms corresponding to this patient are found in the annex to this
        letter.</p>
      <p>If you have any questions, feel free to contact us at <b>619 482-8608, 619 482-0953</b>, or via e-mail
        address at <a href="hospitalmexicoclaims@gmail.com">hospitalmexicoclaims@gmail.com</a> with Yamileth and Silvia.
      </p>
      <p>We thank you in advance for your cooperation regarding this matter.</p>
      <p>Sincerely, </p>
      <address>
        <p>Manuel Rafael Lazo Aguila, M.D.</p>
        <p>Hospital México B.C. S.A. de C.V.</p>
      </address>
    </div>
</body>

</html>
