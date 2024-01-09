
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml' dir="rtl">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<body style='font-family:Tahoma;font-size:12px;color: #333333;background-color:#FFFFFF;'>
<table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
  <tr>
    <td valign='top'><table width='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td valign='bottom' width='50%' height='50'><div align='left'><img src='https://www.inv24.com/components/Users/pics/50c86533af47b/thumbs/0.jpg' /></div><br /></td>

          <td width='50%'>&nbsp;</td>
        </tr>
      {{-- </table>Bill To: {{$invoice->invoice->name}}<br/><br/> --}}
    </table>العميل:  {{$customer['name']}}<br/><br/>
      <table width='100%' cellspacing='0' cellpadding='0'>
      {{-- <tr>{{dd($invoice)}} --}}
        <td valign='top' width='35%' style='font-size:12px;'> <strong >رقم العميل :  {{ $customer['phone'] }}</strong><br /> 
{{-- [Client's company address line 1]<br />
[Client's company address line 2] <br/> --}}

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
      <tr style="display:none;"><td colspan="*"><tr>
        <td valign='top' style='font-size:12px;'>{{$item['product']['name']}} </td>
        <td valign='top' style='font-size:12px;'>{{$item['quantity']}} </td>
        <td valign='top' style='font-size:12px;'>{{$item['unit_price'] }} </td>
      <td valign='top' style='font-size:12px;'>{{$item['quantity'] * $item['unit_price']}}</td>
</tr>
@endforeach
</td></tr>
    </table>
<table width='100%' cellspacing='0' cellpadding='2' border='0'>
      <tr>
        <td style='font-size:12px;width:50%;'><strong></strong></td>
        <td><table width='100%' cellspacing='0' cellpadding='2' border='0'>
        </tr>
  <tr>
    <td></td>
 
    {{-- <td align='right' style='font-size:12px;' >الاجمالي</td>
    <td  align='right' style='font-size:12px;'>$1,095.00<td> --}}
  </tr>
  {{-- <tr>
    <td  align='right' style='font-size:12px;'>TAX(6.25%)</td>
    <td  align='right' style='font-size:12px;'>$68.44</td>
  </tr> --}}
  <tr>

    <td  align='right' style='font-size:12px;'><b>الاجمالي</b></td>
    <td  align='right' style='font-size:12px;'><b>{{$total}}</b></td>
  </tr></table>
</td>
      </tr>
</table> 
   
   <table width='100%' height='50'><tr><td style='font-size:12px;text-align:justify;'></td></tr></table>
    <table  width='100%' cellspacing='0' cellpadding='2'>
      <tr>
        <td width='33%' style='border-top:double medium #CCCCCC;font-size:12px;' valign='top' ><b>[Company name]</b><br/>


</td>
        <td width='33%' style='border-top:double medium #CCCCCC; font-size:12px;' align='center' valign='top'>
[Company address line 1]<br />
[Company address line 2] <br/>
Phone: [Phone]<br/>
</td>

        {{-- <td valign='top' width='34%' style='border-top:double medium #CCCCCC;font-size:12px;' align='right'>[payment details]<br/> [payment details]  <br/> [payment details] <br/>    [payment details] <br/> --}}
 </td>
      </tr>
    </table>
</td>
  </tr>
</table>
</body>
</html>