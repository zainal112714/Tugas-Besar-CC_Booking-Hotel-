<!DOCTYPE html>
<html>
<head>
    <title>Booking Data</title>
</head>
<body>
    <h1>Booking Data</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number Phone</th>
                <th>Date</th>
                <th>Gown Package</th>
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
                    <td>{{ $booking->gown_package->size }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
