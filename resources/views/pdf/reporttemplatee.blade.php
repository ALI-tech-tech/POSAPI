<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h3 {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
  <img src="{{ public_path('storage/uploads/iconn.png') }}" alt="Logo" style="width: 80px; height: 80px;">
    <h3> العميل : {{ $invoice->name }}<br />
        رقم العميل : {{ $invoice->phone }}<br />
        العنوان: {{ $invoice->address }}<br /></h3>
    <table>
        <thead>
            <tr>
                <th>تاريخ الفاتورة </th>
                <th>الاجمالي </th>
                <th>رقم الفاتورة </th>


            </tr>
        </thead>
        <tbody>
            @if (!is_null($invoice['invoices']))
                @foreach ($invoice['invoices'] as $item)
                    <tr>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->total_amount }}</td>
                        <td>{{ $item->id }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
