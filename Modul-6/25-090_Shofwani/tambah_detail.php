
<?php
include "koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Cek transaksi
$stmt = mysqli_prepare($conn, "
    SELECT id FROM transaksi WHERE id = ?
");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$cek = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($cek) == 0) {
    die("Transaksi tidak ditemukan.");
}

// Mengambil barang yang belum digunakan
$stmt = mysqli_prepare($conn, "
    SELECT b.*
    FROM barang b
    WHERE NOT EXISTS (
        SELECT 1
        FROM transaksi_detail td
        WHERE td.barang_id = b.id
        AND td.transaksi_id = ?
    )
    ORDER BY b.nama_barang
");

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$barang = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Detail Transaksi</title>
    <style>
        body {
            font-family: Arial;
            margin: 30px;
            background: #f4f6f9;
        }
        .container {
            background: white;
            padding: 25px;
            max-width: 500px;
            border-radius: 8px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            box-sizing: border-box;
        }
        button {
            background: #198754;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">

<h2>Tambah Detail Transaksi</h2>

<form action="proses_detail.php" method="POST">

    <input type="hidden" name="transaksi_id"
           value="<?= $id ?>">

    <label>Pilih Barang</label>

    <select name="barang_id" required>
        <option value="">-- Pilih Barang --</option>

        <?php while ($b = mysqli_fetch_assoc($barang)) { ?>
            <option value="<?= $b['id'] ?>">
                <?= htmlspecialchars($b['nama_barang']) ?>
                - Rp <?= number_format($b['harga'], 0, ',', '.') ?>
                (Stok: <?= $b['stok'] ?>)
            </option>
        <?php } ?>

    </select>

    <label>Jumlah Barang (Qty)</label>
    <input type="number" name="qty" min="1" required>

    <button type="submit">Simpan Detail</button>

</form>

<br>
<a href="detail.php?id=<?= $id ?>">Kembali</a>

</div>

</body>
</html>
