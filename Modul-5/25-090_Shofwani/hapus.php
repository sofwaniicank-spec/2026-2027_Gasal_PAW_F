
<?php
$conn = mysqli_connect("localhost", "root", "", "penjualan");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil ID supplier
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
    die("ID supplier tidak valid.");
}

// Memeriksa apakah supplier masih digunakan oleh barang
$cek = mysqli_prepare(
    $conn,
    "SELECT COUNT(*) FROM barang WHERE supplier_id = ?"
);

mysqli_stmt_bind_param($cek, "i", $id);
mysqli_stmt_execute($cek);
mysqli_stmt_bind_result($cek, $jumlah);
mysqli_stmt_fetch($cek);
mysqli_stmt_close($cek);

// Jika supplier masih digunakan
if ($jumlah > 0) {
    echo "<script>
        alert('Supplier tidak bisa dihapus karena masih digunakan oleh data barang!');
        window.location='index.php';
    </script>";
    exit;
}

// Proses hapus supplier
if (isset($_GET['konfirmasi']) && $_GET['konfirmasi'] == 'ya') {

    $query = mysqli_prepare(
        $conn,
        "DELETE FROM supplier WHERE id = ?"
    );

    mysqli_stmt_bind_param($query, "i", $id);

    if (mysqli_stmt_execute($query)) {
        echo "<script>
            alert('Data supplier berhasil dihapus!');
            window.location='index.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Gagal menghapus data supplier!');
            window.location='index.php';
        </script>";
        exit;
    }
}
?>

<script>
if (confirm("Anda yakin akan menghapus supplier ini?")) {
    window.location.href = "hapus.php?id=<?= $id ?>&konfirmasi=ya";
} else {
    window.location.href = "index.php";
}
</script>
