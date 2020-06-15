<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $invoice->code }}</title>
</head>
<body>
    <header class="primary-header">

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
    </div>
</body>
</html>
