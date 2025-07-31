<!DOCTYPE html>
<html>
<head>
    <title>Hasil BMI</title>
</head>
<body>
    <h2>Halo, {{ $nama }}!</h2>
    <p>Berikut adalah hasil pengukuran BMI kamu:</p>
    <ul>
        <li><strong>Berat:</strong> {{ $berat }} kg</li>
        <li><strong>Tinggi:</strong> {{ $tinggi }} cm</li>
        <li><strong>BMI:</strong> {{ $bmi }}</li>
        <li><strong>Kategori:</strong> {{ $kategori }}</li>
    </ul>
    <p>Terima kasih telah menggunakan aplikasi kami!</p>
</body>
</html>
