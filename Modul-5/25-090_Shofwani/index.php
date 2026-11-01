
<?php
// Koneksi database
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil seluruh data supplier
$query = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id ASC");

if (!$query) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master Supplier</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            color: #444;
            background: white;
        }

        h2 {
            color: #438ca3;
            font-size: 24px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background: #d9edf7;
            text-align: left;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .tambah {
            background: #5cb85c;
        }

        .edit {
            background: #f0ad4e;
        }

        .hapus {
            background: #d9534f;
        }

        .tambah:hover {
            background: #449d44;
        }

        .edit:hover {
            background: #ec971f;
        }

        .hapus:hover {
            background: #c9302c;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Data Master Supplier</h2>

    <!-- Tombol Tambah -->
    <a href="tambah.php" class="btn tambah">
        Tambah Data
    </a>
</div>

<table>

    <tr>
        <th width="8%">No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th width="20%">Tindakan</th>
    </tr>

    <?php
    $no = 1;

    while ($data = mysqli_fetch_assoc($query)) {
    ?>

    <tr>

        <td><?= $no++ ?></td>

        <td>
            <?= htmlspecialchars($data['nama']) ?>
        </td>

        <td>
            <?= htmlspecialchars($data['telp']) ?>
        </td>

        <td>
            <?= htmlspecialchars($data['alamat']) ?>
        </td>

        <td>

            <!-- Tombol Edit -->
            <a href="edit.php?id=<?= $data['id'] ?>"
               class="btn edit">
                Edit
            </a>

            <!-- Tombol Hapus -->
            <a href="hapus.php?id=<?= $data['id'] ?>"
               class="btn hapus"
               onclick="return confirm('Anda yakin akan menghapus supplier ini?')">
                Hapus
            </a>

        </td>

    </tr>

    <?php } ?>

</table>

</body>
</html>
