
<!DOCTYPE html  >
<html  dir="rtl">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
</head>
<body  style="font-family:'Cairo', sans-serif;font-size:12px;color: #333333;background-color:#FFFFFF;">
  <table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
  <tr>
    <td valign='top'><table width='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='50%'>&nbsp;</td> 
        </tr>
    </td>
  </tr>
  </table>
    <table width='100%' cellspacing='0' cellpadding='0'>
      <tr> 
        <td valign='top' width='35%' style='font-size:12px;'> <strong >رقم العميل :  {{ $customer['phone'] }}</strong><br /> 
        </td>   
          <td valign='top' width='35%'>
          </td>
          <td valign='top' width='30%' style='font-size:12px;'>تاريخ الفاتورة: {{$invoice['created_at']}}<br/>
          </td>

      </tr>
    </table>
    <table width='100%' height='100' cellspacing='0' cellpadding='0'>
      <tr>
        <td><div align='center' style='font-size: 14px;font-weight: bold;'>رقم الفاتورة :  {{$invoice['id']}}</div></td>
      </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
      <tr>
          <td width='35%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>المنتج </strong></td>
          <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>الكمية</strong></td>
          <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>السعر</strong></td>
          <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>المجموع</strong></td>
      </tr>
      @foreach ($invoice['items'] as $item )
          <tr>
              <td valign='top' style='font-size:12px;'>{{$item['product']['name']}} </td>
              <td valign='top' style='font-size:12px;'>{{$item['quantity']}} </td>
              <td valign='top' style='font-size:12px;'>{{$item['unit_price'] }} </td>
              <td valign='top' style='font-size:12px;'>{{$item['quantity'] * $item['unit_price']}}</td>
          </tr>
      @endforeach
  </table>
  
<table width='100%' cellspacing='0' cellpadding='2' border='0'>
      <tr>
        <td style='font-size:12px;width:50%;'><strong></strong></td>
        <td><table width='100%' cellspacing='0' cellpadding='2' border='0'>
        </tr>
  
  <tr>
    <td  align='right' style='font-size:12px;'><b>الاجمالي</b></td>
    <td  align='right' style='font-size:12px;'><b>{{$total}}</b></td>
  </tr>
</table>
   
   <table width='100%' height='50'>
    <tr>
      <td style='font-size:12px;text-align:justify;'>
      </td>
    </tr>
  </table>
    <table  width='100%' cellspacing='0' cellpadding='2'>
      <tr>
        <td width='33%' style='border-top:double medium #CCCCCC;font-size:12px;' valign='top' ><b>{{$shop["shop"]['name']}}</b><br/>
      </td>
        <td width='33%' style='border-top:double medium #CCCCCC; font-size:12px;' align='center' valign='top'>
        العنوان: {{ $shop["shop"]['address']}}<br />
        الهاتف :  {{$shop["contact_number"]}}<br/>
         البريد الالكتروني : {{$shop["email"]}}<br/>
      </td>   
      </tr>
    </table>
</body>
</html>