
<?php
include "koneksi.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = mysqli_prepare($conn, "
    SELECT * FROM transaksi WHERE id = ?
");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$transaksi = mysqli_fetch_assoc(
    mysqli_stmt_get_result($stmt)
);

if (!$transaksi) {
    die("Transaksi tidak ditemukan.");
}

$stmt = mysqli_prepare($conn, "
    SELECT td.*, b.kode_barang, b.nama_barang
    FROM transaksi_detail td
    JOIN barang b ON td.barang_id = b.id
    WHERE td.transaksi_id = ?
");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$detail = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Transaksi</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th { background: #2457a7; color: white; }
        a {
            display: inline-block;
            padding: 9px 13px;
            background: #198754;
            color: white;
            text-decoration: none;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<h2>Detail Transaksi ID: <?= $transaksi['id'] ?></h2>

<p>Tanggal: <?= $transaksi['waktu_transaksi'] ?></p>
<p>Keterangan: <?= htmlspecialchars($transaksi['keterangan'] ?? '') ?></p>

<a href="tambah_detail.php?id=<?= $id ?>">
    + Tambah Barang
</a>

<table>
    <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Qty</th>
        <th>Subtotal</th>
    </tr>

    <?php while ($d = mysqli_fetch_assoc($detail)) { ?>
    <tr>
        <td><?= htmlspecialchars($d['kode_barang']) ?></td>
        <td><?= htmlspecialchars($d['nama_barang']) ?></td>
        <td>Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
        <td><?= $d['qty'] ?></td>
        <td>
            Rp <?= number_format($d['harga'] * $d['qty'], 0, ',', '.') ?>
        </td>
    </tr>
    <?php } ?>
</table>

<h3>
    Total Transaksi:
    Rp <?= number_format($transaksi['total'], 0, ',', '.') ?>
</h3>

<br>
<a href="index.php" style="background:#555;">Kembali</a>

</body>
</html>
