
<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil ID dari URL menggunakan GET
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die("ID supplier tidak ditemukan. Silakan klik Edit dari halaman utama.");
}

// Proses update
if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $stmt = mysqli_prepare($conn,
        "UPDATE supplier SET nama=?, telp=?, alamat=? WHERE id=?");

    mysqli_stmt_bind_param($stmt, "sssi",
        $nama, $telp, $alamat, $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . mysqli_error($conn);
    }
}

// Mengambil data supplier
$stmt = mysqli_prepare($conn,
    "SELECT nama, telp, alamat FROM supplier WHERE id=?");

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $nama, $telp, $alamat);

if (!mysqli_stmt_fetch($stmt)) {
    die("Data supplier tidak ditemukan.");
}

mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Master Supplier</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: white;
            margin: 30px;
            color: #444;
        }

        h2 {
            color: #438ca3;
            font-size: 23px;
            font-weight: normal;
            border-bottom: 1px solid #eee;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        label {
            width: 115px;
            text-align: right;
            margin-right: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        input {
            width: 243px;
            height: 36px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 12px;
        }

        .tombol {
            margin-left: 135px;
            margin-top: 5px;
        }

        button, .batal {
            padding: 8px 13px;
            border-radius: 4px;
            color: white;
            font-size: 12px;
            text-decoration: none;
            cursor: pointer;
        }

        .update {
            background: #5cb85c;
            border: 1px solid #4cae4c;
        }

        .batal {
            background: #d9534f;
            border: 1px solid #d43f3a;
        }
    </style>
</head>

<body>

<h2>Edit Data Master Supplier</h2>

<form method="POST" action="edit.php?id=<?= $id ?>">

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama"
            value="<?= htmlspecialchars($nama) ?>" required>
    </div>

    <div class="form-group">
        <label>Telp</label>
        <input type="text" name="telp"
            value="<?= htmlspecialchars($telp) ?>">
    </div>

    <div class="form-group">
        <label>Alamat</label>
        <input type="text" name="alamat"
            value="<?= htmlspecialchars($alamat) ?>">
    </div>

    <div class="tombol">
        <button type="submit" name="update" class="update">
            Update
        </button>

        <a href="index.php" class="batal">
            Batal
        </a>
    </div>

</form>

</body>
</html>
