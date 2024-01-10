<!DOCTYPE html>
<html dir="rtl" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Cairo', sans-serif;">
<table >
    <tr>
        <td >
            <table >
                <tr>
                   <td >&nbsp;</td>
                </tr>
            </table>  
            <table>
                <tr>
                    <td >
                    </td>
                    <td >تاريخ الفاتورة: {{ $invoice['created_at'] }}<br/>
                    </td>
                </tr>
            </table>
            <table >
                <tr>
                    <td><div >رقم الفاتورة :  {{$invoice['id']}}</div></td>
                </tr>
            </table>
            <table >
                <tr>
                    <td><strong>المنتج </strong></td>
                    <td ><strong>الكمية</strong></td>
                    <td ><strong>السعر</strong></td>
                    <td ><strong>المجموع</strong></td>
                </tr>
                @foreach ($invoice['items'] as $item )
                    <tr>
                        <td >{{$item['product']['name']}} </td>
                        <td >{{$item['quantity']}} </td>
                        <td >{{$item['unit_price'] }} </td>
                        <td >{{$item['quantity'] * $item['unit_price']}}</td>
                    </tr>
                @endforeach
            </table>
            <table  border='0'>
                <tr>
                    <td><strong></strong></td>
                    <td>
                        <table  border='0'>
                            <tr>
                                <td></td>
                            </tr>
                            <tr>
                                <td  ><b>الاجمالي</b></td>
                                <td  ><b>{{$total}}</b></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table >
                <tr><td ></td></tr>
            </table>
            <table  >
                <tr>
                    <td><b>{{$shop["shop"]['name']}}</b><br/>
                    </td>
                        <td>
                            العنوان: {{ $shop["shop"]['address']}}<br />
                            الهاتف :  {{$shop["contact_number"]}}<br/>
                            البريد الالكتروني : {{$shop["email"]}}<br/>
                        </td>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


</body>
</html>
