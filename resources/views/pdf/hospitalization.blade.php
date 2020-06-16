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
            font-size: 13px;
          }
          .invoice-table {
            width: 100%;
            border-collapse: collapse;
          }
          .invoice-table thead tr td {
            font-size: 12px;
            letter-spacing: 1px;
            color: grey;
            padding: 8px 0;
          }
          .invoice-table tbody tr td {
              padding: 8px 0;
              letter-spacing: 0;
          }
          
          .invoice-table .row-data #unit {
            text-align: center;
          }
          
          .invoice-table .row-data {
            font-size: 13px;
            color: rgba(0, 0, 0, 0.6);
          }
          .invoice-month-header {
            width: 150px;
            margin-bottom: 2px;
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
            margin-bottom: 20px;
            border-radius: 10px;
          }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-content">
          <div class="invoice-company">
            <div class="invoice-company-logo"  style="text-align: left">
                <img src="{{public_path().'/img/HM-logo.png'}}"/>
            </div>
            <div class="invoice-company-info" style="text-align: right">
              <span>HOSPITAL MEXICO DE BC SA DE CV</span> <br>
              <span>PO BOX 2508</span> <br>
              <span>CHULA VISTA CA 91912</span><br>
              <span>619 482 8608</span>
            </div>
          </div>
          <div class="invoice-company-info" >
            <p style="text-align:left; font-weight: bold;">INSURED&#39S NAME: <span style="font-weight: 400;">{{ $insured->patient->name() }}</span>
                <span style="float:right; font-weight: bold;">
                    PATIENT&#39S ACCOUNT NO.  <span style="font-weight: 400;">{{ $invoice->code }}</span>
                </span>
              </p>
              <p style="text-align:left; font-weight: bold;">PATIENT&#39S NAME: <span style="font-weight: 400;">{{ $patient->name() }}</span>
                <span style="float:right;">
                    INSURED&#39S I.D NUMBER:  <span style="font-weight: 400;">{{ $insured->insurance_id }}</span>
                </span>
              </p>
              <p style="font-weight: bold;">PATIENT&#39S DATE OF BIRTH: <span style="font-weight: 400;"> {{ $patient->birth_date->format('m/d/Y') }}</span></p>
          </div>
          

          @foreach ($categories as $category)
            <h5 class="invoice-month-header">{{ $category->name }} </h5>

            <div class="invoice-details">
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Description</td>
                            <td>Units</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category->services as $service)
                            <tr class="row-data">
                                <td>
                                    {{ $service->DOS->format("m/d/Y") }}
                                </td>
                                <td>
                                    {{ $service->description}}
                                </td>
                                <td id="unit">
                                    {{ $service->quantity }}
                                </td>
                                <td>
                                    $ {{ number_format($service->total_discounted_price, 2) }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="calc-row">
                            <td colspan="2"></td>
                            <td>Total</td>
                            <td>$ {{ $category->total() }}</td>
                        </tr>
    
                    </tbody>
                </table>
            </div>

            
              
          @endforeach
          <div class="invoice-total">
            <h2 style="text-align:left;">Total <span  style="float: right">$ {{ $invoice_total }}</span></h2>
          </div>
    </div>
    {{-- <header class="primary-header">

        <img src="{{public_path().'/img/HM-logo.png'}}" class="logo">

        <textarea name="address" cols="30" rows="3">
            HOSPITAL MEXICO DE BC SA DE CV
            PO BOX 2508
            CHULA VISTA CA 91912
        </textarea>

        <h3 class="heading-date-range">{{ $datetime }}</h3>

    </header>
    <section class="row-alt">
        <p style="text-align:left;">"INSURED'S NAME: " <span>{{ $insured->patient->name() }}</span>
            <span style="float:right;">
                "PATIENT'S ACCOUNT NO.: " <span>{{ $invoice->code }}</span>
            </span>
        </p>
    </section>

    <div class="main-container">
        <div class="sub-container">
            <p class="expenses-title">Invoices</p>
            <div class="expenses-table-container">
                @foreach ($categories as $category)

                <p class="invoice-detail">{{ $category->name }} </p>
                <table class="expenses-table">
                    <thead>
                        <tr>
                            <th class="date">{{ __('Date') }}</th>
                            <th class="description">{{ __('Description') }}</th>
                            
                            <th class="h-total">{{ __('Units') }}</th>
                            <th class="h-discounted">{{ __('Total') }}</th>
                        </tr>
                    </thead>
                    @foreach ($category->services as $service)
                        <tr>
                            <td>
                                <p class="expense-title">
                                    {{ $service->DOS->format("m/d/Y") }}
                                </p>
                            </td>
                            <td>
                                <p class="expense-title description">
                                    {{ $service->description}}
                                </p>
                            </td>
                            <td>
                                <p class="expense-title">
                                    {{ $service->quantity }}
                                </p>
                            </td>
                            <td>
                                <p class="expense-title">
                                    {{ $service->total_discounted_price}}
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <table class="expense-total-table">
                    <tr>
                        <td class="expense-total-cell">
                            <p class="expense-total"> {{ $category->total }} </p>


                        </td>
                    </tr>
                </table>
                @endforeach
            </div>
        </div>
        <table class="total-expense-table">
            <tr>
                <td>
                    <p class="total-expense-title">Total</p>
                </td>
                <td>
                    <p class="total-expense-money"> {{ $invoice_total }} </p>
                </td>
            </tr>
        </table>
    </div> --}}
</body>
</html>
