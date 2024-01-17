<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml' >
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<body style='font-family:Tahoma;font-size:12px;color: #333333;background-color:#FFFFFF;'>
 
    <table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
        <tr>
          <td valign='top'>
           <br/><br/>
            <table width='100%' cellspacing='0' cellpadding='0'>
                <tr>
                <td valign='top' width='35%' style='font-size:12px;'> 
                    </td>
                <td valign='top' width='35%'>
                    </td>
                <td valign='top' width='30%' style='font-size:12px;'>العميل :  {{$invoice->name}}<br/>
                رقم العميل :  {{$invoice->phone}}<br />
                العنوان: {{$invoice->address}}<br/>
                
                
                </td>
        
                </tr>
          </table>
          </td>
        </tr>
    </table>
<table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
    <tr>

      <td width='35%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>رقم الفاتورة </strong></td>
      <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>الاجمالي  </strong></td>

    </tr>
    <tr style="display:none;">
        <td colspan="*">
            <tr>

      @foreach ($invoice['invoices'] as $item)

      
      <tr>  
          <td valign='top' style='font-size:12px;'>{{$item->id}}
        </td>
          <td valign='top' style='font-size:12px;'>{{$item->total_amount}}
        </td>
   
      </tr>
  @endforeach
    </td>
</tr>
</tr>
    </table>
</body>
</html>