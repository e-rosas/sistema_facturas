<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $invoice->code }}</title>
    <style type="text/css">
        body {
            font: 14px/1.4 "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        th:first-child {
            border-top-left-radius: 5px;
            text-align: left;
        }
        th:last-child {
            border-top-right-radius: 5px;
        }

        td {
            border-bottom: 1px solid #cecfd5;
            border-right: 1px solid #cecfd5;
        }
        td:first-child {
            border-left: 1px solid #cecfd5;
            text-align: left;
        }

        th,
        td {
        padding: 4px 6px;
        vertical-align: middle;
        }

        th {
            font-style: normal;
            font-size: 12px;
            color: #475057;
            width: 100%;
            text-align: center;
        }

        thead {
            background: #F6F9FC;
            font-size: 11px;
            text-transform: uppercase;
        }

        .sub-container{
            padding: 0px 20px;
        }

        .header {
            width: 100%;
        }

        .heading-text {
            font-style: normal;
            font-weight: 600;
            font-size: 22px;
            color: #5851D8;
            width: 100%;
            text-align: left;
            padding: 0px;
            margin: 0px;
        }

        .heading-date-range {
            font-style: normal;
            font-weight: 600;
            font-size: 15px;
            color: #A5ACC1;
            width: 100%;
            text-align: right;
            padding: 0px;
            margin: 66px 0 22px 0;
        }

        .sub-heading-text {
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            color: #595959;
            padding: 0px;
            margin: 0px;
            margin-top: 6px;
        }

        .expenses-title {
            margin-top: 8px;
            padding-left: 3px;
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 21px;
            color: #040405;
        }

        .expenses-table-container {
            padding-left: 10px;
        }

        .expenses-table {
            width: 100%;
            padding-bottom: 10px;
        }

        .expense-title {
            font-style: normal;
            font-weight: normal;
            font-size: 10px;
            color: #595959;
            text-align: center;
        }

        .expense-money {
            padding: 0px;
            margin: 0px;
            font-style: normal;
            font-weight: normal;
            font-size: 8px;
            line-height: 21px;
            text-align: right;
            color: #595959;
        }

        .expense-total-table {
            border-top: 1px solid #EAF1FB;
            width: 100%;
        }

        .expense-total-cell {
            padding-right: 20px;
            padding-top: 10px;
        }

        .expense-total {
            padding-top: 10px;
            padding-right: 30px;
            padding: 0px;
            margin: 0px;
            text-align: right;
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            text-align: right;
            color: #040405;
        }

        .total-expense-table {
            width: 100%;
            margin-top: 40px;
            padding: 15px 20px;
            background: #F9FBFF;
            box-sizing: border-box;
        }

        .total-expense-title {
            padding: 0px;
            margin: 0px;
            text-align: left;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            color: #595959;
        }

        .total-expense-money {
            padding: 0px;
            margin: 0px;
            text-align: right;
            font-style: normal;
            font-weight: 500;
            font-size: 20px;
            color: #5851D8;
        }
        .description {
            text-align: left;
        }
        .date {
            width: 30%;
        }
        .h-total, .h-discounted{
            width: 23%;
        }
        .h-total{
            width: 17%;
        }
        .invoice-detail{
            color: #6e7175;
            font-size: 11px;
            font-weight: 500;
        }
        .logo {
            border-top: 4px solid #7267e4;
            float: left;
            font-size: 20px;
            font-weight: 100;
            letter-spacing: .5px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <header class="primary-header">

        <img src={{url('/img/HM-logo.png')}} class="logo">

        <textarea name="address" cols="30" rows="3">
            HOSPITAL MEXICO DE BC SA DE CV
            PO BOX 2508
            CHULA VISTA CA 91912
        </textarea>

        <h3 class="heading-date-range">{{ $datetime }}</h3>

    </header>
    <section class="row-alt">
        <p style="text-align:left;">"INSURED'S NAME: " <span>{{ $insured->$patient->name() }}</span>
            <span style="float:right;">
                "PATIENT'S ACCOUNT NO.: " <span>{{ $invoice->$code }}</span>
            </span>
        </p>
    </section>

    <div class="main-container">
        <div class="sub-container">
            <p class="expenses-title">Invoices</p>
            <div class="expenses-table-container">
                @foreach ($invoices as $invoice)

                <p class="invoice-detail">Number: {{ $invoice->number }} </p>
                <p class="invoice-detail">{{ $invoice->date->toFormattedDateString() }} </p>
                <table class="expenses-table">
                    <thead>
                        <tr>
                            <th class="description">{{ __('Description') }}</th>
                            <th class="date">{{ __('Date') }}</th>
                            <th class="h-total">{{ __('Total') }}</th>
                            <th class="h-discounted">{{ __('Discounted') }}</th>
                        </tr>
                    </thead>
                    @foreach ($invoice->services as $service)
                        <tr>
                            <td>
                                <p class="expense-title description">
                                    {{ $service->description}}
                                </p>
                            </td>
                            <td>
                                <p class="expense-title">
                                    {{ $service->created_at->toFormattedDateString() }}
                                </p>
                            </td>
                            <td>
                                <p class="expense-title">
                                    {{ $service->total_price}}
                                </p>
                            </td>
                            <td>
                                <p class="expense-title">
                                    @if (is_null($discount))
                                        {{ $service->total_discounted_price}}
                                    @else
                                        {{ (float) str_replace(',', '', $service->total_price) * $discount->discount_percentage / 100}}
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <table class="expense-total-table">
                    <tr>
                        <td class="expense-total-cell">
                            @if (is_null($discount))
                                <p class="expense-total"> {{ $invoice->total_with_discounts }} </p>
                            @else
                                <p class="expense-total"> {{ (float) str_replace(',', '', $invoice->total) * $discount->discount_percentage / 100 }} </p>
                            @endif

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
                    @if (is_null($discount))
                        <p class="total-expense-money"> {{ $person->person_stats->getTotal() }} </p>
                    @else
                        <p class="total-expense-money"> {{ (float) str_replace(',', '', $person->person_stats->total_amount_due) * $discount->discount_percentage / 100  }} </p>
                    @endif
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
