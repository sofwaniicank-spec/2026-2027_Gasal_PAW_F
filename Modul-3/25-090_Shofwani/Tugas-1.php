<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

echo "fruits = (\"" . implode("\", \"", $fruits) . "\")<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[count($fruits) - 1];
?>


<?php
$fruits = array("Avocado", "Blueberry", "Cherry");

array_push($fruits, "Durian", "Elderberry", "Fig", "Grape", "Honeydew");

unset($fruits[1]);

echo "Data Blueberry dihapus.<br>";
echo "fruits = (\"" . implode("\", \"", $fruits) . "\")<br>";
echo "Nilai dengan indeks tertinggi: " . end($fruits);
?>
