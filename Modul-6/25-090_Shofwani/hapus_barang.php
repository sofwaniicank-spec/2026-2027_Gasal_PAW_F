
<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("Akses tidak diizinkan.");
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

if ($id <= 0) {
    die("ID barang tidak valid.");
}

// Mengecek apakah barang sudah digunakan
$stmt = mysqli_prepare($conn, "
    SELECT COUNT(*) AS jumlah
    FROM transaksi_detail
    WHERE barang_id = ?
");

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$data = mysqli_fetch_assoc(
    mysqli_stmt_get_result($stmt)
);

if ($data['jumlah'] > 0) {

    echo "<script>
        alert('Barang tidak bisa dihapus karena masih digunakan pada transaksi!');
        window.location='index.php';
    </script>";

    exit;
}

// Jika belum digunakan, hapus barang
$stmt = mysqli_prepare($conn, "
    DELETE FROM barang WHERE id = ?
");

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    echo "<script>
        alert('Barang berhasil dihapus!');
        window.location='index.php';
    </script>";

} else {

    echo "<script>
        alert('Gagal menghapus barang!');
        window.location='index.php';
    </script>";

}
?>
