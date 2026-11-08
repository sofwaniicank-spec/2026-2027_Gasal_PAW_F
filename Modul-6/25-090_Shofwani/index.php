
<?php
include "koneksi.php";

$query = mysqli_query($conn, "
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    LEFT JOIN pelanggan
    ON transaksi.pelanggan_id = pelanggan.id
    ORDER BY transaksi.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Transaksi</title>
    <style>
        body {
            font-family: Arial;
            margin: 30px;
            background: #f4f6f9;
        }
        h2 { color: #2457a7; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-bottom: 30px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: #2457a7;
            color: white;
        }
        a, button {
            padding: 7px 12px;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .detail { background: #198754; color: white; }
        .hapus { background: #dc3545; color: white; }
    </style>
</head>
<body>

<h2>Data Master Transaksi</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Pelanggan</th>
        <th>Keterangan</th>
        <th>Total</th>
        <th>Tindakan</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['waktu_transaksi'] ?></td>
        <td><?= htmlspecialchars($row['nama_pelanggan'] ?? '-') ?></td>
        <td><?= htmlspecialchars($row['keterangan'] ?? '') ?></td>
        <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
        <td>
            <a class="detail"
               href="detail.php?id=<?= $row['id'] ?>">
               Detail
            </a>
        </td>
    </tr>
    <?php } ?>
</table>

<h2>Data Barang</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Tindakan</th>
    </tr>

    <?php
    $barang = mysqli_query($conn, "SELECT * FROM barang");

    while ($b = mysqli_fetch_assoc($barang)) {
    ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['kode_barang']) ?></td>
        <td><?= htmlspecialchars($b['nama_barang']) ?></td>
        <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
        <td><?= $b['stok'] ?></td>
        <td>
            <form action="hapus_barang.php" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                <input type="hidden" name="id"
                       value="<?= $b['id'] ?>">
                <button class="hapus" type="submit">
                    Hapus
                </button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
