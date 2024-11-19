
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
            width: 86mm;
            height: 54mm;
            border: 1px solid black;
            position: relative;
        }
        #bg_img{
            width: 86mm;
            height: 54mm;
        }
        .image {
            width: .95in;
            height: .95in;
            position: absolute;
        }
        #thumb_image{
            width: .95in;
            height: .95in;
        }
        .content {
            width: 2.18in;
            height: 1.25in;
            position: absolute;
            left: 1.13in;
            top: .68in;
        }
        #barcode {
            width: 1.4in;
            height: .3in;
        }
    </style>
    
</head>
<body class="icard-size" style="font-size: 12px;">

<section class="sheet2">
    <div class="icard">
        <img id="bg_img" src="{{ URL::asset('build/images/icard_bg.png') }}" />
        <div class="image">
            <!-- <img id="thumb_img" src="barcode/thumbnail_" /> -->
        </div>
        <div class="content">
            <table>
                <tr>
                    <td>Name </td>
                    <td><strong>Kishor Goswami</strong> </td>
                </tr>
                <tr>
                    <td>Course </td>
                    <td><strong>Extra</strong>  </td>
                </tr>
                <tr>
                    <td>Address &nbsp&nbsp</td>
                    <td><strong>Guwahati</strong>  </td>
                </tr>
                <tr>
                    <td> </td>
                    <td><img id="barcode" src="/barcode/123456" /> </td>
                </tr>
            </table>
        </div>
    </div>
    </section>
    <section class="sheet2">
    <div class="icard">
        <img id="bg_img" src="{{ URL::asset('build/images/icard_bg.png') }}" />
        <div class="image">
            <!-- <img id="thumb_img" src="barcode/thumbnail_" /> -->
        </div>
        <div class="content">
            <table>
                <tr>
                    <td>Name </td>
                    <td><strong>Lalit Barma</strong> </td>
                </tr>
                <tr>
                    <td>Course </td>
                    <td><strong>All</strong>  </td>
                </tr>
                <tr>
                    <td>Address &nbsp&nbsp</td>
                    <td><strong>Dibrugarh</strong>  </td>
                </tr>
                <tr>
                    <td> </td>
                    <td><img id="barcode" src="/barcode/123456" /> </td>
                </tr>
            </table>
        </div>
    </div>
    </section>
</body>
<!-- 
    printer preferance from controll panel
    dual printing on
 -->

