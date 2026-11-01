
<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$error = "";

if (isset($_POST['simpan'])) {
    $nama = trim($_POST['nama']);
    $telp = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);

    $stmt = mysqli_prepare($conn,
        "INSERT INTO supplier (nama, telp, alamat) VALUES (?, ?, ?)");

    mysqli_stmt_bind_param($stmt, "sss", $nama, $telp, $alamat);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal menambahkan data supplier.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Supplier</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background: white;
            color: #444;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        h2 {
            color: #438ca3;
            font-size: 24px;
            font-weight: normal;
            padding-bottom: 12px;
            border-bottom: 1px solid #eee;
            margin-bottom: 25px;
        }

        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        label {
            width: 115px;
            text-align: right;
            margin-right: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        input {
            width: 240px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            font-size: 13px;
        }

        input:focus {
            outline: none;
            border-color: #66afe9;
            box-shadow: 0 0 5px rgba(102,175,233,.5);
        }

        .tombol {
            margin-left: 135px;
            margin-top: 5px;
        }

        button, .batal {
            display: inline-block;
            padding: 9px 14px;
            border: none;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
        }

        .simpan {
            background: #5cb85c;
            border: 1px solid #4cae4c;
        }

        .simpan:hover {
            background: #449d44;
        }

        .batal {
            background: #d9534f;
            border: 1px solid #d43f3a;
        }

        .batal:hover {
            background: #c9302c;
        }

        .error {
            color: red;
            margin-left: 135px;
        }

        @media(max-width: 500px) {
            .form-group {
                align-items: flex-start;
                flex-direction: column;
                gap: 7px;
            }

            label {
                text-align: left;
                width: auto;
            }

            input {
                width: 90%;
            }

            .tombol, .error {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Tambah Data Master Supplier Baru</h2>

    <?php if ($error != "") { ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php } ?>

    <form method="POST">

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama"
                   placeholder="Nama" required>
        </div>

        <div class="form-group">
            <label for="telp">Telp</label>
            <input type="text" id="telp" name="telp"
                   placeholder="telp">
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat"
                   placeholder="alamat">
        </div>

        <div class="tombol">
            <button type="submit" name="simpan" class="simpan">
                Simpan
            </button>

            <a href="index.php" class="batal">
                Batal
            </a>
        </div>

    </form>

</div>

</body>
</html>
