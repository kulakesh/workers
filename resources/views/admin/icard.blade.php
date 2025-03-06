
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
            color: brown;
        }
        .image {
            top:23mm;
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
            top: 51mm;
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
        .content-front .barcode{
            text-align: center;
            margin-top: 4mm;
        }
        .content-front .barcode img{
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
            margin-top: 18mm;
        }
        .content-back .qrcode{
            position: absolute;
            top:47mm;
            left:3mm;
        }
        .content-back .qrcode img{
            height: 18mm;
        }
    </style>
    
</head>
<body class="icard-size">

<section class="sheet2">
    <div class="icard">
        <img id="bg_img" src="{{ URL::asset('build/images/icard-front.png') }}" />
        <div class="reg_id">
            <table class="real-table">
                <tr>
                    <td style="text-align: left; width: 10mm">Reg. No.</td>
                    <td style="text-align: left">: {{ $registration->system_id }}</td>
                </tr>
            </table>
        </div>
        <div class="image">
            <img id="thumb_img" src="{{ URL::asset('storage/photo/'.$registration->photo->first()->img_path) }}" />
        </div>
        <div class="content-front">
            <div class="name">{{ $registration->name }}</div>
            <div class="role">{{ $registration->nature }}</div>
            <div class="table">
                <table class="real-table">
                    <tr>
                        <td style="text-align: left; width: 10mm">Father's Name</td>
                        <td style="text-align: left">: {{ $registration->father }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left; width: 10mm">Contact No</td>
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
            <div class="barcode">
                <img src="/barcode/{{ $registration->system_id }}" />
            </div>
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
                        <td style="text-align: left"><strong>Blood Group</strong> : {{ $registration->bg }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>DOB</strong> : {{ $registration->dob ? \Carbon\Carbon::parse($registration->dob)->format('d/m/Y') : '--' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Year of appointment</strong> : {{ $registration->doe ? \Carbon\Carbon::parse($registration->doe)->format('d/m/Y') : '--' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Valid up to</strong> : {{ $registration->dor ? \Carbon\Carbon::parse($registration->dor)->format('d/m/Y') : '--' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Expire</strong> : {{ $registration->dor ? \Carbon\Carbon::parse($registration->dor)->format('d/m/Y') : '--' }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><strong>Parmanent Address</strong> : {{ $registration->address_t }} 
                        {{ $registration->city_t }} 
                        {{ $registration->district_t }}
                        {{ $registration->state_t }}    
                        {{ $registration->pin_t }}    
                        </td>
                    </tr>
                </table>
            </div>
            <div class="qrcode">
                <img src="/qrcode/{{ $registration->system_id }}" />
            </div>
        </div>
    </div>
    </section>
</body>
<!-- 
    printer preferance from controll panel
    dual printing on
 -->

