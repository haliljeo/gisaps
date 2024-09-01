<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
	
	$json_data = file_get_contents("php://input");

// Gelen JSON verisini diziye dönüştür
$data = json_decode($json_data, true);

// JSON verisinin doğru şekilde dönüştürülüp dönüştürülmediğini kontrol et
if ($data !== null) {
    // Dizi olarak alınan verileri ekrana yazdırma
    echo "Received JSON data:\n";
    print_r($data);

    // JSON verisinden gerekli alanları al
    $p = $data['p'];
    $y = $data['y'];
    $i = $data['i'];
    $l = $data['l'];
    $t = $data['t'];
    $o = $data['o'];
    $a = $data['a'];
    $d = $data['d'];

    // Veritabanı bağlantısı
	$servername = "localhost";
	$username = "gisaps";
	$password = "gisAPS12";
    $database = "gisaps"; // Veritabanı adı

    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $username, $password, $database);

    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

    // UPDATE sorgusu
    $sql = "UPDATE data SET yazar = '$y', issn = '$i', link = '$l', yil = '$t', ozet = '$o', anahtar = '$a', dergi = '$d' WHERE pii = '$p'";

    // Sorguyu çalıştır ve sonucu kontrol et
    if ($conn->query($sql) === TRUE) {
        echo "Veri başarıyla güncellendi";
    } else {
        echo "Hata oluştu: " . $conn->error;
    }

    // Veritabanı bağlantısını kapat
    $conn->close();
} else {
    echo "Failed to parse JSON data.";
}
?>



</body>
</html>
