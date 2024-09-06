<!DOCTYPE html>
<html>

<head>
    <title>Rekap Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }

        .logo {
            width: 100px;
            /* Adjust width as needed */
            display: block;
            margin: 0 auto 20px auto;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ public_path('images/logo/robotickidz.png') }}" alt="Logo" class="logo">
        <h2>Rekap Transaksi</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Murid</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->student->nama }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ formatRupiah($payment->amount) }}</td>
                    <td>{{ $payment->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            &copy; {{ date('Y') }} Robotickidz. All rights reserved.
        </div>
    </div>
</body>

</html>