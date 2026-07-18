<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Application Print</title>
    <style>
        @page {
            size: A4;
            margin: 12mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
            margin: 0;
            padding: 0;
        }

        .page {
            width: 100%;
        }

        .header {
            width: 100%;
            background: #d90000;
            color: #fff;
            padding: 18px 20px;
            box-sizing: border-box;
            margin-bottom: 12px;
        }

        .header-table,
        .info-table,
        .detail-table,
        .directors-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo-box {
            width: 45%;
            background: #fff;
            color: #000;
            padding: 10px;
        }

        .logo-title {
            font-size: 32px;
            font-weight: bold;
            color: #111;
        }

        .logo-subtitle {
            font-size: 12px;
            color: #666;
        }

        .app-title {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .section-title {
            background: #d90000;
            color: #fff;
            padding: 6px 10px;
            font-weight: bold;
            margin-top: 10px;
            margin-bottom: 6px;
        }

        .info-table td {
            padding: 5px 8px;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            width: 22%;
        }

        .value {
            width: 28%;
        }

        .directors-table th,
        .directors-table td,
        .detail-table td {
            border: 1px solid #ccc;
            padding: 6px;
            font-size: 11px;
        }

        .directors-table th {
            background: #f2f2f2;
            text-align: left;
        }


    .meters-table th,
        .meters-table td,
        .detail-table td {
            border: 1px solid #ccc;
            padding: 6px;
            font-size: 11px;
        }

        .meters-table th {
            background: #f2f2f2;
            text-align: left;
        }

        .footer {
            margin-top: 20px;
            background: #d90000;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-weight: bold;
            font-size: 12px;
        }

        .mb-8 {
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="page">

        {{-- Header --}}
        <div class="header">
            <table class="header-table">
                <tr>
                    <td class="logo-box">
                        <div class="logo-title">Neom</div>
                        <div class="logo-subtitle">Solutions.</div>
                    </td>
                    <td style="width: 55%; padding-left: 20px;">
                        <div class="app-title">Application</div>
                        <table style="width:100%; color:#fff;">
                            <tr>
                                <td style="font-weight:bold; width:40%;">Application No:</td>
                                <td>{{ $application->application_num ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight:bold;">Application Date:</td>
                                <td>
                                    {{ $application->application_date ? \Carbon\Carbon::parse($application->application_date)->format('d-m-Y') : 'N/A' }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        {{-- Application Summary --}}
        <div class="section-title">Application Summary</div>
        <table class="info-table">
            <tr>
                <td class="label">Service:</td>
                <td class="value">{{ $application->service_type ?? 'N/A' }}</td>
                <td class="label">Agent:</td>
                <td class="value">{{ $application->application_agent ?? optional($application->user)->name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Remarks:</td>
                <td colspan="3">{{ $application->comment ?? 'N/A' }}</td>
            </tr>
        </table>

        {{-- Customer Details --}}
        <div class="section-title">Customer Details</div>
        <table class="info-table">
            <tr>
                <td class="label">Company Name:</td>
                <td class="value">{{ $application->company_name ?? 'N/A' }}</td>

                <td class="label">Trading Name:</td>
                <td class="value">{{ $application->trading_name ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Merchant Name:</td>
                <td class="value">{{ $application->merchant_full_name ?? 'N/A' }}</td>

                <td class="label">Position:</td>
                <td class="value">{{ $application->position ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Business Entity:</td>
                <td class="value">{{ $application->business_entity ?? 'N/A' }}</td>

                <td class="label">Business Nature:</td>
                <td class="value">{{ $application->business_nature ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Email Address:</td>
                <td class="value">{{ $application->email_address ?? 'N/A' }}</td>

                <td class="label">Phone Number:</td>
                <td class="value">{{ $application->phone_number ?? $application->mobile_no ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Company House No:</td>
                <td class="value">{{ $application->companies_house_number ?? $application->company_reg_no ?? 'N/A' }}</td>

                <td class="label">VAT Number:</td>
                <td class="value">{{ $application->vat_tax_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Trading Address:</td>
                <td colspan="3">{{ $application->trading_address ?? $application->business_address ?? 'N/A' }}</td>
            </tr>
        </table>

        {{-- Directors --}}
        @if($application->directors && $application->directors->count())
            <div class="section-title">Directors Details</div>
            <table class="directors-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>D.O.B</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($application->directors as $director)
                        <tr>
                            <td>{{ $director->director_name ?? 'N/A' }}</td>
                            <td>
                                {{ $director->date_of_birth ? \Carbon\Carbon::parse($director->date_of_birth)->format('d-m-Y') : 'N/A' }}
                            </td>
                            <td>{{ $director->phone_no ?? 'N/A' }}</td>
                            <td>{{ $director->email_address ?? 'N/A' }}</td>
                            <td>{{ $director->home_address ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{-- Service Specific Data --}}
      @if($application->service_type == 'Card Machine')
    <div class="section-title">Card Machine Members</div>
    <table class="info-table">
        <tr>
            <td class="label">Number of Members:</td>
            <td class="value">{{ $application->directors->count() }}</td>
        </tr>
    </table>
@elseif(in_array($application->service_type, ['Gas', 'Electricity', 'Electric Gas']))
    <div class="section-title">Meter Details</div>
    <table class="meters-table">
        <thead>
            <tr>
                <th>Supplier Name</th>
                <th>MPAN</th>
                <th>MPRN</th>
                <th>Rate</th>
                <th>Contract Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach($application->meters as $meter)
                <tr>
                    <td>{{ $meter->supplier_name ?? 'N/A' }}</td>
                    <td>{{ $meter->mpan_top ?? 'N/A' }} - {{ $meter->mpan_bottom ?? 'N/A' }}</td>
                    <td>{{ $meter->mprn_no ?? 'N/A' }}</td>
                    <td>{{ $meter->offer_rate ?? 'N/A' }}</td>
                    <td>{{ $meter->contract_duration ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

        {{-- Application Details --}}
        <div class="section-title">Application Details</div>
        <table class="info-table">
            <tr>
                <td class="label">Brand:</td>
                <td class="value">{{ $application->brand ?? 'N/A' }}</td>

                <td class="label">Quantity:</td>
                <td class="value">{{ $application->qty ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">EPOS:</td>
                <td class="value">{{ $application->epos_system ? 'Yes' : 'No' }}</td>

                <td class="label">Delivery Address:</td>
                <td class="value">{{ $application->delivery_address ?? 'N/A' }}</td>
            </tr>
        </table>

        {{-- Bank Details --}}
        <div class="section-title">Bank Details</div>
        <table class="info-table">
            <tr>
                <td class="label">Bank Name:</td>
                <td class="value">{{ $application->name_of_bank ?? 'N/A' }}</td>

                <td class="label">Account Name:</td>
                <td class="value">{{ $application->name_on_account ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Account No:</td>
                <td class="value">{{ $application->account_number ?? 'N/A' }}</td>

                <td class="label">IBAN:</td>
                <td class="value">{{ $application->iban ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Sort Code:</td>
                <td class="value">{{ $application->sort_code ?? 'N/A' }}</td>

                <td class="label">BIC:</td>
                <td class="value">{{ $application->bic ?? 'N/A' }}</td>
            </tr>
        </table>

        <div class="footer">
            © Neom Solutions — All Rights Reserved.
        </div>
    </div>
</body>
</html>
