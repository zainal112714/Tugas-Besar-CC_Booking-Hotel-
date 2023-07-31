<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Booking</title>

    <style>
        /* Tambahkan CSS yang diperlukan di sini untuk memformat PDF */
        body {
            font-family: Arial, sans-serif;
        }
        @page {
            size: landscape;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        td.barcode-cell {
            width: 180px; /* Sesuaikan lebar sesuai kebutuhan Anda */
            text-align: center;
        }
        img.barcode-image {
            max-width: 100%;
            height: auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        @media print {
            body {
                margin: 0;
                padding: 20px;
            }
            table {
                margin-top: 0;
            }
            th, td {
                padding: 6px;
            }
            img.barcode-image {
                max-width: 150px;
                height: auto;
            }
        }
    </style>
</head>
<body>
    <h1>Data Booking</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Tanggal</th>
                <th>Paket Gaun</th>
                <th>Barcode</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->number_phone }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->gown_package->type }}</td>
                    <td class="barcode-cell">
                        <img class="barcode-image" src="data:image/png;base64,{{ $booking->barcode }}" alt="Barcode">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
