
<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("Akses tidak diizinkan.");
}

$transaksi_id = (int) $_POST['transaksi_id'];
$barang_id = (int) $_POST['barang_id'];
$qty = (int) $_POST['qty'];

if ($transaksi_id <= 0 || $barang_id <= 0 || $qty <= 0) {
    die("Data input tidak valid.");
}

// Memulai transaksi database
mysqli_begin_transaction($conn);

try {

    // Cek transaksi
    $stmt = mysqli_prepare($conn, "
        SELECT id FROM transaksi
        WHERE id = ?
        FOR UPDATE
    ");

    mysqli_stmt_bind_param($stmt, "i", $transaksi_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_get_result($stmt)->num_rows == 0) {
        throw new Exception("Transaksi tidak ditemukan.");
    }

    // Mengambil harga barang dari database
    $stmt = mysqli_prepare($conn, "
        SELECT harga FROM barang WHERE id = ?
    ");

    mysqli_stmt_bind_param($stmt, "i", $barang_id);
    mysqli_stmt_execute($stmt);

    $barang = mysqli_fetch_assoc(
        mysqli_stmt_get_result($stmt)
    );

    if (!$barang) {
        throw new Exception("Barang tidak ditemukan.");
    }

    $harga = (int) $barang['harga'];

    // Mengecek stok barang
    $stmt = mysqli_prepare($conn, "
        SELECT stok FROM barang WHERE id = ?
    ");

    mysqli_stmt_bind_param($stmt, "i", $barang_id);
    mysqli_stmt_execute($stmt);

    $stok = mysqli_fetch_assoc(
        mysqli_stmt_get_result($stmt)
    );

    if ($qty > $stok['stok']) {
        throw new Exception("Stok barang tidak mencukupi.");
    }

    // Memastikan barang belum dimasukkan
    $stmt = mysqli_prepare($conn, "
        SELECT barang_id
        FROM transaksi_detail
        WHERE transaksi_id = ? AND barang_id = ?
    ");

    mysqli_stmt_bind_param(
        $stmt, "ii", $transaksi_id, $barang_id
    );

    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_get_result($stmt)->num_rows > 0) {
        throw new Exception(
            "Barang sudah dimasukkan ke transaksi ini."
        );
    }

    // Menyimpan detail transaksi
    $stmt = mysqli_prepare($conn, "
        INSERT INTO transaksi_detail
        (transaksi_id, barang_id, harga, qty)
        VALUES (?, ?, ?, ?)
    ");

    mysqli_stmt_bind_param(
        $stmt, "iiii",
        $transaksi_id, $barang_id, $harga, $qty
    );

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Gagal menyimpan detail transaksi.");
    }

    // Menghitung ulang total transaksi
    $stmt = mysqli_prepare($conn, "
        UPDATE transaksi
        SET total = (
            SELECT COALESCE(SUM(harga * qty), 0)
            FROM transaksi_detail
            WHERE transaksi_id = ?
        )
        WHERE id = ?
    ");

    mysqli_stmt_bind_param(
        $stmt, "ii", $transaksi_id, $transaksi_id
    );

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Gagal memperbarui total transaksi.");
    }

    // Jika semua berhasil
    mysqli_commit($conn);

    header("Location: detail.php?id=" . $transaksi_id);
    exit;

} catch (Throwable $e) {

    mysqli_rollback($conn);

    echo "<h3>Gagal menyimpan detail transaksi!</h3>";
    echo htmlspecialchars($e->getMessage());
    echo "<br><br>";
    echo "<a href='tambah_detail.php?id=$transaksi_id'>Kembali</a>";
}
?>
