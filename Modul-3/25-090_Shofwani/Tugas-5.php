
<?php
$students = array(
    array("Alex", "220401", "0812345678"),
    array("Bianca", "220402", "0812345687"),
    array("Candice", "220403", "0812345665")
);

echo "Data awal:<br>";
echo "students =<br>";
echo "<pre>";
print_r($students);
echo "</pre>";

// Menambahkan lima data baru
array_push(
    $students,
    array("Daniel", "220404", "0812345661"),
    array("Elena", "220405", "0812345662"),
    array("Fiona", "220406", "0812345663"),
    array("Gabe", "220407", "0812345664"),
    array("Hannah", "220408", "0812345665")
);

echo "Data setelah ditambah 5 data lain:<br>";
echo "students =<br>";
echo "<pre>";
print_r($students);
echo "</pre>";

// Menampilkan data dalam tabel
echo "<table border='1' cellspacing='0' cellpadding='5'>";
echo "<tr><th>Name</th><th>NIM</th><th>Mobile</th></tr>";

foreach ($students as $student) {
    echo "<tr>";
    echo "<td>" . $student[0] . "</td>";
    echo "<td>" . $student[1] . "</td>";
    echo "<td>" . $student[2] . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
