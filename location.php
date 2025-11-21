<?php
$lat = $_GET['lat'] ?? null;
$lon = $_GET['lon'] ?? null;

if ($lat && $lon) {
    $time = date('Y-m-d H:i:s');
    $data = "$time|$lat|$lon\n";
    file_put_contents("lokasi.txt", $data, FILE_APPEND);
}

// BACA FILE LOKASI
$rows = [];
if (file_exists("lokasi.txt")) {
    $lines = file("lokasi.txt", FILE_IGNORE_NEW_LINES);
    foreach ($lines as $line) {
        list($time, $lat, $lon) = explode("|", $line);
        $rows[] = compact("time", "lat", "lon");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Log Lokasi</title>
    <meta http-equiv="refresh" content="2">
    <style>
        table { border-collapse: collapse; width: 60%; margin: 20px auto; }
        th, td { border: 1px solid #333; padding: 8px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
<h2 style="text-align:center">📍 Log Lokasi dari Aplikasi</h2>
<table>
    <tr>
        <th>Waktu</th>
        <th>Latitude</th>
        <th>Longitude</th>
    </tr>
    <?php foreach ($rows as $r): ?>
        <tr>
            <td><?= $r["time"] ?></td>
            <td><?= $r["lat"] ?></td>
            <td><?= $r["lon"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
