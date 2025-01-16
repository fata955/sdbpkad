<!DOCTYPE html>
<html>
<head>
    <title>Laporan</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Data</h1>
    <table id="data-table">
        <thead>
            <tr>
                <th>Kolom1</th>
                <th>Kolom2</th>
                <th>Kolom3</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data akan ditambahkan di sini menggunakan jQuery -->
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'fetch_data.php',
                method: 'GET',
                success: function(data) {
                    var tbody = $('#data-table tbody');
                    $.each(data, function(index, row) {
                        var tr = $('<tr>');
                        tr.append($('<td>').text(row.kolom1));
                        tr.append($('<td>').text(row.kolom2));
                        tr.append($('<td>').text(row.kolom3));
                        tbody.append(tr);
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });
    </script>
</body>
</html>
