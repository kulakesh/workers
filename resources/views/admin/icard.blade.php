
<!DOCTYPE html>
<html lang="en">
<head>
    <title>iCard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">

    <link rel="stylesheet" href="{{ URL::asset('build/css/paper.css') }}">
    
    <style>
        @page { 
            size: icard-size
        }
    
        .icard {
            width: 54mm;
            height: 86mm;
            border: 1px solid black;
            position: relative;
        }
        #bg_img{
            width: 54mm;
            height: 86mm;
        }
        .reg_id {
            top:20mm;
            left:13mm;
            position: absolute;
            font-size: 8px;
            color: black;
        }
        .image {
            top:21mm;
            left:13mm;
            position: absolute;
        }
        .image img {
            height: 26mm;
            width: 26mm;
            object-fit: cover;
            border: 1mm solid white;
            border-radius: 5mm;
        }
        .content-front {
            position: absolute;
            top: 49mm;
            width: 100%;
        }
        .content-front .name{
            text-align: center;
            font-size: 14px;
            font-weight: bold;
        }
        .content-front .role{
            text-align: center;
            font-size: 10px;
        }
        .content-front .table{
            text-align: center;
            font-size: 8px;
            padding-left: 9mm;
            padding-right: 3mm;
        }
        .content-front .real-table{
            width: 100%;
            margin-top: 3mm;
        }
        .barcode{
            margin-top: -11mm;
            text-align: center;
        }
        .barcode img{
            height: 6mm;
        }
        .content-back {
            position: absolute;
            top: 15mm;
            width: 100%;
        }
        .content-back .table{
            text-align: center;
            font-size: 8px;
            padding-left: 5mm;
            padding-right: 3mm;
        }
        .content-back .real-table{
            width: 100%;
            margin-top: 16mm;
        }
        .content-back .qrcode{
            position: absolute;
            top:47mm;
            left:3mm;
        }
        .content-back .qrcode img{
            height: 18mm;
        }
        .content-back .note{
            position: absolute;
            font-size: 8px;
            width: 31mm;
            top:46mm;
            left:22mm;
        }
    </style>
    
</head>
<body class="icard-size">

<section class="sheet2">
    <div class="icard">
        <img id="bg_img" src="{{ URL::asset('build/images/icard-front.png') }}" />
        <div class="image">
            <img id="thumb_img" src="{{ URL::asset('storage/photo/'.$registration->photo->first()->img_path) }}" />
        </div>
        <div class="content-front">
            <div class="name">{{ $registration->name }}</div>
            <div class="table">
                <table class="real-table">
                    <tr>
                        <td style="text-align: left; width: 10mm">F/Name</td>
                        <td style="text-align: left">: {{ $registration->father }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 10mm">Regn No</td>
                        <td style="text-align: left">: {{ $registration->system_id }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 10mm">Phone No</td>
                        <td style="text-align: left">: {{ $registration->phone }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; vertical-align: text-top; width: 10mm">Address</td>
                        <td style="text-align: left">: {{ $registration->address_t }} 
                        {{ $registration->city_t }} 
                        {{ $registration->district_t }}
                        {{ $registration->state_t }}    
                        {{ $registration->pin_t }}    
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="barcode">
            <img src="/barcode/{{ str_replace('/', '-', $registration->id) }}" />
        </div>
    </div>
    </section>
    <section class="sheet2">
    <div class="icard">
        <img id="bg_img" src="{{ URL::asset('build/images/icard-back.png') }}" />
        <div class="image">
            <!-- <img id="thumb_img" src="barcode/thumbnail_" /> -->
        </div>
        <div class="content-back">
            <div class="table">
                <table class="real-table">
                    <tr>
                        <td style="text-align: left"><strong>Gender</strong> : {{ $registration->gender }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Date Of Birth</strong> : {{ $registration->dob ? \Carbon\Carbon::parse($registration->dob)->format('d/m/Y') : '--' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Date Of Regn</strong> : {{ $registration->created_at ? \Carbon\Carbon::parse($registration->created_at)->format('d/m/Y') : '--' }}</td>
                    </tr>
                    @php
                        $validity = '';
                        $payment = $registration->payment->where('approval', 1)->first();
                        if ($payment) {
                            $payment_date = $payment->payment_date;
                            $validity = \Carbon\Carbon::parse($payment->payment_date)->addYears($payment->payment_years)->format('d/m/Y');
                        }
                    @endphp
                    <tr>
                        <td style="text-align: left"><strong>Valid Upto</strong> : {{ $validity }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Old Registration No</strong> : {{ $registration->serial }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Old Registration Date</strong> : {{ $registration->serial_date ? \Carbon\Carbon::parse($registration->serial_date)->format('d/m/Y') : null }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Blood Group</strong> : {{ $registration->bg }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Name Of Nominee</strong> : {{ $registration->nominee_names->first()->nominee_name1 }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Parmanent Address</strong> : {{ $registration->address_t }} 
                        {{ $registration->city_p }}, 
                        {{ $registration->district_p }},
                        {{ $registration->state_p }},   
                        {{ $registration->pin_p }}    
                        </td>
                    </tr>
                </table>
            </div>
            <div class="qrcode">
                <img src="/qrcode/{{ str_replace('/', '-', $registration->system_id) }}" />
            </div>
            <div class="note">
                <strong>Note:</strong>
                <p>
                    1. This card is meant for availing benefit from APB&OCWWB only. 
                    <strong>This card is not to be Treated as Inner Line Permit (ILP)</strong>
                </p>
                <p>2. This Card is not Transferable</p>
            </div>
        </div>
    </div>
    </section>
</body>
<!-- 
    printer preferance from controll panel
    dual printing on
 -->

