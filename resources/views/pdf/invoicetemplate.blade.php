<!DOCTYPE html
    PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='https://www.w3.org/1999/xhtml'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />

<body style='font-family:Tahoma;font-size:12px;color: #333333;background-color:#FFFFFF;'>
    <table align='center' border='0' cellpadding='0' cellspacing='0' style='height:842px; width:595px;font-size:12px;'>
        <tr>
            <td valign='top'>
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td valign='bottom' width='50%' height='50'>
                            <div align='left'>
                                @if (!is_null($shop))
                                    <img src="{{ public_path('storage/uploads/' . $shop['shop']['image']) }}"
                                        style="width:80px;height:80px;" />
                                    {{-- <img src="http://10.3.122.3:8000/storage/uploads/1704617681_Screenshot%20(7).png" style="width:80px;height:80px;" /> --}}
                                @endif
                            </div><br />
                        </td>

                        <td width='50%'>&nbsp;</td>
                    </tr>
                </table><br /><br />
                <table width='100%' cellspacing='0' cellpadding='0'>
                    <tr>
                        @if (!is_null($shop))
                            <td valign='top' width='35%' style='font-size:12px;'> <strong> متجر :
                                    {{ $shop['shop']['name'] }}</strong><br />
                                الهاتف : {{ $shop['contact_number'] }}<br />
                                العنوان: {{ $shop['shop']['address'] }}<br />
                                البريد الالكتروني : {{ $shop['email'] }}<br />
                            </td>
                        @endif


                        <td valign='top' width='35%'>
                        </td>
                        <td valign='top' width='30%' style='font-size:12px;'>العميل : {{ $customer['name'] }}<br />
                            رقم العميل : {{ $customer['phone'] }}<br />
                            تاريخ الفاتورة: {{ $invoice['created_at'] }}<br />


                        </td>

                    </tr>
                </table>
                <table width='100%' height='100' cellspacing='0' cellpadding='0'>
                    <tr>
                        <td>
                            <div align='center' style='font-size: 14px;font-weight: bold;'>رقم الفاتورة :
                                {{ $invoice['id'] }} </div>
                        </td>
                    </tr>
                </table>
                <table width='100%' cellspacing='0' cellpadding='2' border='1' bordercolor='#CCCCCC'>
                    <tr>

                        <td width='35%' bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>المنتج
                            </strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>الكمية</strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong> السعر</strong></td>
                        <td bordercolor='#ccc' bgcolor='#f2f2f2' style='font-size:12px;'><strong>المجموع</strong></td>

                    </tr>
                    <tr style="display:none;">
                        <td colspan="*">
                    <tr>
                        {{-- @foreach ($invoice['items'] as $item) --}}
                        @foreach ($content as $item)
                            {{-- {{dd($invoice['items'])}} --}}
                            {{-- {{dd($details['items'])}} --}}

                    <tr>
                        <td valign='top' style='font-size:12px;'>{{ $item->name }} </td>
                        {{-- <td valign='top' style='font-size:12px;'>{{$products}} </td> --}}
                        <td valign='top' style='font-size:12px;'>{{ $item->quantity }} </td>
                        <td valign='top' style='font-size:12px;'>{{ $item->unit_price }} </td>
                        <td valign='top' style='font-size:12px;'>{{ $item->quantity * $item->unit_price }}</td>
                    </tr>
                    @endforeach


        </tr>
        </td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2' border='0'>
        <tr>
            <td style='font-size:12px;width:50%;'><strong></strong></td>
            <td>
                <table width='100%' cellspacing='0' cellpadding='2' border='0'>
                    <tr>
                        <td align='right' style='font-size:12px;'>المجموع</td>
                        <td align='right' style='font-size:12px;'>{{ $total }}
                        <td>
                    </tr>
                    <tr>
                        <td align='right' style='font-size:12px;'>الخصم</td>
                        <td align='right' style='font-size:12px;'>$0.00</td>
                    </tr>
                    <tr>

                        <td align='right' style='font-size:12px;'><b>الاجمالي</b></td>
                        <td align='right' style='font-size:12px;'><b>{{ $total }}</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table width='100%' height='50'>
        <tr>
            <td style='font-size:12px;text-align:justify;'></td>
        </tr>
    </table>
    <table width='100%' cellspacing='0' cellpadding='2'>
        <tr>
            @if (!is_null($shop))
                <td width='33%' style='border-top:double medium #CCCCCC;font-size:12px;' valign='top'>
                    <b>{{ $shop['shop']['name'] }}</b><br />
                </td>
                @endif
                @if (!is_null($shop))
                <td width='33%' style='border-top:double medium #CCCCCC; font-size:12px;' align='center'
                    valign='top'>
                    العنوان: {{ $shop['shop']['address'] }}<br />
                    الهاتف : {{ $shop['contact_number'] }} <br />
                    البريد الالكتروني : {{ $shop['email'] }}<br />
                    @endif
                </td>
            

            <td valign='top' width='34%' style='border-top:double medium #CCCCCC;font-size:12px;'
                align='right'><br />

            </td>
        </tr>
    </table>
    </td>
    </tr>
    </table>
</body>

</html>
