
<?php

// 1. Fungsi array_push()
$buah = array("A");

echo "Array awal: (\"" . implode("\", \"", $buah) . "\")<br>";

array_push($buah, "B");

echo "Hasil array_push: " . implode(" ", $buah) . "<br><br>";


// 2. Fungsi array_merge()
$array1 = array("A", "B");
$array2 = array("C");

echo "Array awal: (\"" . implode("\", \"", $array1) . "\") digabung dengan (\"" . implode("\", \"", $array2) . "\")<br>";

$gabungan = array_merge($array1, $array2);

echo "Hasil array_merge: " . implode(" ", $gabungan) . "<br><br>";


// 3. Fungsi array_values()
$data = array("x" => 1, "y" => 2);

echo "Array awal: (\"x\" => 1, \"y\" => 2)<br>";

$nilai = array_values($data);

echo "Hasil array_values: " . implode(" ", $nilai) . "<br><br>";


// 4. Fungsi array_search()
$huruf = array("A", "B", "C");

echo "Mencari \"B\" pada array: (\"A\", \"B\", \"C\")<br>";

$posisi = array_search("B", $huruf);

echo "Hasil array_search: " . $posisi . "<br><br>";


// 5. Fungsi array_filter()
$campuran = array(0, 1, false, 2, "", 3, "array");

echo "Array awal: (0, 1, false, 2, \"\", 3, \"array\")<br>";

$hasilFilter = array_filter($campuran);

echo "Hasil array_filter: " . implode(" ", $hasilFilter) . "<br><br>";


// 6. Sorting array terindeks
$angka = array(3, 1, 2);

echo "Array awal: (3, 1, 2)<br>";

sort($angka);
echo "Hasil sort: " . implode(" ", $angka) . "<br>";

rsort($angka);
echo "Hasil rsort: " . implode(" ", $angka) . "<br><br>";


// 7. Sorting array asosiatif
$umur = array(
    "Peter" => 35,
    "Ben" => 37,
    "Joe" => 43
);

echo "Array awal: (\"Peter\"=>35, \"Ben\"=>37, \"Joe\"=>43)<br>";

asort($umur);
echo "Hasil asort: ";
foreach ($umur as $nama => $usia) {
    echo $nama . "=> " . $usia . ", ";
}
echo "<br>";

arsort($umur);
echo "Hasil arsort: ";
foreach ($umur as $nama => $usia) {
    echo $nama . "=> " . $usia . ", ";
}
echo "<br>";

ksort($umur);
echo "Hasil ksort: ";
foreach ($umur as $nama => $usia) {
    echo $nama . "=> " . $usia . ", ";
}
echo "<br>";

krsort($umur);
echo "Hasil krsort: ";
foreach ($umur as $nama => $usia) {
    echo $nama . "=> " . $usia . ", ";
}
echo "<br>";

?>
