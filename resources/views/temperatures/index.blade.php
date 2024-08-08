<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature Records</title>
    
    <!-- Load Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Load jQuery once -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Data Records</h1>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Temperature (°C)</th>
                        <th>Shock circuit status</th>
                        {{-- <th>Created At</th> --}}
                    </tr>
                </thead>
                <tbody id="temperatureTableBody">
                    @foreach($temperatures as $temperature)
                        <tr>
                            <td>{{ $temperature->id }}</td>
                            <td>{{ $temperature->temperature }}</td>
                            <td>
                                <span class="badge badge-{{ $temperature->status ? 'success' : 'danger' }}">
                                    {{ $temperature->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            {{-- <td>{{ $temperature->created_at }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Load Bootstrap JS and Popper.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function(){
            // Function to fetch and update the temperature table
            function fetchTemperatures() {
                $.ajax({
                    url: '{{ url('/home') }}', // Ensure this URL is correct
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var tableBody = $('#temperatureTableBody');
                        tableBody.empty(); // Clear the table body

                        // Append new rows to the table
                        $.each(data, function(index, temperature) {
                            var row = '<tr>' +
                                '<td>' + temperature.id + '</td>' +
                                '<td>' + temperature.temperature + '</td>' +
                                '<td><span class="badge badge-' + (temperature.status ? 'success' : 'danger') + '">' +
                                    (temperature.status ? 'Active' : 'Inactive') + '</span></td>' +
                                '<td>' + temperature.created_at + '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error: ' + status + error);
                    }
                });
            }

            // Fetch temperatures every 2 seconds
            setInterval(fetchTemperatures, 2000);
        });
    </script>
</body>
</html>
